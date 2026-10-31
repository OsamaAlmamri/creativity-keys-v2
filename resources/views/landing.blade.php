@extends('layouts.app')

@section('content')

    <!-- ========================================== -->
    <!-- 1. HERO BANNER (بنر رئيسي مبتكر واحترافي) -->
    <!-- ========================================== -->
    <section id="hero" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 pt-12 pb-20">
        <!-- Background Lighting effects & Pattern -->
        <div class="absolute inset-0 hero-radial-glow"></div>
        <div class="absolute top-1/4 -right-48 w-96 h-96 bg-brand-primary/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 -left-48 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Hero Content (Right in RTL) -->
                <div class="lg:col-span-7 text-center lg:text-right space-y-6">
                    <!-- Emergency Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs sm:text-sm font-bold shadow-inner">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>خدمة فتح أقفال وبرمجة مفاتيح فورية • طوارئ 24/7 في الرياض</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight">
                        أمانك يبدأ بمفتاح.. <br>
                        <span class="text-brand-gradient bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500 bg-clip-text text-transparent">
                            خبراء فتح الأقفال والبرمجة
                        </span>
                        في دقائق
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        {{ $settings['site_tagline'] ?? 'خدمات قص وبرمجة مفاتيح السيارات بجميع أنواعها، فتح أبواب المنازل والخزائن المغلقة بدون كسر، وتوريد أحدث الأقفال الذكية مع ورش متنقلة تصلك أينما كنت.' }}
                    </p>

                    <!-- Trust Stats Bar -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-6 py-4 max-w-lg mx-auto lg:mx-0 border-y border-slate-800/80">
                        <div class="text-center lg:text-right">
                            <div class="text-2xl sm:text-3xl font-black text-amber-400 font-mono">{{ $settings['years_experience'] ?? '15+' }}</div>
                            <div class="text-xs text-slate-400 font-medium mt-0.5">سنة خبرة معتمدة</div>
                        </div>
                        <div class="text-center lg:text-right border-x border-slate-800 px-2">
                            <div class="text-2xl sm:text-3xl font-black text-amber-400 font-mono">{{ $settings['arrival_time'] ?? '15-25' }} دقيقة</div>
                            <div class="text-xs text-slate-400 font-medium mt-0.5">متوسط سرعة الوصول</div>
                        </div>
                        <div class="text-center lg:text-right">
                            <div class="text-2xl sm:text-3xl font-black text-amber-400 font-mono">{{ $settings['happy_clients'] ?? '18,500+' }}</div>
                            <div class="text-xs text-slate-400 font-medium mt-0.5">عميل تمت خدمتهم</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <!-- Direct Emergency Call -->
                        <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-base px-8 py-4 rounded-2xl shadow-xl shadow-amber-500/25 hover:scale-105 active:scale-95 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>اتصل الآن للطوارئ (24 ساعة)</span>
                        </a>

                        <!-- Contact / Request Form Jump -->
                        <a href="#contact" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-slate-800/90 hover:bg-slate-700 text-white font-bold text-base px-7 py-4 rounded-2xl border border-slate-700 hover:border-slate-600 transition-all">
                            <span>طلب تسعيرة أو خدمة</span>
                            <svg class="w-5 h-5 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>

                    <!-- Guarantee statement -->
                    <div class="flex items-center justify-center lg:justify-start gap-4 text-xs text-slate-400 pt-2">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            فتح بدون كسر 100%
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            معدات ليزر ألمانية
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            فنيين مرخصين رسمياً
                        </span>
                    </div>
                </div>

                <!-- Hero Visual / Quick Emergency Card (Left in RTL) -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Glow behind card -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-yellow-500 rounded-3xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>

                        <!-- Card Body -->
                        <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                            
                            <!-- Card Header -->
                            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                                <div>
                                    <h3 class="text-lg font-black text-white">الورشة المتنقلة الفورية</h3>
                                    <p class="text-xs text-slate-400">نصل إلى مكانك فوراً بالرياض</p>
                                </div>
                                <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold animate-pulse">
                                    متاحون الآن
                                </span>
                            </div>

                            <!-- Highlights List -->
                            <div class="space-y-3.5">
                                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-800/50 border border-slate-750">
                                    <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-white">برمجة بصمات ومفاتيح السيارات</div>
                                        <div class="text-xs text-slate-400">جميع الموديلات الأمريكية، اليابانية، والكورية والأوروبية</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-800/50 border border-slate-750">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-white">فتح أبواب الفلل والشقق والخزائن</div>
                                        <div class="text-xs text-slate-400">فتح احترافي سليم بدون تكسير للأبواب أو تبديل الكالون إجبارياً</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-800/50 border border-slate-750">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-white">أقفال ذكية وتغيير قلب الكالون</div>
                                        <div class="text-xs text-slate-400">أقفال بيومترية بالبصمة، كروت، وتطبيق جوال مع ضمان عامين</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Action Inside Card -->
                            <div class="pt-2">
                                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('السلام عليكم، أحتاج ورشة المفاتيح المتنقلة لموقعي') }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-lg shadow-emerald-600/20">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    إرسال موقعك عبر الواتساب للفني
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================== -->
    <!-- 2. ABOUT US (من نحن وقصتنا وخبرتنا)       -->
    <!-- ========================================== -->
    <section id="about" class="py-24 bg-slate-900 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- About Media & Trust Elements -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="relative rounded-3xl overflow-hidden border border-slate-800 shadow-2xl group">
                        <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80" alt="ورشة ومختبر المفاتيح" class="w-full h-96 object-cover group-hover:scale-105 transition-transform duration-500">
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

                    <!-- 3 Quick badges -->
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
                        {{ $settings['about_title'] ?? 'أكثر من 15 عاماً من الريادة في عالم الأقفال والمفاتيح المشفرة بالرياض' }}
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


    <!-- ========================================== -->
    <!-- 3. SERVICES (خدماتنا الشاملة والمتخصصة)    -->
    <!-- ========================================== -->
    <section id="services" class="py-24 bg-slate-950 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    خدماتنا الاحترافية
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white">
                    حلول متكاملة للمفاتيح وبرمجة الأقفال
                </h2>
                <p class="text-slate-400 text-base">
                    نقدم باقة واسعة من الخدمات الميدانية والمكتبية بأحدث المعدات الألمانية والإيطالية تحت إشراف نخبة من الفنيين المهرة.
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="relative rounded-3xl bg-slate-900 border border-slate-800 p-8 flex flex-col justify-between hover:border-amber-500/50 hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 group hover-brand-card">
                        
                        <!-- Top Row: Icon & Emergency Badge -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform">
                                @if($service->icon === 'car-key')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                @elseif($service->icon === 'lock-open')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                                @elseif($service->icon === 'cpu-chip')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                @elseif($service->icon === 'shield-check')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                @elseif($service->icon === 'truck')
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                @else
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                @endif
                            </div>

                            @if($service->is_emergency)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                                    طوارئ 24/7
                                </span>
                            @endif
                        </div>

                        <!-- Service Details -->
                        <div class="space-y-3 mb-6">
                            @if($service->category)
                                <div>
                                    <span class="inline-block px-3 py-1 rounded-full bg-slate-800 text-amber-400 text-xs font-bold border border-slate-750">
                                        {{ $service->category->name }}
                                    </span>
                                </div>
                            @endif
                            <h3 class="text-xl font-bold text-white group-hover:text-amber-400 transition-colors">
                                {{ $service->title }}
                            </h3>
                            <p class="text-sm text-slate-400 leading-relaxed">
                                {{ $service->short_description }}
                            </p>

                            <!-- Features List -->
                            @if(!empty($service->features))
                                <ul class="space-y-2 pt-2 border-t border-slate-800 text-xs text-slate-300">
                                    @foreach($service->features as $feature)
                                        <li class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- Pricing & Order Button -->
                        <div class="pt-4 border-t border-slate-800 flex items-center justify-between gap-3">
                            <div>
                                @if($service->price_starting_at)
                                    <span class="text-xs text-slate-400 block">السعر التقديري:</span>
                                    <span class="text-sm font-black text-amber-400">{{ $service->price_starting_at }}</span>
                                @else
                                    <span class="text-xs text-slate-400">حسب نوع القفل والموديل</span>
                                @endif
                            </div>

                            <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('مرحباً، أود الاستفسار وطلب خدمة: ' . $service->title) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-800 hover:bg-amber-500 text-slate-200 hover:text-slate-950 font-bold text-xs transition-colors">
                                <span>طلب الخدمة</span>
                                <svg class="w-3.5 h-3.5 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        جاري تحديث قائمة الخدمات...
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- ========================================== -->
    <!-- 4. GALLERY (معرض الصور والأعمال)           -->
    <!-- ========================================== -->
    <section id="gallery" class="py-24 bg-slate-900 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    معرض الصور والأعمال
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white">
                    لقطات من أعمالنا وأحدث أجهزتنا
                </h2>
                <p class="text-slate-400 text-base">
                    شاهد كفاءة أجهزتنا الرقمية وصور حقيقية من برمجة بصمات السيارات وتركيب الأقفال الذكية وفتح الخزائن.
                </p>

                <!-- Filter Categories Tabs -->
                @if($galleryCategories->isNotEmpty())
                    <div class="flex flex-wrap items-center justify-center gap-2 pt-4" id="gallery-filters">
                        <button type="button" data-filter="all" class="filter-btn active px-4 py-2 rounded-full text-xs font-bold transition-all bg-amber-500 text-slate-950">
                            الكل ({{ $galleryItems->count() }})
                        </button>
                        @foreach($galleryCategories as $category)
                            <button type="button" data-filter="{{ $category }}" class="filter-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-slate-800 text-slate-300 hover:bg-slate-700">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="gallery-grid">
                @forelse($galleryItems as $item)
                    <div class="gallery-card group relative rounded-3xl overflow-hidden bg-slate-950 border border-slate-800 shadow-xl hover-brand-card" data-category="{{ $item->category }}">
                        <!-- Image Container with Aspect Ratio -->
                        <div class="aspect-w-16 aspect-h-11 h-64 overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>

                        <!-- Card Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full bg-slate-900/90 backdrop-blur-md text-amber-400 border border-slate-700 text-xs font-bold">
                                {{ $item->category }}
                            </span>
                        </div>

                        <!-- Card Content at Bottom -->
                        <div class="absolute bottom-0 inset-x-0 p-6 space-y-1">
                            <h3 class="text-white font-bold text-base group-hover:text-amber-400 transition-colors">
                                {{ $item->title }}
                            </h3>
                            @if($item->description)
                                <p class="text-xs text-slate-400 line-clamp-2">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500">
                        جاري تحديث معرض الصور...
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- ========================================== -->
    <!-- 5. REVIEWS (التقييمات وآراء العملاء)        -->
    <!-- ========================================== -->
    <section id="reviews" class="py-24 bg-slate-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    تقييمات العملاء
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white">
                    ماذا يقول عملاؤنا عنا؟
                </h2>
                <p class="text-slate-400 text-base">
                    نفخر بثقة آلاف العملاء في الرياض الذين تشرفنا بخدمتهم في أوقات الطوارئ والمناسبات.
                </p>
            </div>

            <!-- Reviews Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($reviews as $review)
                    <div class="rounded-3xl bg-slate-900 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all hover-brand-card">
                        
                        <div class="space-y-4">
                            <!-- Star Rating -->
                            <div class="flex items-center gap-1 text-amber-400">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>

                            <!-- Comment Text -->
                            <p class="text-sm text-slate-300 leading-relaxed italic">
                                "{{ $review->comment }}"
                            </p>
                        </div>

                        <!-- Client Info at Bottom -->
                        <div class="pt-4 mt-4 border-t border-slate-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-sm flex items-center justify-center shrink-0">
                                {{ mb_substr($review->client_name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <h4 class="text-sm font-bold text-white truncate">{{ $review->client_name }}</h4>
                                <div class="text-xs text-amber-400/80 truncate">
                                    {{ $review->service_rendered ?? $review->client_title }}
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-4 text-center py-8 text-slate-500">
                        لا توجد تقييمات منشورة حالياً.
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    @if((\App\Models\Setting::get('show_home_articles', '1') == '1') && isset($latestArticles) && $latestArticles->isNotEmpty())
    <!-- ========================================== -->
    <!-- LATEST ARTICLES (أحدث المقالات والنصائح)    -->
    <!-- ========================================== -->
    <section id="articles" class="py-24 bg-slate-900 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        المدونة والتوعية الأمنية
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-black text-white">
                        نصائح وإرشادات الأقفال والمفاتيح
                    </h2>
                    <p class="text-slate-400 text-base max-w-2xl">
                        تعرف على أحدث طرق الحماية الأمنية، كيفية التصرف عند فقدان مفاتيح السيارات، ومقارنات الأقفال الذكية.
                    </p>
                </div>
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors border border-slate-700 shrink-0">
                    <span>عرض كافة المقالات (المدونة)</span>
                    <svg class="w-4 h-4 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestArticles as $art)
                    <article class="bg-slate-950 border border-slate-800 rounded-3xl overflow-hidden shadow-xl hover:border-amber-500/40 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group hover-brand-card">
                        <div>
                            <div class="relative h-48 overflow-hidden bg-slate-900">
                                <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-slate-900/90 backdrop-blur-md text-amber-400 border border-slate-750 text-xs font-bold">
                                    {{ $art->category }}
                                </span>
                            </div>
                            <div class="p-6 space-y-2.5">
                                <span class="text-xs text-slate-500 font-mono">{{ $art->read_time }}</span>
                                <h3 class="text-base font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('articles.show', $art->slug) }}">
                                        {{ $art->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-400 leading-relaxed line-clamp-2">
                                    {{ $art->excerpt }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 border-t border-slate-800/80 mt-4 flex items-center justify-between">
                            <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 group-hover:text-amber-300">
                                <span>قراءة المقال</span>
                                <svg class="w-3.5 h-3.5 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </a>
                            <span class="text-[11px] text-slate-500 font-mono">{{ $art->views_count }} مشاهدة</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ========================================== -->
    <!-- 6. OUR LOCATION (موقعنا وخريطة قوقل المضمنة) -->
    <!-- ========================================== -->
    <section id="location" class="py-24 bg-slate-900 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Location Info (Right in RTL) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        مقرنا الجغرافي
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-black text-white">
                        موقع المحل وساعات العمل
                    </h2>

                    <p class="text-slate-300 text-base leading-relaxed">
                        تفضل بزيارة مركزنا ومعرضنا الرئيسي لتجربة الأقفال الذكية ونسخ المفاتيح الفورية، أو اطلب ورشة الطوارئ لتصلك مباشرة إلى موقعك في أي حي من أحياء الرياض.
                    </p>

                    <!-- Info Cards -->
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white mb-0.5">العنوان</h4>
                                <p class="text-xs text-slate-400">{{ $settings['address'] ?? 'الرياض - طريق الملك فهد' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white mb-0.5">مواعيد الدوام</h4>
                                <p class="text-xs text-slate-400">{{ $settings['working_hours'] ?? 'خدمة الطوارئ: 24 ساعة | المعرض: 8 ص - 11:30 م' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Directions Link -->
                    <div class="pt-2">
                        <a href="https://maps.google.com/?q=Riyadh+Saudi+Arabia" target="_blank" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm px-6 py-3 rounded-xl border border-slate-700 transition-colors">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            <span>فتح الاتجاهات عبر Google Maps</span>
                        </a>
                    </div>
                </div>

                <!-- Google Maps Embedded (Left in RTL) -->
                <div class="lg:col-span-7">
                    <div class="rounded-3xl overflow-hidden border-2 border-slate-800 shadow-2xl bg-slate-950 p-2">
                        <div class="relative w-full h-[400px] sm:h-[460px] rounded-2xl overflow-hidden">
                            <iframe 
                                src="{{ $settings['google_map_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115984.72149594537!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d48939b%3A0x1b4129759d64380!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2ssa!4v1700000000000!5m2!1sen!2ssa' }}" 
                                class="w-full h-full border-0 filter grayscale-[25%] contrast-[110%]" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ========================================== -->
    <!-- 7. CONTACT US FORM (نموذج تواصل معنا)     -->
    <!-- ========================================== -->
    <section id="contact" class="py-24 bg-slate-950 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center space-y-4 mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    تواصل معنا مباشرة
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white">
                    أرسل طلبك أو استفسارك
                </h2>
                <p class="text-slate-400 text-base">
                    املأ النموذج التالي وسيقوم الفني المناسب بالتواصل معك فوراً خلال دقائق معدودة.
                </p>
            </div>

            <!-- Form Card -->
            <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-10 shadow-2xl">
                
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                        <div class="font-bold mb-1">يرجى تصحيح الأخطاء التالية:</div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-bold text-slate-200">
                                الاسم الكريم <span class="text-amber-400">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="مثال: فهد الدوسري" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm">
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-bold text-slate-200">
                                رقم الجوال <span class="text-amber-400">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required dir="ltr" placeholder="05XXXXXXXX" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm text-right">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Service Needed -->
                        <div class="space-y-2">
                            <label for="service_needed" class="block text-sm font-bold text-slate-200">
                                نوع الخدمة المطلوبة
                            </label>
                            <select id="service_needed" name="service_needed" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm">
                                <option value="">اختر الخدمة...</option>
                                @foreach($services as $svc)
                                    <option value="{{ $svc->title }}" {{ old('service_needed') === $svc->title ? 'selected' : '' }}>
                                        {{ $svc->title }}
                                    </option>
                                @endforeach
                                <option value="خدمة أخرى">أخرى / استفسار عام</option>
                            </select>
                        </div>

                        <!-- City District -->
                        <div class="space-y-2">
                            <label for="city_district" class="block text-sm font-bold text-slate-200">
                                الحي / المنطقة بالرياض
                            </label>
                            <input type="text" id="city_district" name="city_district" value="{{ old('city_district') }}" placeholder="مثال: حي النرجس / حي العليا" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm">
                        </div>
                    </div>

                    <!-- Emergency checkbox -->
                    <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center gap-3">
                        <input type="checkbox" id="is_emergency" name="is_emergency" value="1" {{ old('is_emergency') ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-700 text-amber-500 focus:ring-amber-400 bg-slate-950">
                        <label for="is_emergency" class="text-sm font-bold text-amber-300 cursor-pointer">
                            حالة طوارئ مستعجلة (أنا عالق خارج المنزل / السيارة الآن وأحتاج فني بأسرع وقت)
                        </label>
                    </div>

                    <!-- Message Body -->
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-bold text-slate-200">
                            تفاصيل المشكلة أو الاستفسار <span class="text-amber-400">*</span>
                        </label>
                        <textarea id="message" name="message" rows="4" required placeholder="اكتب نوع السيارة والموديل أو نوع القفل المطلوب فتحه أو تفاصيل طلبك..." class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm leading-relaxed">{{ old('message') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-base transition-all shadow-xl shadow-amber-500/20 hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <span>إرسال الطلب الآن</span>
                    </button>
                </form>

            </div>

        </div>
    </section>

    <!-- Gallery Filtering JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const galleryCards = document.querySelectorAll('.gallery-card');

            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const filter = this.getAttribute('data-filter');

                    // Active state on buttons
                    filterButtons.forEach(b => {
                        b.classList.remove('bg-amber-500', 'text-slate-950');
                        b.classList.add('bg-slate-800', 'text-slate-300');
                    });
                    this.classList.add('bg-amber-500', 'text-slate-950');
                    this.classList.remove('bg-slate-800', 'text-slate-300');

                    // Filter cards
                    galleryCards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-category') === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

@endsection
