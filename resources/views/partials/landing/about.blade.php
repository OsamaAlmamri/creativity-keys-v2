<section id="about" class="py-24 bg-slate-900 border-t border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- About Media (Left in RTL): Architectural Arched Frame -->
            <div class="lg:col-span-5 order-2 lg:order-1">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <div class="relative rounded-[2.5rem] overflow-hidden border-2 border-slate-800 bg-slate-950 shadow-2xl group">
                        <img src="/images/store/800_6abfe0ca2391c.jpg" 
                             alt="معرض ريموتات ومفاتيح السيارات الحديثة داخل محل مفاتيح الإبداع في {{ $cityName }}" 
                             loading="lazy" 
                             class="w-full h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        
                        <div class="absolute bottom-6 right-6 left-6 p-4 rounded-2xl bg-slate-900/95 backdrop-blur-md border border-slate-800 shadow-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-black shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-sm">معدات تشخيص وبرمجة معتمدة</h4>
                                    <p class="text-xs text-slate-400">أجهزة قص ليزر إيطالية وألمانية دقيقة بنسبة 100%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Story (Right in RTL) -->
            <div class="lg:col-span-7 space-y-6 order-1 lg:order-2">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    من نحن
                </div>

                <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                    فريق خبير يضمن لك راحة البال.
                </h2>

                <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                    محل <strong>{{ $settings['site_name'] ?? 'مفاتيح الإبداع' }}</strong> هو وجهتك الموثوقة الأولى في {{ $cityName }}. إذا كنت تحتاج إلى اقرب محل مفاتيح لخدمتك بشكل طارئ، فإن فريقنا المتنقل يغطي كافة الأحياء لتقديم خدمات نسخ المفاتيح، إصلاح وبرمجة مفاتيح السيارات، وتركيب الأقفال بأحدث الأجهزة المتطورة وبدون أي كسر.
                </p>

                <!-- Numbered Quiet Details Cards (01, 02) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3">
                    <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800/90 space-y-2">
                        <span class="text-2xl font-black text-amber-400 font-mono block">01</span>
                        <h4 class="text-sm font-bold text-white">دقة واحترافية متناهية</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            استخدام أحدث أجهزة الليزر الرقمية الإيطالية لقص المفاتيح وبرمجة كمبيوتر السيارات بدقة 100%.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-950 border border-slate-800/90 space-y-2">
                        <span class="text-2xl font-black text-amber-400 font-mono block">02</span>
                        <h4 class="text-sm font-bold text-white">رضاك وثقتك غايتنا</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            رضاك هدفنا الأول وثقتك وسام نعتز به في كل خدمة نقدمها، مع ضمان شامل وأسعار واضحة ومنافسة.
                        </p>
                    </div>
                </div>

                <!-- Trust Points List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs font-semibold text-slate-300">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>ورش متنقلة تصلك إلى أي حي خلال 15 - 25 دقيقة</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>فتح أقفال بدون أي تجريح أو كسر للكوالين والأبواب</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
