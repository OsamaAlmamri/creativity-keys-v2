@extends('admin.layouts.app')

@section('page_title', 'إعدادات وبيانات المحل')

@section('content')

    <div class="max-w-4xl mx-auto space-y-8">

        <div>
            <h2 class="text-xl font-black text-white">إعدادات وبيانات المركز والموقع</h2>
            <p class="text-xs text-slate-400">تعديل شعار الموقع، إعدادات محركات البحث SEO، نطاق التغطية، خطوط الطوارئ، العنوان، وإحداثيات خريطة Google Maps</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="settings-form">
            @csrf

            <!-- 1. Logo & Visual Branding -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center justify-between border-b border-slate-800 pb-4">
                    <span class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        شعار الموقع والهوية البصرية (Logo & Favicon)
                    </span>
                    <span class="text-xs text-amber-400 font-normal">يدعم الرفع المباشر أو الرابط الخارجي</span>
                </h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                    <!-- Site Logo Section -->
                    <div class="p-5 rounded-2xl bg-slate-950/70 border border-slate-800 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-white flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                شعار الموقع الرسمي (Site Logo)
                            </label>
                            <span class="text-[11px] text-slate-500">يظهر في الهيدر والفوتر واللوحة</span>
                        </div>

                        <!-- Current Preview Box -->
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-900 border border-slate-800/80">
                            <div class="w-24 h-16 rounded-xl bg-slate-950/80 border border-slate-800 flex items-center justify-center p-2 relative overflow-hidden shrink-0" id="site-logo-preview-box">
                                @if(!empty(\App\Models\Setting::get('site_logo')))
                                    <img src="{{ \App\Models\Setting::get('site_logo') }}" id="site-logo-preview-img" alt="شعار الموقع" class="max-h-full max-w-full object-contain">
                                    <div id="site-logo-fallback" class="text-center text-slate-600 text-[10px] hidden flex flex-col items-center gap-1">
                                        <svg class="w-6 h-6 text-amber-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                        <span>الأيقونة الافتراضية</span>
                                    </div>
                                @else
                                    <img src="" id="site-logo-preview-img" alt="شعار الموقع" class="max-h-full max-w-full object-contain hidden">
                                    <div id="site-logo-fallback" class="text-center text-slate-600 text-[10px] flex flex-col items-center gap-1">
                                        <svg class="w-6 h-6 text-amber-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                        <span>الأيقونة الافتراضية</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-1">
                                <div class="text-xs font-bold text-white">معاينة الشعار الحالية</div>
                                <p class="text-[11px] text-slate-400">يفضل صورة شفافة PNG أو SVG أو WebP بدقة 250×70 بكسل.</p>
                                <button type="button" onclick="clearSiteLogo()" id="remove-logo-btn" class="inline-flex items-center gap-1 text-[11px] text-red-400 hover:text-red-300 font-bold transition-colors {{ empty(\App\Models\Setting::get('site_logo')) ? 'hidden' : '' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    إزالة الشعار والعودة للأيقونة الافتراضية
                                </button>
                                <input type="hidden" name="remove_site_logo" id="remove_site_logo" value="0">
                            </div>
                        </div>

                        <!-- Upload File Input -->
                        <div class="space-y-1.5">
                            <label for="site_logo_file" class="block text-xs font-medium text-slate-300">رفع ملف شعار من جهازك</label>
                            <input type="file" id="site_logo_file" name="site_logo_file" accept="image/png,image/jpeg,image/svg+xml,image/webp" onchange="previewUploadedImage(this, 'site-logo-preview-img', 'site-logo-fallback', 'remove-logo-btn', 'remove_site_logo')" class="w-full text-xs text-slate-400 file:mr-0 file:ml-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-500/20 file:text-amber-400 hover:file:bg-amber-500/30 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl p-1.5">
                        </div>

                        <!-- Or External URL -->
                        <div class="space-y-1.5">
                            <label for="site_logo" class="block text-xs font-medium text-slate-400">أو رابط مباشر للشعار (URL)</label>
                            <input type="url" id="site_logo" name="site_logo" value="{{ \App\Models\Setting::get('site_logo') }}" placeholder="https://example.com/logo.png" dir="ltr" oninput="previewUrlImage(this.value, 'site-logo-preview-img', 'site-logo-fallback', 'remove-logo-btn', 'remove_site_logo')" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-amber-400 focus:outline-none text-right">
                        </div>
                    </div>

                    <!-- Favicon Section -->
                    <div class="p-5 rounded-2xl bg-slate-950/70 border border-slate-800 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-white flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                أيقونة شريط المتصفح (Favicon)
                            </label>
                            <span class="text-[11px] text-slate-500">تظهر بتبويب المتصفح</span>
                        </div>

                        <!-- Current Favicon Box -->
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-900 border border-slate-800/80">
                            <div class="w-16 h-16 rounded-xl bg-slate-950/80 border border-slate-800 flex items-center justify-center p-2 relative overflow-hidden shrink-0" id="site-favicon-preview-box">
                                @if(!empty(\App\Models\Setting::get('site_favicon')))
                                    <img src="{{ \App\Models\Setting::get('site_favicon') }}" id="site-favicon-preview-img" alt="Favicon" class="w-8 h-8 object-contain">
                                    <div id="site-favicon-fallback" class="text-amber-500 hidden">
                                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    </div>
                                @else
                                    <img src="" id="site-favicon-preview-img" alt="Favicon" class="w-8 h-8 object-contain hidden">
                                    <div id="site-favicon-fallback" class="text-amber-500">
                                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-1">
                                <div class="text-xs font-bold text-white">أيقونة التبويب الحالية</div>
                                <p class="text-[11px] text-slate-400">يفضل ملف ICO أو PNG أو SVG بدقة 32×32 أو 64×64 بكسل.</p>
                                <button type="button" onclick="clearSiteFavicon()" id="remove-favicon-btn" class="inline-flex items-center gap-1 text-[11px] text-red-400 hover:text-red-300 font-bold transition-colors {{ empty(\App\Models\Setting::get('site_favicon')) ? 'hidden' : '' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    إزالة الأيقونة والعودة للأيقونة الافتراضية
                                </button>
                                <input type="hidden" name="remove_site_favicon" id="remove_site_favicon" value="0">
                            </div>
                        </div>

                        <!-- Upload Favicon Input -->
                        <div class="space-y-1.5">
                            <label for="site_favicon_file" class="block text-xs font-medium text-slate-300">رفع أيقونة من جهازك</label>
                            <input type="file" id="site_favicon_file" name="site_favicon_file" accept=".ico,image/png,image/svg+xml" onchange="previewUploadedImage(this, 'site-favicon-preview-img', 'site-favicon-fallback', 'remove-favicon-btn', 'remove_site_favicon')" class="w-full text-xs text-slate-400 file:mr-0 file:ml-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-500/20 file:text-amber-400 hover:file:bg-amber-500/30 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl p-1.5">
                        </div>

                        <!-- Or External URL -->
                        <div class="space-y-1.5">
                            <label for="site_favicon" class="block text-xs font-medium text-slate-400">أو رابط مباشر للأيقونة (URL)</label>
                            <input type="url" id="site_favicon" name="site_favicon" value="{{ \App\Models\Setting::get('site_favicon') }}" placeholder="https://example.com/favicon.png" dir="ltr" oninput="previewUrlImage(this.value, 'site-favicon-preview-img', 'site-favicon-fallback', 'remove-favicon-btn', 'remove_site_favicon')" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-amber-400 focus:outline-none text-right">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. General Info & Identity -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    المعلومات العامة والهوية الأساسية
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="space-y-1.5 sm:col-span-1">
                        <label for="site_name" class="block text-xs font-bold text-slate-300">اسم المحل / المركز</label>
                        <input type="text" id="site_name" name="site_name" value="{{ \App\Models\Setting::get('site_name', 'مفتاح باب البستان') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5 sm:col-span-1">
                        <label for="city_name" class="block text-xs font-bold text-amber-400">المدينة الرئيسية (نطاق العمل الأساسي)</label>
                        <input type="text" id="city_name" name="city_name" value="{{ \App\Models\Setting::get('city_name', 'جدة') }}" placeholder="مثال: جدة أو مكة أو الرياض" class="w-full bg-slate-950 border border-amber-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <p class="text-[11px] text-slate-400">تُستبدل تلقائياً في كافة نصوص وهوية الموقع وشريط الطوارئ.</p>
                    </div>

                    <div class="space-y-1.5 sm:col-span-1">
                        <label for="site_tagline" class="block text-xs font-bold text-slate-300">الشعار اللفظي (Tagline)</label>
                        <input type="text" id="site_tagline" name="site_tagline" value="{{ \App\Models\Setting::get('site_tagline') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- 3. Advanced SEO & Social Optimization -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center justify-between border-b border-slate-800 pb-4">
                    <span class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        إعدادات محركات البحث والظهور الرقمي (SEO & Social Cards)
                    </span>
                    <span class="text-xs text-emerald-400 font-normal">Google, Meta, Twitter/X, Schema.org</span>
                </h3>

                <!-- Meta Description with Character Counter -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="meta_description" class="block text-xs font-bold text-slate-200">
                            وصف الموقع التعريفي لمحركات البحث (Meta Description)
                        </label>
                        <span id="meta-desc-counter" class="text-[11px] font-mono text-slate-400">0 / 160 حرف</span>
                    </div>
                    <textarea id="meta_description" name="meta_description" rows="3" oninput="updateCharCounter(this, 'meta-desc-counter', 160)" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none leading-relaxed">{{ \App\Models\Setting::get('meta_description') }}</textarea>
                    <p class="text-[11px] text-slate-400">هذا النص يظهر مباشرة كملخص للموقع في صفحة نتائج بحث Google. يوصى بطول بين 140 إلى 160 حرفاً شاملاً كلماتك المفتاحية.</p>
                </div>

                <!-- Keywords & Alternate Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="meta_keywords" class="block text-xs font-bold text-slate-200">الكلمات المفتاحية لموقع الويب (Meta Keywords)</label>
                        <textarea id="meta_keywords" name="meta_keywords" rows="3" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none" placeholder="مثال: قص مفاتيح جدة, برمجة مفاتيح سيارات, فتح اقفال منازل...">{{ \App\Models\Setting::get('meta_keywords', 'قص مفاتيح جدة, برمجة مفاتيح سيارات جدة, فتح ابواب منازل طوارئ, فتح سيارات مقفلة, صب مفاتيح جدة, اقفال ذكية جدة, مفاتيح سيارات مشفرة, ريموت بصمة, نجار فتح اقفال 24 ساعة, فني مفاتيح شمال جدة') }}</textarea>
                        <p class="text-[11px] text-slate-500">افصل بين الكلمات بفواصل لتغذية محركات البحث بفهرس خدماتك.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="seo_alternate_name" class="block text-xs font-bold text-slate-200">الاسم التجاري البديل في السكيما (Schema Alternate Name)</label>
                        <input type="text" id="seo_alternate_name" name="seo_alternate_name" value="{{ \App\Models\Setting::get('seo_alternate_name', 'محل ومختبر مفتاح باب البستان لقص وبرمجة المفاتيح بجدة') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none">
                        <p class="text-[11px] text-slate-500">الاسم التعريفي الكامل لنشاطك التجاري في بيانات Schema.org الغنية لتعزيز الظهور المحلي.</p>
                    </div>
                </div>

                <!-- Robots & Verification & Analytics -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-2">
                    <div class="space-y-1.5">
                        <label for="seo_robots" class="block text-xs font-bold text-slate-200">توجيهات أرشفة روبوتات البحث (Robots Meta)</label>
                        <select id="seo_robots" name="seo_robots" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none">
                            <option value="index, follow" {{ \App\Models\Setting::get('seo_robots', 'index, follow') === 'index, follow' ? 'selected' : '' }}>
                                ✅ السماح بالفهرسة الكاملة (index, follow - موصى به)
                            </option>
                            <option value="noindex, nofollow" {{ \App\Models\Setting::get('seo_robots') === 'noindex, nofollow' ? 'selected' : '' }}>
                                🚫 حجب الفهرسة مؤقتاً (noindex, nofollow)
                            </option>
                        </select>
                        <p class="text-[11px] text-slate-500">تحكم بما إذا كان محرك البحث Google يقوم بأرشفة صفحات موقعك.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="google_site_verification" class="block text-xs font-bold text-slate-200">رمز التحقق من Google Search Console</label>
                        <input type="text" id="google_site_verification" name="google_site_verification" value="{{ \App\Models\Setting::get('google_site_verification') }}" placeholder="مثال: google-site-verification code" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm font-mono focus:border-emerald-400 focus:outline-none text-right">
                        <p class="text-[11px] text-slate-500">أدخل كود التحقق لإثبات ملكية موقعك في أدوات مشرفي المواقع.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="google_analytics_id" class="block text-xs font-bold text-slate-200">معرف Google Analytics 4 (GA4)</label>
                        <input type="text" id="google_analytics_id" name="google_analytics_id" value="{{ \App\Models\Setting::get('google_analytics_id') }}" placeholder="G-XXXXXXXXXX" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm font-mono focus:border-emerald-400 focus:outline-none text-right">
                        <p class="text-[11px] text-slate-500">تتبع زوار موقعك ومصادر الزيارات تلقائياً عند وضع المعرف.</p>
                    </div>
                </div>

                <!-- Social Share Image (OG Image) with Live Card Preview -->
                <div class="p-5 rounded-2xl bg-slate-950/70 border border-slate-800 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-white flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            صورة المشاركة في وسائل التواصل (OG Image / Social Share)
                        </label>
                        <span class="text-[11px] text-slate-400">المقاس الموصى به: 1200×630 بكسل</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div class="space-y-3">
                            <div class="space-y-1.5">
                                <label for="og_image_file" class="block text-xs font-medium text-slate-300">رفع صورة جديدة من جهازك</label>
                                <input type="file" id="og_image_file" name="og_image_file" accept="image/png,image/jpeg,image/webp" onchange="previewUploadedImage(this, 'og-image-preview-img', null, 'remove-og-btn', 'remove_og_image')" class="w-full text-xs text-slate-400 file:mr-0 file:ml-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-500/20 file:text-emerald-400 hover:file:bg-emerald-500/30 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl p-1.5">
                            </div>

                            <div class="space-y-1.5">
                                <label for="og_image" class="block text-xs font-medium text-slate-400">أو رابط مباشر لصورة المشاركة (URL)</label>
                                <input type="url" id="og_image" name="og_image" value="{{ \App\Models\Setting::get('og_image') }}" placeholder="https://example.com/share-image.jpg" dir="ltr" oninput="previewUrlImage(this.value, 'og-image-preview-img', null, 'remove-og-btn', 'remove_og_image')" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-white text-xs font-mono focus:border-emerald-400 focus:outline-none text-right">
                            </div>

                            <button type="button" onclick="clearOgImage()" id="remove-og-btn" class="inline-flex items-center gap-1 text-[11px] text-red-400 hover:text-red-300 font-bold transition-colors {{ empty(\App\Models\Setting::get('og_image')) ? 'hidden' : '' }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                إعادة تعيين صورة المشاركة الافتراضية
                            </button>
                            <input type="hidden" name="remove_og_image" id="remove_og_image" value="0">
                        </div>

                        <!-- Card Mockup Preview (Simulates WhatsApp / Twitter card) -->
                        <div class="rounded-2xl border border-slate-800 bg-slate-900 overflow-hidden shadow-xl">
                            <div class="h-32 bg-slate-950 overflow-hidden relative flex items-center justify-center">
                                <img src="{{ \App\Models\Setting::get('og_image', 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80') }}" id="og-image-preview-img" alt="معاينة بطاقة المشاركة" class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2 px-2 py-0.5 rounded-md bg-slate-950/80 text-[10px] font-bold text-emerald-400 border border-emerald-500/30">
                                    معاينة المشاركة في WhatsApp و X
                                </div>
                            </div>
                            <div class="p-3 space-y-1 bg-slate-900/90 border-t border-slate-800">
                                <div class="text-[11px] font-mono text-emerald-400">{{ url('/') }}</div>
                                <div class="text-xs font-bold text-white truncate">{{ \App\Models\Setting::get('site_name', 'مفتاح باب البستان') }} | خدمات المفاتيح</div>
                                <div class="text-[11px] text-slate-400 line-clamp-1 truncate">{{ \App\Models\Setting::get('meta_description') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Accounts for Schema sameAs -->
                <div class="pt-2 border-t border-slate-800 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-white flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            حسابات التواصل الاجتماعي لتعزيز موثوقية السكيما (Schema sameAs Links)
                        </label>
                        <span class="text-[11px] text-slate-500">تربط الموقع بكيانات النشاط التجاري الرسمية في Google</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="space-y-1">
                            <label for="social_twitter" class="block text-[11px] font-bold text-slate-400">منصة X (تويتر)</label>
                            <input type="url" id="social_twitter" name="social_twitter" value="{{ \App\Models\Setting::get('social_twitter') }}" placeholder="https://x.com/..." dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white text-xs font-mono focus:border-emerald-400 focus:outline-none text-right">
                        </div>

                        <div class="space-y-1">
                            <label for="social_instagram" class="block text-[11px] font-bold text-slate-400">انستغرام</label>
                            <input type="url" id="social_instagram" name="social_instagram" value="{{ \App\Models\Setting::get('social_instagram') }}" placeholder="https://instagram.com/..." dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white text-xs font-mono focus:border-emerald-400 focus:outline-none text-right">
                        </div>

                        <div class="space-y-1">
                            <label for="social_tiktok" class="block text-[11px] font-bold text-slate-400">تيك توك</label>
                            <input type="url" id="social_tiktok" name="social_tiktok" value="{{ \App\Models\Setting::get('social_tiktok') }}" placeholder="https://tiktok.com/@..." dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white text-xs font-mono focus:border-emerald-400 focus:outline-none text-right">
                        </div>

                        <div class="space-y-1">
                            <label for="social_snapchat" class="block text-[11px] font-bold text-slate-400">سناب شات</label>
                            <input type="url" id="social_snapchat" name="social_snapchat" value="{{ \App\Models\Setting::get('social_snapchat') }}" placeholder="https://snapchat.com/add/..." dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white text-xs font-mono focus:border-emerald-400 focus:outline-none text-right">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Coverage & Field Service Scope -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    نطاق التغطية والخدمات الميدانية
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="coverage_areas" class="block text-xs font-bold text-slate-300">أحياء ونطاق التغطية الفورية (تظهر في كرت الطوارئ بالهيرو)</label>
                        <textarea id="coverage_areas" name="coverage_areas" rows="2" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: الروضة • السلامة • الزهراء • الشاطئ • الحمراء • المروة • الصفا • أبحر">{{ \App\Models\Setting::get('coverage_areas', 'الروضة • السلامة • الزهراء • الشاطئ • الحمراء • المروة • الصفا • أبحر') }}</textarea>
                        <p class="text-[11px] text-slate-400">افصل بين الأحياء بنقطة أو فاصلة لتظهر بشكل متناسق في شريط التغطية الحي.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="coverage_note" class="block text-xs font-bold text-slate-300">ملاحظة تغطية شريط الطوارئ العلوي</label>
                        <input type="text" id="coverage_note" name="coverage_note" value="{{ \App\Models\Setting::get('coverage_note', 'ورش متنقلة وفنيون مرخصون لجميع الأحياء والمناطق') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <p class="text-[11px] text-slate-400">تظهر في الشريط البرتقالي بأعلى الصفحة لجذب انتباه العميل للخدمة السريعة.</p>
                    </div>
                </div>
            </div>

            <!-- 5. Contact Numbers & Emergency -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                    أرقام الاتصال وخطوط الطوارئ 24/7
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="emergency_phone" class="block text-xs font-bold text-red-400">رقم خط الطوارئ السريع (24 ساعة)</label>
                        <input type="text" id="emergency_phone" name="emergency_phone" value="{{ \App\Models\Setting::get('emergency_phone', '0559998877') }}" dir="ltr" class="w-full bg-slate-950 border border-red-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-red-400 focus:outline-none text-right font-mono">
                    </div>

                    <div class="space-y-1.5">
                        <label for="phone" class="block text-xs font-bold text-slate-300">رقم الهاتف الأرضي أو الثابت</label>
                        <input type="text" id="phone" name="phone" value="{{ \App\Models\Setting::get('phone', '0551234567') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-right font-mono">
                    </div>

                    <div class="space-y-1.5">
                        <label for="whatsapp" class="block text-xs font-bold text-emerald-400">رقم الواتساب (مع الرمز الدولي بدون +)</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ \App\Models\Setting::get('whatsapp', '966551234567') }}" dir="ltr" class="w-full bg-slate-950 border border-emerald-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none text-right font-mono" placeholder="966551234567">
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-300">البريد الإلكتروني الرسمي</label>
                        <input type="email" id="email" name="email" value="{{ \App\Models\Setting::get('email', 'info@keyshop.com') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-right">
                    </div>
                </div>
            </div>

            <!-- 6. Address, Google Maps & Navigation -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center justify-between border-b border-slate-800 pb-4">
                    <span class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span>
                        العنوان وموقع خريطة قوقل والاتجاهات (Google Maps & Navigation)
                    </span>
                    <span class="text-xs text-blue-400 font-normal">دعم الإحداثيات والرابط المباشر</span>
                </h3>

                <div class="space-y-1.5">
                    <label for="address" class="block text-xs font-bold text-slate-300">العنوان التفصيلي للمحل أو المعرض</label>
                    <input type="text" id="address" name="address" value="{{ \App\Models\Setting::get('address') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="working_hours" class="block text-xs font-bold text-slate-300">ساعات الدوام والعمل</label>
                    <input type="text" id="working_hours" name="working_hours" value="{{ \App\Models\Setting::get('working_hours') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <!-- Google Maps & Directions Integration -->
                <div class="p-5 rounded-2xl bg-slate-950 border border-blue-500/20 space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-bold text-blue-300 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            إعدادات زر الملاحة والاتجاهات (Google Maps Directions)
                        </h4>
                        <span class="text-[11px] text-slate-400">تفتح الملاحة فوراً للعميل في خرائط قوقل</span>
                    </div>

                    <div class="space-y-1.5">
                        <label for="map_directions_url" class="block text-xs font-bold text-slate-300">
                            رابط الملاحة المباشر لخرائط Google (اختياري - في حال رغبت برابط مخصص محدد)
                        </label>
                        <input type="url" id="map_directions_url" name="map_directions_url" value="{{ \App\Models\Setting::get('map_directions_url') }}" dir="ltr" placeholder="https://maps.app.goo.gl/... أو رابط الموقع في Google Maps" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-blue-400 focus:outline-none text-right">
                        <p class="text-[11px] text-slate-500">إذا تُرك فارغاً، سيقوم النظام تلقائياً بتوليد رابط ملاحة دقيق يعتمد على خطوط الطول والعرض أدناه.</p>
                    </div>

                    <!-- Coordinates Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div class="space-y-1.5">
                            <label for="map_latitude" class="block text-xs font-bold text-slate-300">
                                خط العرض (Latitude)
                            </label>
                            <input type="text" id="map_latitude" name="map_latitude" value="{{ \App\Models\Setting::get('map_latitude', '21.543333') }}" dir="ltr" placeholder="مثال: 21.543333" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:border-blue-400 focus:outline-none text-right">
                        </div>

                        <div class="space-y-1.5">
                            <label for="map_longitude" class="block text-xs font-bold text-slate-300">
                                خط الطول (Longitude)
                            </label>
                            <input type="text" id="map_longitude" name="map_longitude" value="{{ \App\Models\Setting::get('map_longitude', '39.172778') }}" dir="ltr" placeholder="مثال: 39.172778" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:border-blue-400 focus:outline-none text-right">
                        </div>
                    </div>

                    <!-- Quick Tools Actions -->
                    <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-800/80">
                        <button type="button" onclick="extractCoordsFromEmbed()" class="text-xs font-bold px-3 py-1.5 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/30 transition-colors inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                            استخراج الإحداثيات تلقائياً من رابط التضمين أدناه
                        </button>

                        <button type="button" onclick="generateDirectionsUrl()" class="text-xs font-bold px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 transition-colors inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            توليد رابط الاتجاهات من الإحداثيات
                        </button>

                        <a id="preview-directions-btn" href="{{ \App\Models\Setting::getDirectionsUrl() }}" target="_blank" class="text-xs font-bold px-3 py-1.5 rounded-lg bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 transition-colors inline-flex items-center gap-1.5 mr-auto">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            معاينة فتح الخريطة والاتجاهات
                        </a>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="google_map_embed" class="block text-xs font-bold text-slate-300">رابط تضمين خريطة قوقل (Google Maps Embed URL)</label>
                    <textarea id="google_map_embed" name="google_map_embed" rows="3" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-xs font-mono focus:border-amber-400 focus:outline-none">{{ \App\Models\Setting::get('google_map_embed') }}</textarea>
                    <p class="text-[11px] text-slate-500">انسخ رابط src من كود التضمين في قوقل ماب وضعه هنا، أو دعه فارغاً وسيتم عرضه تلقائياً من الإحداثيات.</p>
                </div>
            </div>

            <!-- 7. Stats & Trust -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    أرقام وإحصائيات الثقة
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="space-y-1.5">
                        <label for="years_experience" class="block text-xs font-bold text-slate-300">سنوات الخبرة</label>
                        <input type="text" id="years_experience" name="years_experience" value="{{ \App\Models\Setting::get('years_experience', '15+') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                    <div class="space-y-1.5">
                        <label for="arrival_time" class="block text-xs font-bold text-slate-300">سرعة الوصول للطوارئ</label>
                        <input type="text" id="arrival_time" name="arrival_time" value="{{ \App\Models\Setting::get('arrival_time', '15 - 25 دقيقة') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                    <div class="space-y-1.5">
                        <label for="happy_clients" class="block text-xs font-bold text-slate-300">العملاء المخدومين</label>
                        <input type="text" id="happy_clients" name="happy_clients" value="{{ \App\Models\Setting::get('happy_clients', '18,500+') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                    <div class="space-y-1.5">
                        <label for="team_size" class="block text-xs font-bold text-slate-300">عدد الفنيين</label>
                        <input type="text" id="team_size" name="team_size" value="{{ \App\Models\Setting::get('team_size', '12 فني') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-2">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm transition-colors shadow-xl shadow-amber-500/20 active:scale-95">
                    حفظ كافة الإعدادات وتحديث الموقع
                </button>
            </div>
        </form>

    </div>

    <!-- Client-side helper scripts for Logo, Favicon, OG Image & Maps -->
    <script>
        function previewUploadedImage(input, imgId, fallbackId, removeBtnId, removeFlagId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(imgId);
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                    if (fallbackId) {
                        const fallback = document.getElementById(fallbackId);
                        if (fallback) fallback.classList.add('hidden');
                    }
                    if (removeBtnId) {
                        const btn = document.getElementById(removeBtnId);
                        if (btn) btn.classList.remove('hidden');
                    }
                    if (removeFlagId) {
                        const flag = document.getElementById(removeFlagId);
                        if (flag) flag.value = "0";
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewUrlImage(url, imgId, fallbackId, removeBtnId, removeFlagId) {
            const img = document.getElementById(imgId);
            if (!img) return;

            if (url && url.trim().length > 5) {
                img.src = url.trim();
                img.classList.remove('hidden');
                if (fallbackId) {
                    const fallback = document.getElementById(fallbackId);
                    if (fallback) fallback.classList.add('hidden');
                }
                if (removeBtnId) {
                    const btn = document.getElementById(removeBtnId);
                    if (btn) btn.classList.remove('hidden');
                }
                if (removeFlagId) {
                    const flag = document.getElementById(removeFlagId);
                    if (flag) flag.value = "0";
                }
            }
        }

        function clearSiteLogo() {
            const img = document.getElementById('site-logo-preview-img');
            const fallback = document.getElementById('site-logo-fallback');
            const fileInput = document.getElementById('site_logo_file');
            const urlInput = document.getElementById('site_logo');
            const removeBtn = document.getElementById('remove-logo-btn');
            const removeFlag = document.getElementById('remove_site_logo');

            if (img) {
                img.src = '';
                img.classList.add('hidden');
            }
            if (fallback) fallback.classList.remove('hidden');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = '';
            if (removeBtn) removeBtn.classList.add('hidden');
            if (removeFlag) removeFlag.value = '1';
        }

        function clearSiteFavicon() {
            const img = document.getElementById('site-favicon-preview-img');
            const fallback = document.getElementById('site-favicon-fallback');
            const fileInput = document.getElementById('site_favicon_file');
            const urlInput = document.getElementById('site_favicon');
            const removeBtn = document.getElementById('remove-favicon-btn');
            const removeFlag = document.getElementById('remove_site_favicon');

            if (img) {
                img.src = '';
                img.classList.add('hidden');
            }
            if (fallback) fallback.classList.remove('hidden');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = '';
            if (removeBtn) removeBtn.classList.add('hidden');
            if (removeFlag) removeFlag.value = '1';
        }

        function clearOgImage() {
            const img = document.getElementById('og-image-preview-img');
            const fileInput = document.getElementById('og_image_file');
            const urlInput = document.getElementById('og_image');
            const removeBtn = document.getElementById('remove-og-btn');
            const removeFlag = document.getElementById('remove_og_image');

            const defaultOg = 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80';
            if (img) img.src = defaultOg;
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = defaultOg;
            if (removeBtn) removeBtn.classList.add('hidden');
            if (removeFlag) removeFlag.value = '1';
        }

        function updateCharCounter(textarea, counterId, max) {
            const counter = document.getElementById(counterId);
            if (!counter) return;
            const len = textarea.value.length;
            counter.textContent = `${len} / ${max} حرف`;
            if (len > max) {
                counter.classList.add('text-amber-400');
                counter.classList.remove('text-slate-400');
            } else {
                counter.classList.remove('text-amber-400');
                counter.classList.add('text-slate-400');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const metaDesc = document.getElementById('meta_description');
            if (metaDesc) updateCharCounter(metaDesc, 'meta-desc-counter', 160);
        });

        function extractCoordsFromEmbed() {
            const embedInput = document.getElementById('google_map_embed');
            if (!embedInput) return;

            const text = embedInput.value;
            const match = text.match(/!2d([0-9\.\-]+)!3d([0-9\.\-]+)/);

            if (match && match.length >= 3) {
                const lng = match[1];
                const lat = match[2];
                document.getElementById('map_longitude').value = lng;
                document.getElementById('map_latitude').value = lat;

                updatePreviewUrl(lat, lng);
                alert(`تم استخراج الإحداثيات بنجاح!\nخط العرض (Lat): ${lat}\nخط الطول (Lng): ${lng}`);
            } else {
                alert('لم يتم العثور على إحداثيات صريحة داخل كود التضمين. يمكنك إدخال خطوط الطول والعرض يدوياً.');
            }
        }

        function generateDirectionsUrl() {
            const lat = document.getElementById('map_latitude')?.value.trim();
            const lng = document.getElementById('map_longitude')?.value.trim();

            if (lat && lng) {
                const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                document.getElementById('map_directions_url').value = url;
                updatePreviewUrl(lat, lng);
                alert('تم توليد رابط الملاحة والاتجاهات المباشر بنجاح!');
            } else {
                alert('يرجى كتابة خط العرض وخط الطول أولاً لتوليد الرابط.');
            }
        }

        function updatePreviewUrl(lat, lng) {
            const previewBtn = document.getElementById('preview-directions-btn');
            if (previewBtn && lat && lng) {
                previewBtn.href = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            }
        }
    </script>

@endsection
