<section id="hero" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 pt-8 pb-20">
    <!-- Background Lighting effects & Pattern -->
    <div class="absolute inset-0 hero-radial-glow"></div>
    <div class="absolute top-1/4 -right-48 w-96 h-96 bg-brand-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 -left-48 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Hero Content (Right in RTL) -->
            <div class="lg:col-span-7 text-center lg:text-right space-y-6">
                <!-- Emergency Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-700 dark:text-amber-400 text-xs sm:text-sm font-bold shadow-inner">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>خدمة فتح أقفال وبرمجة مفاتيح فورية • طوارئ 24/7 في {{ $cityName }}</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white leading-[1.25] tracking-tight">
                    أمانك يبدأ بمفتاح.. <br>
                    <span class="text-brand-gradient bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 bg-clip-text text-transparent">
                        خبراء فتح الأقفال والبرمجة
                    </span>
                    <span class="block text-2xl sm:text-4xl lg:text-5xl font-extrabold text-slate-800 dark:text-slate-200 mt-2">
                        بأحدث أجهزة الليزر • بدون أي كسر
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    {{ $settings['site_tagline'] ?? ('خدمات قص وبرمجة مفاتيح وبصمات السيارات بجميع موديلاتها، فتح أبواب المنازل والخزائن المغلقة بدون خدش، وتوريد أحدث الأقفال الذكية مع ورش متنقلة مجهزة بالكامل تصلك فوراً في ' . $cityName . '.') }}
                </p>

                <!-- Trust Stats Bar (Modern Metrics Cards) -->
                <div class="grid grid-cols-3 gap-3 sm:gap-4 py-2 max-w-xl mx-auto lg:mx-0">
                    <div class="p-4 rounded-2xl bg-white dark:bg-slate-900/80 border border-slate-200/90 dark:border-slate-800 shadow-xs hover:border-amber-400/50 transition-all text-center lg:text-right">
                        <div class="text-2xl sm:text-3xl font-black text-amber-500 font-mono tracking-tight" dir="ltr">{{ $settings['years_experience'] ?? '15+' }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-1">سنة خبرة معتمدة</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white dark:bg-slate-900/80 border border-slate-200/90 dark:border-slate-800 shadow-xs hover:border-amber-400/50 transition-all text-center lg:text-right">
                        <div class="text-2xl sm:text-3xl font-black text-amber-500 font-mono tracking-tight" dir="ltr">{{ $cleanArrival }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-1">سرعة الوصول (دقيقة)</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white dark:bg-slate-900/80 border border-slate-200/90 dark:border-slate-800 shadow-xs hover:border-amber-400/50 transition-all text-center lg:text-right">
                        <div class="text-2xl sm:text-3xl font-black text-amber-500 font-mono tracking-tight" dir="ltr">{{ $settings['happy_clients'] ?? '18,500+' }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-1">عميل في {{ $cityName }}</div>
                    </div>
                </div>

                <!-- Primary CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    <!-- Emergency Call Button -->
                    <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-base px-8 py-4 rounded-2xl shadow-xl shadow-amber-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <span class="w-3 h-3 rounded-full bg-slate-950 animate-ping"></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>اتصل الآن للطوارئ (24 ساعة)</span>
                    </a>

                    <!-- Contact / Request Form Jump -->
                    <a href="#contact" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-900 dark:text-white font-bold text-base px-7 py-4 rounded-2xl border border-slate-300 dark:border-slate-700 hover:border-slate-400 dark:hover:border-slate-600 shadow-xs transition-all">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>طلب تسعيرة أو خدمة</span>
                        <svg class="w-4 h-4 -rotate-90 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>

                <!-- Guarantee statement -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs font-bold text-slate-600 dark:text-slate-400 pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-200/80 dark:border-emerald-500/20">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        فتح بدون كسر 100%
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 border border-blue-200/80 dark:border-blue-500/20">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        أجهزة قص ليزر ألمانية
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-200/80 dark:border-amber-500/20">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        فنيون معتمدون ومرخصون
                    </span>
                </div>
            </div>

            <!-- Hero Visual / Quick Emergency Card (Left in RTL) -->
            <div class="lg:col-span-5">
                <div class="relative mx-auto max-w-lg lg:max-w-none">
                    <!-- Glow behind card -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-500/20 via-yellow-500/20 to-amber-600/20 rounded-3xl blur-xl opacity-75 group-hover:opacity-100 transition duration-1000"></div>

                    <!-- Card Body -->
                    <div class="relative bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 rounded-3xl p-6 sm:p-7 shadow-2xl space-y-5">
                        
                        <!-- Card Header -->
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center font-black shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white">الورشة المتنقلة الفورية</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">تغطية مباشرة لكافة أحياء {{ $cityName }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400 text-xs font-bold shadow-xs">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>متاحون الآن</span>
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono" dir="ltr">24/7 Dispatch</span>
                            </div>
                        </div>

                        <!-- Active Districts Live Ticker -->
                        <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200/70 dark:border-slate-800/80 flex items-center justify-between gap-2 text-xs">
                            <span class="text-amber-600 dark:text-amber-400 font-bold flex items-center gap-1 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                نطاق التغطية:
                            </span>
                            <span class="text-slate-600 dark:text-slate-400 truncate text-[11px]" title="{{ $coverageAreas }}">
                                {{ $coverageAreas }}
                            </span>
                        </div>

                        <!-- Highlights List -->
                        <div class="space-y-3">
                            <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50/80 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-750 hover:border-amber-400/40 transition-colors">
                                <div class="w-11 h-11 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-bold text-slate-900 dark:text-white">برمجة بصمات ومفاتيح السيارات</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">قص كمبيوتر ليزر وبرمجة ريموتات وبصمات فاقدة لكافة الموديلات</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50/80 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-750 hover:border-emerald-400/40 transition-colors">
                                <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-bold text-slate-900 dark:text-white">فتح أبواب الفلل والشقق والخزائن</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">فتح فني آمن 100% بدون أي تكسير للأبواب أو تشويه للكالون</div>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50/80 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-750 hover:border-blue-400/40 transition-colors">
                                <div class="w-11 h-11 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-bold text-slate-900 dark:text-white">أقفال ذكية وتغيير قلب الكالون</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">أقفال بيومترية بالبصمة وكروت ذكية مع تطبيق جوال وضمان عامين</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Action Inside Card -->
                        <div class="pt-2">
                            <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('السلام عليكم، أحتاج ورشة المفاتيح المتنقلة لموقعي') }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 px-4 rounded-2xl transition-all shadow-lg shadow-emerald-600/25 hover:scale-[1.01] active:scale-[0.99]">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>إرسال موقعك الفوري عبر الواتساب للفني</span>
                        </a>
                        <div class="text-center pt-2 text-[11px] text-slate-500 dark:text-slate-400">
                            🔒 خدمة سريعة ومعتمدة • فواتير رسمية وضمان على العمل
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
