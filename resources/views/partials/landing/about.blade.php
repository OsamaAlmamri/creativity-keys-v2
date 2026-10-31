<section id="about" class="py-24 bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- About Media & Trust Elements -->
            <div class="lg:col-span-5 space-y-6">
                <div class="relative rounded-3xl overflow-hidden border border-slate-800 shadow-2xl group">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80" alt="ورشة ومختبر مفاتيح الأمان لقص وبرمجة المفاتيح في {{ $cityName }}" loading="lazy" class="w-full h-96 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    
                    <div class="absolute bottom-6 right-6 left-6 p-4 rounded-2xl bg-slate-900/90 backdrop-blur-md border border-slate-750">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-black shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-sm">أجهزة دقيقة معتمدة عالمياً</h4>
                                <p class="text-xs text-slate-400">نستخدم أحدث ماكينات القص الإيطالية بالليزر لضمان عدم تلف الكالون</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2 Quick badges -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 text-center">
                        <div class="text-amber-400 font-black text-xl mb-1">{{ $settings['team_size'] ?? '12 فني' }}</div>
                        <div class="text-xs text-slate-400">فريق فنيين محترف ومدرب</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 text-center">
                        <div class="text-amber-400 font-black text-xl mb-1">100% بدون كسر</div>
                        <div class="text-xs text-slate-400">ضمان سلامة الأبواب والسيارات</div>
                    </div>
                </div>
            </div>

            <!-- About Story (Right in RTL) -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-800 border border-slate-700 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    من نحن
                </div>

                <h2 class="text-2xl sm:text-4xl font-black text-white leading-snug">
                    {{ $settings['about_title'] ?? ('أكثر من 15 عاماً من الريادة في عالم الأقفال والمفاتيح المشفرة في ' . $cityName) }}
                </h2>

                <div class="space-y-4 text-slate-300 text-base leading-relaxed">
                    <p>
                        تأسس مركز <strong>{{ $settings['site_name'] ?? 'مفاتيح الأمان الذهبية' }}</strong> برؤية واضحة تهدف إلى إرساء معايير جديدة لخدمات المفاتيح وفتح الأقفال في المملكة العربية السعودية. نحن ندرك تماماً أن الوقوع في موقف قفل مفاجئ للمنزل أو السيارة يسبب قلقاً وإرباكاً، لذا جهزنا أسطولاً من الورش المتنقلة بأعلى التقنيات لتكون بجانبك خلال دقائق معدودة.
                    </p>
                    <p>
                        سواء كنت بحاجة لقص مفتاح كمبيوتر دقيق، برمجة بصمة سيارة حديثة بعد فقدان المفتاح الأصلي، صيانة خزنة حديدية مغلقة، أو تركيب أحدث أنظمة الأقفال الذكية لمنزلك، فإننا نجمع بين الحرفية العالية والأمان التام والمصداقية.
                    </p>
                </div>

                <!-- Bullet Points -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-200">سرعة استجابة ووصول قياسي</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-200">أسعار واضحة ومحددة بدون مبالغة</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-200">أحدث برمجيات شفرات السيارات الحديثة</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-200">سرية تامة وخصوصية مطلقة للعملاء</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
