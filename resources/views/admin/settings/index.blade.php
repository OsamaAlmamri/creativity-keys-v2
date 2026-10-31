@extends('admin.layouts.app')

@section('page_title', 'إعدادات وبيانات المحل')

@section('content')

    <div class="max-w-4xl mx-auto space-y-8">
        
        <div>
            <h2 class="text-xl font-black text-white">إعدادات وبيانات المركز والموقع</h2>
            <p class="text-xs text-slate-400">تعديل بيانات المحل، المدينة، نطاق التغطية، خطوط الطوارئ، العنوان، وإحداثيات خريطة Google Maps</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8" id="settings-form">
            @csrf

            <!-- 1. General Info & Identity -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    المعلومات العامة والهوية
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="space-y-1.5 sm:col-span-1">
                        <label for="site_name" class="block text-xs font-bold text-slate-300">اسم المحل / المركز</label>
                        <input type="text" id="site_name" name="site_name" value="{{ \App\Models\Setting::get('site_name', 'مفاتيح الأمان الذهبية') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5 sm:col-span-1">
                        <label for="city_name" class="block text-xs font-bold text-amber-400">المدينة الرئيسية (نطاق العمل الأساسي)</label>
                        <input type="text" id="city_name" name="city_name" value="{{ \App\Models\Setting::get('city_name', 'الرياض') }}" placeholder="مثال: الرياض أو جدة أو الدمام" class="w-full bg-slate-950 border border-amber-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <p class="text-[11px] text-slate-400">تُستبدل تلقائياً في كافة نصوص وهوية الموقع وشريط الطوارئ.</p>
                    </div>

                    <div class="space-y-1.5 sm:col-span-1">
                        <label for="site_tagline" class="block text-xs font-bold text-slate-300">الشعار اللفظي (Tagline)</label>
                        <input type="text" id="site_tagline" name="site_tagline" value="{{ \App\Models\Setting::get('site_tagline') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="meta_description" class="block text-xs font-bold text-slate-300">وصف محركات البحث (SEO Meta Description)</label>
                    <textarea id="meta_description" name="meta_description" rows="2" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ \App\Models\Setting::get('meta_description') }}</textarea>
                </div>
            </div>

            <!-- 2. Coverage & Field Service Scope -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    نطاق التغطية والخدمات الميدانية
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="coverage_areas" class="block text-xs font-bold text-slate-300">أحياء ونطاق التغطية الفورية (تظهر في كرت الطوارئ بالهيرو)</label>
                        <textarea id="coverage_areas" name="coverage_areas" rows="2" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: النرجس • الملقا • العليا • الياسمين • حطين • الروضة • الشفا">{{ \App\Models\Setting::get('coverage_areas', 'النرجس • الملقا • العليا • الياسمين • حطين • الروضة • الشفا') }}</textarea>
                        <p class="text-[11px] text-slate-400">افصل بين الأحياء بنقطة أو فاصلة لتظهر بشكل متناسق في شريط التغطية الحي.</p>
                    </div>

                    <div class="space-y-1.5">
                        <label for="coverage_note" class="block text-xs font-bold text-slate-300">ملاحظة تغطية شريط الطوارئ العلوي</label>
                        <input type="text" id="coverage_note" name="coverage_note" value="{{ \App\Models\Setting::get('coverage_note', 'ورش متنقلة وفنيون مرخصون لجميع الأحياء والمناطق') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <p class="text-[11px] text-slate-400">تظهر في الشريط البرتقالي بأعلى الصفحة لجذب انتباه العميل للخدمة السريعة.</p>
                    </div>
                </div>
            </div>

            <!-- 3. Contact Numbers & Emergency -->
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

            <!-- 4. Address, Google Maps & Navigation -->
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
                <div class="p-5 rounded-2xl bg-slate-950/70 border border-blue-500/20 space-y-4">
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
                            <input type="text" id="map_latitude" name="map_latitude" value="{{ \App\Models\Setting::get('map_latitude', '24.713552') }}" dir="ltr" placeholder="مثال: 24.713552" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:border-blue-400 focus:outline-none text-right">
                        </div>

                        <div class="space-y-1.5">
                            <label for="map_longitude" class="block text-xs font-bold text-slate-300">
                                خط الطول (Longitude)
                            </label>
                            <input type="text" id="map_longitude" name="map_longitude" value="{{ \App\Models\Setting::get('map_longitude', '46.675296') }}" dir="ltr" placeholder="مثال: 46.675296" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:border-blue-400 focus:outline-none text-right">
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

            <!-- 5. Stats & Trust -->
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

    <!-- Client-side helper script for Maps Coordinates and Directions -->
    <script>
        function extractCoordsFromEmbed() {
            const embedInput = document.getElementById('google_map_embed');
            if (!embedInput) return;

            const text = embedInput.value;
            // Match standard Google Maps embed parameters: !2d[longitude]!3d[latitude]
            const match = text.match(/!2d([0-9\.\-]+)!3d([0-9\.\-]+)/);

            if (match && match.length >= 3) {
                const lng = match[1];
                const lat = match[2];
                document.getElementById('map_longitude').value = lng;
                document.getElementById('map_latitude').value = lat;

                // Update directions preview URL
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
