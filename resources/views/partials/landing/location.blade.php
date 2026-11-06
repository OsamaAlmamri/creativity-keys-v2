<section id="location" class="py-24 bg-slate-900 border-t border-slate-800 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header Matching Reference Style -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    موقعنا على الخريطة
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                    موقع المحل وساعات العمل — تفضل بزيارتنا، أو خذنا إليك.
                </h2>
            </div>
            <p class="max-w-md text-base text-slate-400 leading-relaxed">
                تفضل بزيارة اقرب محل مفاتيح من موقعك، أو اطلب خدمتنا المتنقلة لتصلك في كافة أحياء {{ $cityName }} بما فيها أبحر، على مدار الأسبوع.
            </p>
        </div>

        <!-- Split Grid: Map & Info Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Google Maps Embedded (8 Cols) -->
            <div class="lg:col-span-8 rounded-[2.5rem] overflow-hidden border-2 border-slate-800 bg-slate-950 p-2 shadow-2xl">
                <div class="relative w-full h-[400px] lg:h-[480px] rounded-[2rem] overflow-hidden">
                    <iframe 
                        title="موقع محل مفاتيح الإبداع على خرائط جوجل" 
                        src="{{ $mapEmbedUrl }}" 
                        class="w-full h-full border-0 filter contrast-[105%]" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- 3 Quiet Info Cards (4 Cols) -->
            <div class="lg:col-span-4 flex flex-col gap-4">
                
                <!-- Directions Card -->
                <div class="rounded-3xl bg-slate-950 border border-slate-800 p-6 flex flex-col justify-between hover:border-amber-400/40 transition-colors">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">الاتجاهات والملاحة</h3>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                            افتح موقعنا على خرائط جوجل واحصل على الاتجاهات الدقيقة مباشرة من هاتفك في خطوة واحدة.
                        </p>
                    </div>

                    <a 
                        href="{{ $directionsUrl }}" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="mt-5 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs sm:text-sm transition-all shadow-md shadow-amber-500/20"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <span>افتح في خرائط Google</span>
                    </a>
                </div>

                <!-- Working Hours Card -->
                <div class="rounded-3xl bg-slate-950 border border-slate-800 p-6 flex items-start gap-4 hover:border-amber-400/40 transition-colors">
                    <div class="w-11 h-11 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-amber-400 tracking-wider mb-1">ساعات العمل</span>
                        <p class="text-sm font-semibold text-white leading-relaxed">
                            {{ $settings['working_hours'] ?? 'يومياً من 9:00 صباحاً حتى 11:00 مساءً' }}
                        </p>
                    </div>
                </div>

                <!-- Mobile Workshop Card -->
                <div class="rounded-3xl bg-slate-950 border border-slate-800 p-6 flex items-start gap-4 hover:border-amber-400/40 transition-colors">
                    <div class="w-11 h-11 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-amber-400 tracking-wider mb-1">خدمة متنقلة 24/7</span>
                        <p class="text-sm font-semibold text-white leading-relaxed">
                            ورشة متكاملة تصل إليك في حالات الطوارئ على مدار الساعة
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
