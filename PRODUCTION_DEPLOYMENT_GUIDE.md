# دليل النشر المباشر للإنتاج وإجراءات التراجع في حالات الطوارئ
# PRODUCTION DEPLOYMENT & ROLLBACK GUIDE
## مشروع: مفتاح الإبداع (Creativity Keys) — النقل إلى Laravel 13
**النطاق:** `https://creativity-keys.com`  
**بيئة الإنتاج المستهدفة:** سيرفر الاستضافة (cPanel / SSH / MySQL / PHP 8.3+)

---

## 1. قائمة التحقق قبل النشر المباشر (Pre-Deployment Checklist)

- [x] تم تشغيل كافة اختبارات Feature & Unit Tests بنجاح (`47 tests, 349 assertions, 100% passed`).
- [x] تم فحص وتنسيق الأكواد المصدرية عبر Laravel Pint بنجاح كامل بدون أي مخالفات.
- [x] تم بناء وتصغير أصول الواجهة عبر Vite و Tailwind CSS بنجاح (`npm run build`).
- [x] تم إعداد وتأكيد تحويلات السيو 301 الدائمة للروابط القديمة (`/contact`, `/blog`, `/article/{slug}`).
- [x] تم تضمين وتحديث خريطة الموقع `sitemap.xml` وملف الروبوتس `robots.txt`.
- [x] تم استخراج بيانات الإنتاج الحقيقية وتجهيز البذر المعتمد (`SettingSeeder` و `ServiceSeeder`).
- [x] تم ربط مجلد التخزين العام `storage:link` ونقل الشعار وأيقونة المتصفح.

---

## 2. إجراءات النشر التدريجي على السيرفر (Production Deployment Steps)

### الخطوة 1: أخذ نسخة احتياطية فورية من الإنتاج القديم
قبل لمس أي ملف في السيرفر المباشر:
```bash
# 1. تصدير قاعدة بيانات MySQL الحالية
mysqldump -u [DB_USER] -p[DB_PASSWORD] [DB_NAME] > /home/[USER]/keys_production_backup_$(date +%F_%T).sql

# 2. أخذ نسخة مضغوطة من ملفات v1 الحالية
tar -czvf /home/[USER]/keys_v1_backup_$(date +%F_%T).tar.gz /home/[USER]/public_html
```

### الخطوة 2: رفع ملفات المشروع الجديد `creativity-keys-v2`
رفع محتويات `creativity-keys-v2` إلى مسار مجلد التطبيق المخصص على السيرفر (خارج `public_html` لأعلى درجات الأمان):
```text
/home/[USER]/creativity-keys-v2/
```
مع توجيه مسار النطاق `DocumentRoot` في cPanel إلى:
```text
/home/[USER]/creativity-keys-v2/public
```

### الخطوة 3: ضبط ملف البيئة `.env` في الإنتاج
إنشاء وضبط ملف `.env` في مجلد التطبيق:
```env
APP_NAME="مفتاح الإبداع"
APP_ENV=production
APP_KEY=[YOUR_GENERATED_APP_KEY]
APP_DEBUG=false
APP_URL=https://creativity-keys.com

APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[PRODUCTION_DB_NAME]
DB_USERNAME=[PRODUCTION_DB_USER]
DB_PASSWORD=[PRODUCTION_DB_PASSWORD]

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public
```

### الخطوة 4: تنفيذ أوامر التجهيز والتخزين والكاش
تنفيذ الأوامر التالية عبر SSH أو عبر واجهة Terminal في cPanel:
```bash
# 1. تثبيت حزم PHP المحسنة للإنتاج
composer install --no-dev --optimize-autoloader

# 2. ترحيل الجداول وبذر البيانات الأساسية
php artisan migrate --force
php artisan db:seed --force

# 3. ربط مجلد التخزين العام للملفات
php artisan storage:link

# 4. تفعيل كاش الأداء والسرعة الفائقة
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## 3. خطة وإجراءات التراجع الفوري (Emergency Rollback Plan)

إذا حدث أي خطأ غير متوقع أثناء توجيه النطاق المباشر، يتم تفعيل خطة التراجع الفورية خلال أقل من دقيقتين:

### إجراءات العودة إلى v1:
1. **استعادة ملفات الواجهة القديمة:**
   إعادة توجيه مسار النطاق في cPanel إلى مجلد المشروع القديم `creativity-keys-v1/public` أو استرجاع الأرشيف المضغوط:
   ```bash
   tar -xzvf /home/[USER]/keys_v1_backup_*.tar.gz -C /home/[USER]/public_html
   ```
2. **استرجاع قاعدة البيانات:**
   ```bash
   mysql -u [DB_USER] -p[DB_PASSWORD] [DB_NAME] < /home/[USER]/keys_production_backup_*.sql
   ```
3. **تفريغ الكاش:**
   مسح ملفات الكاش في مجلد `bootstrap/cache` وتشغيل `php artisan optimize:clear`.

---

## 4. التحقق واختبار ما بعد النشر (Post-Deployment Verification)

1. فتح الصفحة الرئيسية عبر المتصفح والتحقق من ظهور:
   - الشعار، اسم المحل "مفتاح الإبداع"، وهاتف الطوارئ `0568191921`.
   - الخدمات الـ 9 الحقيقية.
   - قسم نطاق التغطية (الأحياء الـ 85 وفلتر البحث).
   - خريطة Google المضمنة والموقع الجغرافي.
2. تجربة النقر على أزرار الاتصال والواتساب والتأكد من فتح المحادثة والاتصال الصحيح.
3. تجربة إرسال استفسار عبر نموذج التواصل والتحقق من حفظه في لوحة التحكم.
4. تجربة تسجيل الدخول إلى لوحة التحكم `/admin/login` باستخدام حساب المدير العام.
5. التحقق من توجيهات السيو 301 عبر فحص الرابط:
   `https://creativity-keys.com/blog` ⬅️ يجب أن يحول إلى `https://creativity-keys.com/articles` بكود 301.
6. فحص خريطة الموقع `https://creativity-keys.com/sitemap.xml` وملف الروبوتس `https://creativity-keys.com/robots.txt`.

