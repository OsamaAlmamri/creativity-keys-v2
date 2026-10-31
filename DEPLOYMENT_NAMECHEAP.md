# دليل النشر التلقائي عبر GitHub Actions إلى استضافة Namecheap (cPanel)

تم إعداد Workflow متكامل في المسار:
[`.github/workflows/deploy.yml`](.github/workflows/deploy.yml)

يقوم هذا الإجراء التلقائي بكل مما يلي عند عمل `git push` إلى فرع `main`:
1. تثبيت حزم PHP وتجهيز بيئة الإنتاج (`composer install --no-dev`).
2. تثبيت حزم Node وبناء أصول الواجهة وتصغيرها (`npm ci && npm run build` عبر Vite و Tailwind).
3. الاتصال الآمن بسيرفر Namecheap عبر بروتوكول SSH المشفّر (منفذ Namecheap الافتراضي `21098`).
4. مزامنة الملفات فقط بدون مسح ملفات السيرفر الحساسة (يستثني `.env`، قاعدة بيانات `sqlite`، والملفات المرفوعة `storage/app/public`).
5. تنفيذ أوامر الربط `artisan storage:link`، الترحيلات `migrate --force`، وتحديث الكاش وتحسين الأداء للإنتاج تلقائياً.

---

## 1. المتغيرات السرية المطلوبة في GitHub (GitHub Secrets)

توجه إلى مستودع المشروع على GitHub ثم:
**Settings** ⬅️ **Secrets and variables** ⬅️ **Actions** ⬅️ **New repository secret**

أضف المتغيرات التالية:

| اسم المتغير (Secret Name) | الوصف | مثال |
| :--- | :--- | :--- |
| `SSH_HOST` | عنوان IP للسيرفر أو اسم النطاق الأساسي | `198.54.115.10` أو `yourdomain.com` |
| `SSH_USER` | اسم مستخدم لوحة تحكم cPanel | `albustan` |
| `SSH_PRIVATE_KEY` | المفتاح الخاص المولد من cPanel بصيغة OpenSSH | `-----BEGIN OPENSSH PRIVATE KEY----- ...` |
| `SSH_PORT` | منفذ SSH في استضافة Namecheap (الافتراضي 21098) | `21098` |
| `DEPLOY_PATH` | المسار الكامل للمشروع داخل السيرفر | `/home/albustan/baba-albustan-keys` |
| `PHP_BIN` *(اختياري)* | مسار أمر PHP 8.3 في السيرفر إذا لم يكن هو الافتراضي | `/usr/local/bin/ea-php83` أو اتركه فارغاً |

---

## 2. تفعيل SSH وتوليد المفتاح من لوحة Namecheap cPanel

1. سجّل الدخول إلى **cPanel** في Namecheap.
2. ابحث عن قسم **Security** واختر **SSH Access**.
3. تأكد من أن الـ SSH مفعّل (إذا كان غير متاح، اطلب من دعم Namecheap عبر Live Chat تفعيل Shell Access لحسابك، وعادة يفعلونها فوراً).
4. اضغط على **Manage SSH Keys** ثم **Generate a New Key**:
   - Key Name: `github_deploy`
   - Key Password: اتركه فارغاً (No passphrase) لكي يعمل GitHub Actions تلقائياً.
   - Key Type: `RSA`
   - Key Size: `4096`
5. بعد الإنشاء، اضغط على **Manage** بجانب المفتاح العام (Public Key) واضغط **Authorize**.
6. بجانب المفتاح الخاص (Private Key)، اضغط **View/Download** ثم **Convert to OpenSSH** إذا طُلب، وانسخ النص بالكامل وضعه في السر `SSH_PRIVATE_KEY` في GitHub.

---

## 3. إعداد المشروع للمرة الأولى على السيرفر (First-Time Setup)

قبل أول نشر آلي:
1. ادخل إلى مجلد المشروع على السيرفر، وأنشئ ملف `.env`:
   ```bash
   cp .env.example .env
   ```
2. اضبط إعدادات الإنتاج وقاعدة البيانات في `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_DATABASE=اسم_قاعدة_البيانات
   DB_USERNAME=اسم_مستخدم_القاعدة
   DB_PASSWORD=كلمة_مرور_القاعدة
   ```
3. ولّد مفتاح التطبيق للمرة الأولى:
   ```bash
   php artisan key:generate
   ```

---

## 4. توجيه النطاق (Document Root)

لأفضل أمان وسرعة، يوصى بأن يكون مجلد المشروع الرئيسي خارج `public_html`:
- مسار المشروع: `/home/username/baba-albustan-keys`
- مسار النطاق (Document Root): `/home/username/baba-albustan-keys/public`

**إذا كانت استضافتك نطاقاً رئيسياً ولا تسمح بتعديل Document Root:**
- يحتوي المشروع الآن على ملف [`.htaccess`](.htaccess) في المجلد الجذر يقوم تلقائياً بتحويل الزوار بأمان إلى مجلد `public/` ويحجب الوصول لأي ملفات حساسة مثل `.env` أو `composer.json`.

---

## 5. طريقة النشر البديلة عبر FTP

إذا لم ترغب في استخدام SSH، تم تجهيز ملف:
[`.github/workflows/deploy-ftp.yml`](.github/workflows/deploy-ftp.yml)
يحتاج فقط إلى:
- `FTP_SERVER`
- `FTP_USERNAME`
- `FTP_PASSWORD`
- `FTP_TARGET_DIR`
ويمكّنك تشغيله يدوياً عبر زر **Run workflow** في تبويب Actions على GitHub.
