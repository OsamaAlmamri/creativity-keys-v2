@props([
    'active' => false,
])

<div id="tab-panel-branding" class="tab-panel {{ $active ? '' : 'hidden' }}">
    <form action="{{ route('admin.settings.update-tab', ['tab' => 'branding']) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Logo & Favicon Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                    <h3 class="text-base font-bold text-white">شعار الموقع والهوية البصرية (Logo & Favicon)</h3>
                </div>
                <span class="text-xs text-amber-400 font-medium">يدعم الرفع المباشر للملفات أو وضع رابط خارجي URL</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                <!-- Site Logo Section -->
                <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold text-white flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            شعار الموقع الرسمي (Site Logo)
                        </label>
                        <span class="text-[11px] text-slate-500">يظهر في الهيدر والفوتر واللوحة</span>
                    </div>

                    <!-- Current Logo Preview Box -->
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-900 border border-slate-800/80">
                        <div class="w-24 h-16 rounded-xl bg-slate-950/80 border border-slate-800 flex items-center justify-center p-2 relative overflow-hidden shrink-0"
                            id="site-logo-preview-box">
                            @if(!empty(\App\Models\Setting::get('site_logo')))
                                <img src="{{ \App\Models\Setting::get('site_logo') }}" id="site-logo-preview-img"
                                    alt="شعار الموقع" class="max-h-full max-w-full object-contain">
                                <div id="site-logo-fallback"
                                    class="text-center text-slate-600 text-[10px] hidden flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-amber-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    <span>الأيقونة الافتراضية</span>
                                </div>
                            @else
                                <img src="" id="site-logo-preview-img" alt="شعار الموقع"
                                    class="max-h-full max-w-full object-contain hidden">
                                <div id="site-logo-fallback"
                                    class="text-center text-slate-600 text-[10px] flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-amber-500/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    <span>الأيقونة الافتراضية</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-1">
                            <div class="text-xs font-bold text-white">معاينة الشعار الحالية</div>
                            <p class="text-[11px] text-slate-400">يفضل صورة شفافة PNG أو SVG أو WebP بدقة 250×70 بكسل.</p>
                            <button type="button" onclick="clearSiteLogo()" id="remove-logo-btn"
                                class="inline-flex items-center gap-1 text-[11px] text-red-400 hover:text-red-300 font-bold transition-colors {{ empty(\App\Models\Setting::get('site_logo')) ? 'hidden' : '' }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                إزالة الشعار والعودة للأيقونة الافتراضية
                            </button>
                            <input type="hidden" name="remove_site_logo" id="remove_site_logo" value="0">
                        </div>
                    </div>

                    <!-- Upload File Input -->
                    <div class="space-y-1.5">
                        <label for="site_logo_file" class="block text-xs font-medium text-slate-300">رفع ملف شعار من جهازك</label>
                        <input type="file" id="site_logo_file" name="site_logo_file"
                            accept="image/png,image/jpeg,image/svg+xml,image/webp"
                            onchange="previewUploadedImage(this, 'site-logo-preview-img', 'site-logo-fallback', 'remove-logo-btn', 'remove_site_logo')"
                            class="w-full text-xs text-slate-400 file:mr-0 file:ml-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-500/20 file:text-amber-400 hover:file:bg-amber-500/30 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl p-1.5">
                    </div>

                    <!-- Or External URL -->
                    <div class="space-y-1.5">
                        <label for="site_logo" class="block text-xs font-medium text-slate-400">أو رابط مباشر للشعار (URL)</label>
                        <input type="url" id="site_logo" name="site_logo"
                            value="{{ \App\Models\Setting::get('site_logo') }}"
                            placeholder="https://example.com/logo.png" dir="ltr"
                            oninput="previewUrlImage(this.value, 'site-logo-preview-img', 'site-logo-fallback', 'remove-logo-btn', 'remove_site_logo')"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-amber-400 focus:outline-none text-right">
                    </div>
                </div>

                <!-- Favicon Section -->
                <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold text-white flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            أيقونة شريط المتصفح (Favicon)
                        </label>
                        <span class="text-[11px] text-slate-500">تظهر بتبويب المتصفح</span>
                    </div>

                    <!-- Current Favicon Box -->
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-900 border border-slate-800/80">
                        <div class="w-16 h-16 rounded-xl bg-slate-950/80 border border-slate-800 flex items-center justify-center p-2 relative overflow-hidden shrink-0"
                            id="site-favicon-preview-box">
                            @if(!empty(\App\Models\Setting::get('site_favicon')))
                                <img src="{{ \App\Models\Setting::get('site_favicon') }}" id="site-favicon-preview-img"
                                    alt="Favicon" class="w-8 h-8 object-contain">
                                <div id="site-favicon-fallback" class="text-amber-500 hidden">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </div>
                            @else
                                <img src="" id="site-favicon-preview-img" alt="Favicon"
                                    class="w-8 h-8 object-contain hidden">
                                <div id="site-favicon-fallback" class="text-amber-500">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-1">
                            <div class="text-xs font-bold text-white">أيقونة التبويب الحالية</div>
                            <p class="text-[11px] text-slate-400">يفضل ملف ICO أو PNG أو SVG بدقة 32×32 أو 64×64 بكسل.</p>
                            <button type="button" onclick="clearSiteFavicon()" id="remove-favicon-btn"
                                class="inline-flex items-center gap-1 text-[11px] text-red-400 hover:text-red-300 font-bold transition-colors {{ empty(\App\Models\Setting::get('site_favicon')) ? 'hidden' : '' }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                إزالة الأيقونة والعودة للأيقونة الافتراضية
                            </button>
                            <input type="hidden" name="remove_site_favicon" id="remove_site_favicon" value="0">
                        </div>
                    </div>

                    <!-- Upload Favicon Input -->
                    <div class="space-y-1.5">
                        <label for="site_favicon_file" class="block text-xs font-medium text-slate-300">رفع أيقونة من جهازك</label>
                        <input type="file" id="site_favicon_file" name="site_favicon_file"
                            accept=".ico,image/png,image/svg+xml"
                            onchange="previewUploadedImage(this, 'site-favicon-preview-img', 'site-favicon-fallback', 'remove-favicon-btn', 'remove_site_favicon')"
                            class="w-full text-xs text-slate-400 file:mr-0 file:ml-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-500/20 file:text-amber-400 hover:file:bg-amber-500/30 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl p-1.5">
                    </div>

                    <!-- Or External URL -->
                    <div class="space-y-1.5">
                        <label for="site_favicon" class="block text-xs font-medium text-slate-400">أو رابط مباشر للأيقونة (URL)</label>
                        <input type="url" id="site_favicon" name="site_favicon"
                            value="{{ \App\Models\Setting::get('site_favicon') }}"
                            placeholder="https://example.com/favicon.png" dir="ltr"
                            oninput="previewUrlImage(this.value, 'site-favicon-preview-img', 'site-favicon-fallback', 'remove-favicon-btn', 'remove_site_favicon')"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-amber-400 focus:outline-none text-right">
                    </div>
                </div>
            </div>
        </div>

        <!-- Identity Text Fields Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                المعلومات العامة والهوية الأساسية
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="space-y-1.5 sm:col-span-1">
                    <label for="site_name" class="block text-xs font-bold text-slate-300">اسم المحل / المركز <span class="text-red-400">*</span></label>
                    <input type="text" id="site_name" name="site_name" required
                        value="{{ \App\Models\Setting::get('site_name', 'مفتاح باب البستان') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5 sm:col-span-1">
                    <label for="city_name" class="block text-xs font-bold text-amber-400">المدينة الرئيسية (نطاق العمل الأساسي) <span class="text-red-400">*</span></label>
                    <input type="text" id="city_name" name="city_name" required
                        value="{{ \App\Models\Setting::get('city_name', 'جدة') }}"
                        placeholder="مثال: جدة أو مكة أو الرياض"
                        class="w-full bg-slate-950 border border-amber-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    <p class="text-[11px] text-slate-400">تُستبدل تلقائياً في كافة نصوص وهوية الموقع وشريط الطوارئ.</p>
                </div>

                <div class="space-y-1.5 sm:col-span-1">
                    <label for="site_tagline" class="block text-xs font-bold text-slate-300">الشعار اللفظي (Tagline)</label>
                    <input type="text" id="site_tagline" name="site_tagline"
                        value="{{ \App\Models\Setting::get('site_tagline') }}"
                        placeholder="مثال: قص وبرمجة المفاتيح الذكية"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Submit Button for Branding -->
        <div class="flex items-center justify-between p-4 bg-slate-900/60 border border-slate-800 rounded-2xl">
            <span class="text-xs text-slate-400">يتم حفظ وتطبيق التعديلات على الشعار واسم المركز والمدينة فورياً.</span>
            <button type="submit"
                class="px-8 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm transition-all shadow-lg shadow-amber-500/20 active:scale-95 inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                حفظ إعدادات الهوية والشعار
            </button>
        </div>
    </form>
</div>
