@props([
    'active' => false,
])

<div id="tab-panel-seo" class="tab-panel {{ $active ? '' : 'hidden' }}">
    <form action="{{ route('admin.settings.update-tab', ['tab' => 'seo']) }}" method="POST"
        enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                    <h3 class="text-base font-bold text-white">إعدادات محركات البحث والظهور الرقمي (SEO & Social Cards)
                    </h3>
                </div>
                <span class="text-xs text-emerald-400 font-medium">Google Search, WhatsApp Previews, Twitter/X
                    Cards</span>
            </div>

            <!-- Meta Description with Character Counter -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label for="meta_description" class="block text-xs font-bold text-slate-200">
                        وصف الموقع التعريفي لمحركات البحث (Meta Description)
                    </label>
                    <span id="meta-desc-counter" class="text-[11px] font-mono text-slate-400">0 / 160 حرف</span>
                </div>
                <textarea id="meta_description" name="meta_description" rows="3"
                    oninput="updateCharCounter(this, 'meta-desc-counter', 160)"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none leading-relaxed">{{ \App\Models\Setting::get('meta_description') }}</textarea>
                <p class="text-[11px] text-slate-400">هذا النص يظهر كملخص للموقع في صفحة نتائج بحث Google. يوصى بطول بين
                    140 إلى 160 حرفاً شاملاً كلماتك المفتاحية.</p>
            </div>

            <!-- Keywords & Alternate Name -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label for="meta_keywords" class="block text-xs font-bold text-slate-200">الكلمات المفتاحية لموقع
                        الويب (Meta Keywords)</label>
                    <textarea id="meta_keywords" name="meta_keywords" rows="3"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none"
                        placeholder="مثال: قص مفاتيح جدة, برمجة مفاتيح سيارات, فتح اقفال منازل...">{{ \App\Models\Setting::get('meta_keywords', 'قص مفاتيح جدة, برمجة مفاتيح سيارات جدة, فتح ابواب منازل طوارئ, فتح سيارات مقفلة, صب مفاتيح جدة, اقفال ذكية جدة, مفاتيح سيارات مشفرة, ريموت بصمة, نجار فتح اقفال 24 ساعة, فني مفاتيح شمال جدة') }}</textarea>
                    <p class="text-[11px] text-slate-500">افصل بين الكلمات بفواصل لتغذية محركات البحث بفهرس خدماتك.</p>
                </div>

                <div class="space-y-1.5">
                    <label for="seo_alternate_name" class="block text-xs font-bold text-slate-200">الاسم التجاري البديل
                        في السكيما (Schema Alternate Name)</label>
                    <input type="text" id="seo_alternate_name" name="seo_alternate_name"
                        value="{{ \App\Models\Setting::get('seo_alternate_name', 'محل مفتاح الإبداع لقص وبرمجة المفاتيح بجدة') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none">
                    <p class="text-[11px] text-slate-500">الاسم التعريفي الكامل لنشاطك التجاري في بيانات Schema.org
                        الغنية لتعزيز الظهور المحلي.</p>
                </div>
            </div>

            <!-- Robots & Verification & Analytics -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-2">
                <div class="space-y-1.5">
                    <label for="seo_robots" class="block text-xs font-bold text-slate-200">توجيهات أرشفة روبوتات البحث
                        (Robots Meta)</label>
                    <select id="seo_robots" name="seo_robots"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none">
                        <option value="index, follow" {{ \App\Models\Setting::get('seo_robots', 'index, follow') === 'index, follow' ? 'selected' : '' }}>
                            ✅ السماح بالفهرسة الكاملة (index, follow - موصى به)
                        </option>
                        <option value="noindex, nofollow" {{ \App\Models\Setting::get('seo_robots') === 'noindex, nofollow' ? 'selected' : '' }}>
                            🚫 حجب الفهرسة مؤقتاً (noindex, nofollow)
                        </option>
                    </select>
                    <p class="text-[11px] text-slate-500">تحكم بما إذا كان محرك البحث Google يقوم بأرشفة صفحات موقعك.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <label for="google_site_verification" class="block text-xs font-bold text-slate-200">رمز التحقق من
                        Google Search Console</label>
                    <input type="text" id="google_site_verification" name="google_site_verification"
                        value="{{ \App\Models\Setting::get('google_site_verification') }}"
                        placeholder="مثال: google-site-verification code" dir="ltr"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm font-mono focus:border-emerald-400 focus:outline-none text-right">
                    <p class="text-[11px] text-slate-500">أدخل كود التحقق لإثبات ملكية موقعك في أدوات مشرفي المواقع.</p>
                </div>

                <div class="space-y-1.5">
                    <label for="google_analytics_id" class="block text-xs font-bold text-slate-200">معرف Google
                        Analytics 4 (GA4)</label>
                    <input type="text" id="google_analytics_id" name="google_analytics_id"
                        value="{{ \App\Models\Setting::get('google_analytics_id') }}" placeholder="G-XXXXXXXXXX"
                        dir="ltr"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm font-mono focus:border-emerald-400 focus:outline-none text-right">
                    <p class="text-[11px] text-slate-500">تتبع زوار موقعك ومصادر الزيارات تلقائياً عند وضع المعرف.</p>
                </div>
            </div>

            <!-- Social Share Image (OG Image) with Live Card Preview -->
            <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800 space-y-4">
                <div class="flex items-center justify-between">
                    <label class="text-xs font-bold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        صورة المشاركة في وسائل التواصل (OG Image / Social Share)
                    </label>
                    <span class="text-[11px] text-slate-400">المقاس الموصى به: 1200×630 بكسل</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <div class="space-y-3">
                        <div class="space-y-1.5">
                            <label for="og_image_file" class="block text-xs font-medium text-slate-300">رفع صورة جديدة
                                من جهازك</label>
                            <input type="file" id="og_image_file" name="og_image_file"
                                accept="image/png,image/jpeg,image/webp"
                                onchange="previewUploadedImage(this, 'og-image-preview-img', null, 'remove-og-btn', 'remove_og_image')"
                                class="w-full text-xs text-slate-400 file:mr-0 file:ml-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-500/20 file:text-emerald-400 hover:file:bg-emerald-500/30 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl p-1.5">
                        </div>

                        <div class="space-y-1.5">
                            <label for="og_image" class="block text-xs font-medium text-slate-400">أو رابط مباشر لصورة
                                المشاركة (URL)</label>
                            <input type="url" id="og_image" name="og_image"
                                value="{{ \App\Models\Setting::get('og_image') }}"
                                placeholder="https://example.com/share-image.jpg" dir="ltr"
                                oninput="previewUrlImage(this.value, 'og-image-preview-img', null, 'remove-og-btn', 'remove_og_image')"
                                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2 text-white text-xs font-mono focus:border-emerald-400 focus:outline-none text-right">
                        </div>

                        <button type="button" onclick="clearOgImage()" id="remove-og-btn"
                            class="inline-flex items-center gap-1 text-[11px] text-red-400 hover:text-red-300 font-bold transition-colors {{ empty(\App\Models\Setting::get('og_image')) ? 'hidden' : '' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            إعادة تعيين صورة المشاركة الافتراضية
                        </button>
                        <input type="hidden" name="remove_og_image" id="remove_og_image" value="0">
                    </div>

                    <!-- Card Mockup Preview (Simulates WhatsApp / Twitter card) -->
                    <div class="rounded-2xl border border-slate-800 bg-slate-900 overflow-hidden shadow-xl">
                        <div class="h-32 bg-slate-950 overflow-hidden relative flex items-center justify-center">
                            <img src="{{ \App\Models\Setting::get('og_image', 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80') }}"
                                id="og-image-preview-img" alt="معاينة بطاقة المشاركة"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute top-2 right-2 px-2 py-0.5 rounded-md bg-slate-950/80 text-[10px] font-bold text-emerald-400 border border-emerald-500/30">
                                معاينة المشاركة في WhatsApp و X
                            </div>
                        </div>
                        <div class="p-3 space-y-1 bg-slate-900/90 border-t border-slate-800">
                            <div class="text-[11px] font-mono text-emerald-400">{{ url('/') }}</div>
                            <div class="text-xs font-bold text-white truncate">
                                {{ \App\Models\Setting::get('site_name', 'مفتاح الإبداع') }} | خدمات المفاتيح
                            </div>
                            <div class="text-[11px] text-slate-400 line-clamp-1 truncate">
                                {{ \App\Models\Setting::get('meta_description') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button for SEO -->
        <div class="flex items-center justify-between p-4 bg-slate-900/60 border border-slate-800 rounded-2xl">
            <span class="text-xs text-slate-400">تحديث فوري لبيانات الميتا تاغ وسكيما محركات البحث وكروت
                المشاركة.</span>
            <button type="submit"
                class="px-8 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-black text-sm transition-all shadow-lg shadow-emerald-500/20 active:scale-95 inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                حفظ إعدادات محركات البحث (SEO)
            </button>
        </div>
    </form>
</div>