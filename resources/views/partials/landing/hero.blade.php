<section id="hero" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden pt-12 pb-20 lg:pt-16 lg:pb-24">
    <!-- Ambient Background Glow & Orbs -->
    <div class="absolute top-10 right-10 sm:right-1/4 w-[450px] h-[450px] bg-brand-primary/10 rounded-full blur-[100px] pointer-events-none -z-10"></div>
    <div class="absolute bottom-10 left-10 sm:left-1/4 w-[380px] h-[380px] bg-amber-500/10 rounded-full blur-[90px] pointer-events-none -z-10"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Hero Content (Right in RTL) -->
            <div class="lg:col-span-7 text-center lg:text-right space-y-6">
                
                <!-- Kicker Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-primary/10 border border-brand-primary/25 text-brand-primary text-xs sm:text-sm font-bold shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>{{ $settings['site_tagline'] ?? 'خدمات مفاتيح السيارات والأبواب 24/7' }}</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-slate-900 dark:text-white leading-[1.14] tracking-tight">
                    محل مفاتيح في {{ $cityName }} <br>
                    <span class="text-brand-primary inline-block mt-1">
                        {{ $settings['site_name'] ?? 'مفاتيح الإبداع' }}
                    </span>
                </h1>

                <!-- Subtitle / Value Pitch -->
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    إذا كنت تبحث عن اقرب محل مفاتيح من موقعك، نحن نوفر لك خدمات قص وتفصيل المفاتيح، برمجة مفاتيح السيارات، وفتح الأبواب المغلقة بدون كسر. نصلك أينما كنت في {{ $cityName }} وأبحر بسرعة واحترافية عالية على مدار 24 ساعة.
                </p>

                <!-- Primary Action Buttons -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-2">
                    <!-- Direct Phone Call Button -->
                    <a 
                        href="tel:{{ $settings['emergency_phone'] ?? '0568191921' }}" 
                        class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm sm:text-base shadow-lg shadow-amber-500/25 hover:scale-[1.02] active:scale-95 transition-all"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>اتصل الآن: {{ $settings['emergency_phone'] ?? '0568191921' }}</span>
                    </a>

                    <!-- Direct WhatsApp Button -->
                    <a 
                        href="https://wa.me/{{ $settings['whatsapp'] ?? '966568191921' }}?text={{ urlencode('السلام عليكم، أحتاج خدمة مفاتيح عاجلة في جدة') }}" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm sm:text-base shadow-md hover:scale-[1.02] transition-all"
                    >
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>راسلنا واتساب</span>
                    </a>

                    <!-- Discover Services Link -->
                    <a 
                        href="#services" 
                        class="inline-flex items-center justify-center gap-1.5 px-5 py-3.5 rounded-full text-slate-700 dark:text-slate-300 hover:text-amber-500 dark:hover:text-amber-400 font-bold text-sm transition-colors"
                    >
                        <span>اكتشف خدماتنا</span>
                        <svg class="w-4 h-4 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>

                <!-- Sleek Trust Metrics Divider Strip -->
                <div class="pt-8 border-t border-slate-200/80 dark:border-slate-800/80 flex items-center justify-center lg:justify-start gap-8 sm:gap-12 max-w-xl mx-auto lg:mx-0">
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-mono" dir="ltr">{{ $settings['years_experience'] ?? '15+' }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-0.5">سنوات خبرة</div>
                    </div>
                    <div class="h-8 w-px bg-slate-200 dark:bg-slate-800"></div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-mono" dir="ltr">{{ $cleanArrival }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-0.5">سرعة الوصول (دقيقة)</div>
                    </div>
                    <div class="h-8 w-px bg-slate-200 dark:bg-slate-800"></div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white font-mono" dir="ltr">{{ $settings['happy_clients'] ?? '18,500+' }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-0.5">عميل تم خدمتهم</div>
                    </div>
                </div>

            </div>

            <!-- Hero Visual (Left in RTL): Tall Architectural Arch Window -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-[440px] lg:max-w-[480px]">
                    
                    <!-- Decorative Arch Border Frame -->
                    <div class="relative p-2.5 sm:p-3 rounded-t-[14rem] sm:rounded-t-[18rem] rounded-b-[2.5rem] bg-white/70 dark:bg-slate-900/70 border border-brand-primary/30 dark:border-brand-primary/40 shadow-2xl backdrop-blur-md overflow-hidden group">
                        
                        <!-- Arch Image Container -->
                        <div class="relative rounded-t-[13rem] sm:rounded-t-[17rem] rounded-b-[2rem] overflow-hidden h-[480px] sm:h-[540px] lg:h-[580px] bg-slate-950">
                            <img 
                                src="/images/store/800_6abfe0cbeabef.jpg" 
                                alt="واجهة محل مفاتيح الإبداع في جدة لنسخ وبرمجة مفاتيح السيارات" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>

                            <!-- Top Floating Badge -->
                            <div class="absolute top-6 right-6 z-10">
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-slate-900/85 backdrop-blur-md text-white text-xs font-bold shadow-lg border border-white/10">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    ورش متنقلة في {{ $cityName }}
                                </span>
                            </div>

                            <!-- Bottom Floating Guarantee Card -->
                            <div class="absolute bottom-5 inset-x-5 z-10 p-3.5 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/90 dark:border-slate-800 shadow-xl flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-9 h-9 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-black shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate">فتح الأبواب والسيارات بدون كسر</h4>
                                        <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">فنيون معتمدون بأحدث أجهزة البرمجة</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-amber-500/15 text-amber-600 dark:text-amber-400 text-[11px] font-bold shrink-0">
                                    24/7 طوارئ
                                </span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
