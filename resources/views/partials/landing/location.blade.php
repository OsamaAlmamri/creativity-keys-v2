<section id="location" class="py-24 bg-slate-900 px-5 sm:px-8 border-t border-slate-800 relative">
    <div class="mx-auto max-w-7xl">

        <!-- Section Header Matching Reference Style -->
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="section-kicker">موقعنا على الخريطة</p>
                <h2
                    class="mt-4 max-w-2xl text-4xl font-semibold leading-tight tracking-[-0.03em] sm:text-5xl text-slate-900 dark:text-white">
                    موقع المحل وساعات العمل — تفضل بزيارتنا، أو خذنا إليك.
                </h2>
            </div>
            <p class="max-w-md text-base leading-7 text-slate-600 dark:text-slate-400">
                تفضل بزيارة اقرب محل مفاتيح من موقعك، أو اطلب خدمتنا المتنقلة لتصلك في كافة أحياء {{ $cityName }} بما
                فيها أبحر، على مدار الأسبوع.
            </p>
        </div>

        <!-- Split Grid: Map on Right, Info Cards on Left (in RTL) -->
        <div class="mt-12 grid gap-6 lg:grid-cols-12 items-stretch">

            <!-- Map Container (Right in RTL, 8 of 12 cols) -->
            <div class="lg:col-span-8 glass-panel overflow-hidden rounded-[2.2rem] p-2 min-h-[420px] lg:min-h-[520px]">
                <iframe title="موقع محل مفتاح الإبداع على خرائط جوجل" src="{{ $mapEmbedUrl }}"
                    class="h-[420px] w-full rounded-[1.8rem] border-0 lg:h-full lg:min-h-[500px]" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- 3 Stacked Info Cards (Left in RTL, 4 of 12 cols) -->
            <div class="lg:col-span-4 grid content-start gap-4">

                <!-- Directions Card -->
                <div class="glass-panel flex flex-col rounded-[2rem] p-6 justify-between">
                    <div>
                        <span
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">الاتجاهات</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-600 dark:text-slate-400">
                            افتح موقعنا على خرائط جوجل واحصل على الاتجاهات مباشرة من هاتفك في خطوة واحدة.
                        </p>
                    </div>
                    <a href="{{ $directionsUrl }}" target="_blank" rel="noopener noreferrer"
                        class="mt-5 inline-flex min-h-11 items-center justify-center gap-2 rounded-full bg-brand-primary hover:brightness-105 px-5 py-3 text-sm font-bold text-slate-950 shadow-brand transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>افتح في خرائط جوجل</span>
                    </a>
                </div>

                <!-- Working Hours Card -->
                <div class="glass-panel flex items-start gap-4 rounded-[2rem] p-6">
                    <span
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span class="min-w-0">
                        <span
                            class="block text-xs font-bold uppercase tracking-widest text-slate-900 dark:text-white">ساعات
                            العمل</span>
                        <span
                            class="mt-1 block text-sm leading-6 text-slate-600 dark:text-slate-400">{{ $settings['working_hours'] ?? 'يومياً من 9 صباحاً حتى 11 مساءً' }}</span>
                    </span>
                </div>

                <!-- 24/7 Mobile Service Card -->
                <div class="glass-panel flex items-start gap-4 rounded-[2rem] p-6">
                    <span
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </span>
                    <span class="min-w-0">
                        <span
                            class="block text-xs font-bold uppercase tracking-widest text-slate-900 dark:text-white">خدمة
                            متنقلة 24/7</span>
                        <span class="mt-1 block text-sm leading-6 text-slate-600 dark:text-slate-400">نصل إليك في حالات
                            الطوارئ على مدار الساعة بكافة أحياء {{ $cityName }}</span>
                    </span>
                </div>

            </div>

        </div>

    </div>
</section>