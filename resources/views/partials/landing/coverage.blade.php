@php
    $rawCoverage = $settings['coverage_areas'] ?? '';
    if (!empty($rawCoverage)) {
        $neighborhoods = array_values(array_filter(array_map('trim', explode('•', $rawCoverage))));
    } else {
        $neighborhoods = [
            'ابحر', 'الهدى', 'النزلة', 'اليمانيه', 'حي الثغر', 'الجوهرة', 'الرحمة', 'البوادي',
            'المروة', 'الصفاء', 'السامر', 'الواحه', 'الشروق', 'مريخ', 'الريان', 'الرحمانية',
            'النزهه', 'الرحاب', 'عسفان', 'الرحيلي', 'الحمداينه', 'المرجان', 'الزهراء', 'البساتين',
            'النهضه', 'الشاطئ', 'السلامه', 'الروضه', 'الجامعه', 'المنار', 'طيبه', 'الفلاح',
            'الصاليحه', 'البشاير', 'الروابي', 'المتزهات', 'العدل', 'الأمير فواز الشمالي', 'الأمير فواز الجنوبي',
            'الخمرة', 'السنابل', 'الفيصيله', 'مشرفه', 'العزيزية', 'مخطط الرياض', 'مخطط الزهور',
            'مخطط العمرية', 'مخطط الصاله الشماليه', 'مخطط الخروج', 'مخطط الوفاء', 'مخطط الموسى',
            'مخطط الحناكي', 'مخطط المشاعر', 'مخطط بحرة', 'حي التيسير', 'حي الوادي', 'حي الورود',
            'حي النسيم', 'حي بريمان', 'حي الياقوت', 'حي الوزيرية', 'الزمرد', 'الرويس', 'ابرق',
            'الفردوس', 'الفروسية', 'القوزين', 'الكرامة', 'اللؤلؤ', 'الرغامة', 'الفيحاء', 'السبيل',
            'السروات', 'السرورية', 'القرينية', 'الشراع', 'الشفاء', 'الصحيفة', 'الصواري', 'الضاحيه',
            'المحمدية', 'المسرة', 'المحجر', 'المليساء', 'النعيم', 'النخيل'
        ];
    }
@endphp

<section id="coverage" class="py-24 bg-slate-900 border-t border-slate-800 relative overflow-hidden">
    <!-- Subtle ambient glow -->
    <div class="absolute top-1/2 left-0 w-80 h-80 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                تغطية شاملة 24/7 في جميع المناطق
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white">
                نغطي جميع مناطق وأحياء ومخططات {{ $cityName }}
            </h2>
            <p class="text-slate-300 text-base leading-relaxed">
                أسطول ورشاتنا المتنقلة موزع استراتيجياً في كافة قطاعات جدة، لضمان وصول الفني المتخصص إليك في أسرع وقت ممكن (متوسط 15 إلى 25 دقيقة).
            </p>

            <!-- Search Neighborhood Box -->
            <div class="max-w-md mx-auto pt-2">
                <div class="relative">
                    <input type="text" id="district-search-input" placeholder="ابحث عن حيك أو منطقتك في جدة..." class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 shadow-inner text-right pr-12">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Neighborhoods Cloud / Grid -->
        <div class="p-6 sm:p-10 rounded-3xl bg-slate-950 border border-slate-800 shadow-2xl space-y-6">

            <div class="flex items-center justify-between flex-wrap gap-4 pb-4 border-b border-slate-850">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-300">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>الأحياء المغطاة بالخدمة الفورية ({{ count($neighborhoods) }}+ حي ومخطط):</span>
                </div>
                <div class="text-xs text-amber-400 font-bold">
                    ⏱️ سرعة وصول قياسية: {{ $cleanArrival }} دقيقة
                </div>
            </div>

            <!-- Neighborhood Pills -->
            <div id="districts-container" class="flex flex-wrap gap-2 sm:gap-2.5 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                @foreach($neighborhoods as $district)
                    <span class="district-pill inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 hover:border-amber-400/50 hover:bg-slate-850 text-slate-300 hover:text-white text-xs font-medium transition-all group cursor-default">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 group-hover:scale-125 transition-transform"></span>
                        <span class="district-name">{{ $district }}</span>
                    </span>
                @endforeach
            </div>

            <!-- No match notice -->
            <div id="district-no-match" class="hidden text-center py-6 text-slate-400 text-sm">
                لم نجد الحي في البحث السريع، لكن ورشتنا المتنقلة تغطي جميع أنحاء جدة والمناطق المحيطة بلا استثناء! <br>
                <a href="tel:{{ $settings['emergency_phone'] ?? '0543075802' }}" class="text-amber-400 hover:underline font-bold mt-2 inline-block">اتصل بنا للتأكيد الفوري: {{ $settings['emergency_phone'] ?? '0543075802' }}</a>
            </div>

            <!-- Bottom Dispatch CTA -->
            <div class="pt-6 border-t border-slate-850 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-400 text-center sm:text-right">
                    هل أنت عالق خارج سيارتك أو منزلك الآن؟ اطلب الفني فوراً ليصلك في حيك.
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="tel:{{ $settings['emergency_phone'] ?? '0543075802' }}" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-amber-500 hover:from-red-500 hover:to-amber-400 text-white font-bold text-xs shadow-md shadow-red-600/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>اتصال طوارئ بالورشة</span>
                    </a>
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966543075802' }}?text={{ urlencode('السلام عليكم، أحتاج فني مفاتيح طوارئ لموقعي في جدة') }}" target="_blank" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>مشاركة الموقع بالواتساب</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Client-side District Live Search Filter -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('district-search-input');
        const pills = document.querySelectorAll('.district-pill');
        const noMatch = document.getElementById('district-no-match');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const query = this.value.trim().toLowerCase();
                let visibleCount = 0;

                pills.forEach(pill => {
                    const name = pill.querySelector('.district-name').textContent.toLowerCase();
                    if (query === '' || name.includes(query)) {
                        pill.style.display = 'inline-flex';
                        visibleCount++;
                    } else {
                        pill.style.display = 'none';
                    }
                });

                if (noMatch) {
                    noMatch.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            });
        }
    });
</script>

