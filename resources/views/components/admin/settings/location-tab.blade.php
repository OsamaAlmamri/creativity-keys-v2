@props([
    'active' => false,
])

<div id="tab-panel-location" class="tab-panel {{ $active ? '' : 'hidden' }}">
    <form action="{{ route('admin.settings.update-tab', ['tab' => 'location']) }}" method="POST" class="space-y-8">
        @csrf

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-blue-400"></span>
                    <h3 class="text-base font-bold text-white">العنوان وموقع خريطة قوقل والاتجاهات (Google Maps &
                        Navigation)</h3>
                </div>
                <span class="text-xs text-blue-400 font-medium">دعم الإحداثيات الدقيقة والرابط المباشر وتضمين
                    الخريطة</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label for="address" class="block text-xs font-bold text-slate-300">العنوان التفصيلي للمحل أو
                        المعرض</label>
                    <input type="text" id="address" name="address" value="{{ \App\Models\Setting::get('address') }}"
                        placeholder="مثال: جدة - طريق الملك عبد العزيز - حي الشاطئ"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="working_hours" class="block text-xs font-bold text-slate-300">ساعات الدوام
                        والعمل</label>
                    <input type="text" id="working_hours" name="working_hours"
                        value="{{ \App\Models\Setting::get('working_hours') }}"
                        placeholder="خدمة الطوارئ: 24/7 | المعرض: 8 ص - 11 م"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>
            </div>

            <!-- Google Maps & Directions Integration -->
            <div class="p-5 rounded-2xl bg-slate-950 border border-blue-500/20 space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold text-blue-300 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        إعدادات زر الملاحة والاتجاهات (Google Maps Directions)
                    </h4>
                    <span class="text-[11px] text-slate-400">تفتح الملاحة فوراً للعميل في خرائط قوقل</span>
                </div>

                <div class="space-y-1.5">
                    <label for="map_directions_url" class="block text-xs font-bold text-slate-300">
                        رابط الملاحة المباشر لخرائط Google (اختياري - في حال رغبت برابط مخصص محدد)
                    </label>
                    <input type="url" id="map_directions_url" name="map_directions_url"
                        value="{{ \App\Models\Setting::get('map_directions_url') }}" dir="ltr"
                        placeholder="https://maps.app.goo.gl/... أو رابط الموقع في Google Maps"
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-blue-400 focus:outline-none text-right">
                    <p class="text-[11px] text-slate-500">إذا تُرك فارغاً، سيقوم النظام تلقائياً بتوليد رابط ملاحة دقيق
                        يعتمد على خطوط الطول والعرض أدناه.</p>
                </div>

                <!-- Coordinates Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    <div class="space-y-1.5">
                        <label for="map_latitude" class="block text-xs font-bold text-slate-300">خط العرض
                            (Latitude)</label>
                        <input type="text" id="map_latitude" name="map_latitude"
                            value="{{ \App\Models\Setting::get('map_latitude', '21.543333') }}" dir="ltr"
                            placeholder="مثال: 21.543333"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:border-blue-400 focus:outline-none text-right">
                    </div>

                    <div class="space-y-1.5">
                        <label for="map_longitude" class="block text-xs font-bold text-slate-300">خط الطول
                            (Longitude)</label>
                        <input type="text" id="map_longitude" name="map_longitude"
                            value="{{ \App\Models\Setting::get('map_longitude', '39.172778') }}" dir="ltr"
                            placeholder="مثال: 39.172778"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:border-blue-400 focus:outline-none text-right">
                    </div>
                </div>

                <!-- Quick Tools Actions -->
                <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-800/80">
                    <button type="button" onclick="extractCoordsFromEmbed()"
                        class="text-xs font-bold px-3 py-1.5 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/30 transition-colors inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        استخراج الإحداثيات تلقائياً من رابط التضمين أدناه
                    </button>

                    <button type="button" onclick="generateDirectionsUrl()"
                        class="text-xs font-bold px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 transition-colors inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        توليد رابط الاتجاهات من الإحداثيات
                    </button>

                    <a id="preview-directions-btn" href="{{ \App\Models\Setting::getDirectionsUrl() }}" target="_blank"
                        class="text-xs font-bold px-3 py-1.5 rounded-lg bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 transition-colors inline-flex items-center gap-1.5 mr-auto">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        معاينة فتح الخريطة والاتجاهات
                    </a>
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="google_map_embed" class="block text-xs font-bold text-slate-300">رابط تضمين خريطة قوقل
                    (Google Maps Embed URL)</label>
                <textarea id="google_map_embed" name="google_map_embed" rows="3" dir="ltr"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-xs font-mono focus:border-amber-400 focus:outline-none">{{ \App\Models\Setting::get('google_map_embed') }}</textarea>
                <p class="text-[11px] text-slate-500">انسخ رابط src من كود التضمين في قوقل ماب وضعه هنا، أو دعه فارغاً
                    وسيتم عرضه تلقائياً من الإحداثيات.</p>
            </div>
        </div>

        <!-- Submit Button for Location -->
        <div class="flex items-center justify-between p-4 bg-slate-900/60 border border-slate-800 rounded-2xl">
            <span class="text-xs text-slate-400">تحديث فوري لعنوان المعرض وموقع الخريطة ورابط الاتجاهات.</span>
            <button type="submit"
                class="px-8 py-3 rounded-xl bg-blue-500 hover:bg-blue-400 text-white font-black text-sm transition-all shadow-lg shadow-blue-500/20 active:scale-95 inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                حفظ بيانات العنوان والخريطة
            </button>
        </div>
    </form>
</div>