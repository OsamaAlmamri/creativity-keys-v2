@extends('admin.layouts.app')

@section('page_title', 'المظهر والثيم والخطوط')

@section('content')

    <div class="max-w-5xl mx-auto space-y-8 pb-12">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2.5">
                    <span class="w-3.5 h-3.5 rounded-full bg-amber-400"></span>
                    تخصيص المظهر والثيم والهوية البصرية
                </h2>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">
                    تحكم فوري بألوان الموقع، نمط العرض (ليلي / نهاري)، الخط العربي، وحواف العناصر لجميع صفحات الموقع ولوحة التحكم.
                </p>
            </div>

            <form action="{{ route('admin.theme.reset') }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في استعادة إعدادات المظهر الأصلية؟');">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-red-500/20 hover:text-red-400 text-slate-300 text-xs font-bold transition-all border border-slate-700/60 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    استعادة الإعدادات الافتراضية
                </button>
            </form>
        </div>

        <!-- Live Interactive Preview Box -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-4 transition-all" id="preview-container">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <span class="text-xs font-black text-amber-400 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    معاينة حية فورية للمظهر (تتغير مباشرة عند تحديد الخيارات أدناه)
                </span>
                <span class="text-[11px] text-slate-500 font-mono" id="preview-color-label">{{ $presets[$current['theme_preset']]['name'] ?? 'لون مخصص' }}</span>
            </div>

            <!-- Mini Mockup -->
            <div class="p-6 rounded-2xl bg-slate-950 border border-slate-800/80 space-y-6 transition-all" id="preview-mockup">
                <!-- Mini Header -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl p-0.5 flex items-center justify-center text-slate-950 font-black shadow-lg" id="preview-logo-box" style="background-color: {{ $activeColors['500'] }};">
                            <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                        <div>
                            <span class="text-sm font-black text-white block" id="preview-brand-title">مفاتيح الأمان الذهبية</span>
                            <span class="text-[11px] font-bold block" id="preview-brand-sub" style="color: {{ $activeColors['500'] }};">قص وبرمجة الأقفال 24/7</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold border transition-colors" id="preview-badge" style="background-color: rgba({{ $activeColors['rgb'] }}, 0.12); color: {{ $activeColors['500'] }}; border-color: rgba({{ $activeColors['rgb'] }}, 0.3);">
                            طوارئ 24 ساعة
                        </span>
                        <button type="button" class="px-4 py-2 rounded-xl text-xs font-black text-slate-950 transition-all shadow-md" id="preview-btn-cta" style="background-color: {{ $activeColors['500'] }};">
                            طلب الخدمة الآن
                        </button>
                    </div>
                </div>

                <!-- Mini Content Card -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-2" id="preview-card-1">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-white">برمجة ريموت بصمة سيارة</span>
                            <span class="text-xs font-mono font-bold" id="preview-price" style="color: {{ $activeColors['500'] }};">ابتداءً من 180 ر.س</span>
                        </div>
                        <p class="text-xs text-slate-400" id="preview-sample-text">
                            عينة توضيحية لخط الموقع: نستخدم أحدث أجهزة الليزر الرقمي لقص وبرمجة مفاتيح السيارات في موقعك بالرياض.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between" id="preview-card-2">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-white block">سرعة وصول الورشة المتنقلة</span>
                            <span class="text-[11px] text-slate-400 block">فنيين معتمدين على مدار الساعة</span>
                        </div>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black" id="preview-icon-box" style="background-color: rgba({{ $activeColors['rgb'] }}, 0.15); color: {{ $activeColors['500'] }};">
                            ⚡
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Form -->
        <form action="{{ route('admin.theme.update') }}" method="POST" class="space-y-8" id="theme-form">
            @csrf

            <!-- 1. Accent Color Palette -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                            1. نظام الألوان والسمة الرئيسية (Accent Color)
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">اختر إحدى اللوحات المعتمدة مسبقاً أو حدد لوناً حراً مخصصاً لموقعك</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($presets as $key => $preset)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="theme_preset" value="{{ $key }}" class="peer sr-only theme-preset-radio" {{ $current['theme_preset'] === $key ? 'checked' : '' }} data-c500="{{ $preset['500'] }}" data-c400="{{ $preset['400'] }}" data-c600="{{ $preset['600'] }}" data-rgb="{{ $preset['rgb'] }}" data-name="{{ $preset['name'] }}">
                            
                            <div class="p-4 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all group-hover:border-slate-700 h-full flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-7 h-7 rounded-full shadow-md" style="background-color: {{ $preset['500'] }};"></div>
                                        <div class="w-5 h-5 rounded-full border-2 border-slate-700 peer-checked:border-amber-400 flex items-center justify-center">
                                            <div class="w-2.5 h-2.5 rounded-full bg-amber-400 hidden group-has-[:checked]:block"></div>
                                        </div>
                                    </div>
                                    <h4 class="text-sm font-bold text-white mb-1">{{ $preset['name'] }}</h4>
                                    <p class="text-[11px] text-slate-400 leading-relaxed">{{ $preset['description'] }}</p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-800/80 flex flex-col gap-2">
                                    <div class="flex items-center justify-between text-[11px] font-mono text-slate-500">
                                        <span>HEX: {{ $preset['500'] }}</span>
                                        <div class="flex gap-1">
                                            <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $preset['400'] }};"></span>
                                            <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $preset['500'] }};"></span>
                                            <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $preset['600'] }};"></span>
                                        </div>
                                    </div>
                                    <div class="h-1.5 rounded-full w-full overflow-hidden shadow-inner" style="background: linear-gradient(90deg, {{ $preset['700'] }}, {{ $preset['500'] }}, {{ $preset['300'] }});"></div>
                                </div>
                            </div>
                        </label>
                    @endforeach

                    <!-- Custom Color Card -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_preset" value="custom" id="preset_custom_radio" class="peer sr-only theme-preset-radio" {{ $current['theme_preset'] === 'custom' ? 'checked' : '' }} data-c500="{{ $current['theme_custom_color'] }}" data-c400="{{ $current['theme_custom_color'] }}" data-c600="{{ $current['theme_custom_color'] }}" data-rgb="245, 158, 11" data-name="لون مخصص">
                        
                        <div class="p-4 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all group-hover:border-slate-700 h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="w-7 h-7 rounded-full shadow-md bg-gradient-to-tr from-rose-500 via-amber-500 to-teal-400"></div>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-700 peer-checked:border-amber-400 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400 hidden group-has-[:checked]:block"></div>
                                    </div>
                                </div>
                                <h4 class="text-sm font-bold text-white mb-1">تخصيص لون حر (Custom)</h4>
                                <p class="text-[11px] text-slate-400 leading-relaxed">اختر أي لون دقيق يناسب هويتك البصرية من خلال منتقي الألوان.</p>
                            </div>
                            
                            <div class="mt-4 pt-3 border-t border-slate-800/80 flex items-center gap-2">
                                <input type="color" id="theme_custom_picker" value="{{ $current['theme_custom_color'] }}" class="w-8 h-8 rounded-lg cursor-pointer bg-transparent border-0 p-0">
                                <input type="text" id="theme_custom_color" name="theme_custom_color" value="{{ $current['theme_custom_color'] }}" dir="ltr" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2 py-1 text-xs text-white font-mono uppercase text-center focus:outline-none">
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 2. Theme Mode & Visitor Switcher -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                            2. نمط العرض (الوضع الليلي والنهاري)
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">حدد النمط الافتراضي الذي يظهر للزوار وتحكم في إمكانية تبديل الوضع</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Dark Mode -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_mode" value="dark" class="peer sr-only theme-mode-radio" {{ $current['theme_mode'] === 'dark' ? 'checked' : '' }}>
                        <div class="p-5 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all flex flex-col items-center text-center gap-3">
                            <span class="text-3xl">🌙</span>
                            <div>
                                <span class="text-sm font-black text-white block">الوضع الليلي الفاخر (Dark)</span>
                                <span class="text-[11px] text-slate-400 mt-1 block">موصى به؛ يمنح الموقع فخامة عالية وإضاءات نيون جذابة لأقفال ومفاتيح الأمان.</span>
                            </div>
                        </div>
                    </label>

                    <!-- Light Mode -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_mode" value="light" class="peer sr-only theme-mode-radio" {{ $current['theme_mode'] === 'light' ? 'checked' : '' }}>
                        <div class="p-5 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all flex flex-col items-center text-center gap-3">
                            <span class="text-3xl">☀️</span>
                            <div>
                                <span class="text-sm font-black text-white block">الوضع النهاري الفاتح (Light)</span>
                                <span class="text-[11px] text-slate-400 mt-1 block">خلفيات بيضاء ناصعة ونظيفة مع تباين فائق للقراءة والوضوح في النهار.</span>
                            </div>
                        </div>
                    </label>

                    <!-- System Mode -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_mode" value="system" class="peer sr-only theme-mode-radio" {{ $current['theme_mode'] === 'system' ? 'checked' : '' }}>
                        <div class="p-5 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all flex flex-col items-center text-center gap-3">
                            <span class="text-3xl">💻</span>
                            <div>
                                <span class="text-sm font-black text-white block">تلقائي حسب جهاز الزائر (System)</span>
                                <span class="text-[11px] text-slate-400 mt-1 block">يتبع تلقائياً تفضيل هاتف أو كمبيوتر العميل (Dark / Light).</span>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Visitor Toggle Option -->
                <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between">
                    <div>
                        <span class="text-xs sm:text-sm font-bold text-white block">إتاحة زر تبديل الوضع (نهاري / ليلي) للزوار</span>
                        <span class="text-[11px] text-slate-400 block mt-0.5">إظهار أيقونة الشمس/القمر في شريط التنقل العلوي لتمكين العميل من اختيار الوضع المفضل لديه.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="theme_visitor_toggle" value="1" class="sr-only peer" {{ $current['theme_visitor_toggle'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </div>
            </div>

            <!-- 3. Arabic Typography (Fonts) -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                            3. نوع الخط العربي (Arabic Typography)
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">اختر الخط العربي المناسب لهوية المركز من أشهر خطوط قوقل الحديثة</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($fonts as $fontKey => $font)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="theme_font" value="{{ $fontKey }}" class="peer sr-only theme-font-radio" {{ $current['theme_font'] === $fontKey ? 'checked' : '' }} data-font="{{ $fontKey }}">
                            <div class="p-5 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-black text-white" style="font-family: '{{ $fontKey }}', sans-serif;">{{ $font['name'] }}</span>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-700 peer-checked:border-amber-400 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 rounded-full bg-amber-400 hidden group-has-[:checked]:block"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-400 leading-relaxed">{{ $font['description'] }}</p>
                                <div class="p-3 rounded-xl bg-slate-900 border border-slate-800 text-xs text-amber-300/90 leading-relaxed" style="font-family: '{{ $fontKey }}', sans-serif;">
                                    {{ $font['sample'] }}
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- 4. Corner Radius Style -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                            4. نمط حواف البطاقات والأزرار (Corner Radius)
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">تحديد مدى انحناء الزوايا للأزرار وحاويات الخدمات والنماذج</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Sharp -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_radius" value="sharp" class="peer sr-only theme-radius-radio" {{ $current['theme_radius'] === 'sharp' ? 'checked' : '' }} data-radius="0.5rem">
                        <div class="p-4 rounded-lg bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all text-center space-y-2">
                            <span class="text-xs font-bold text-white block">كلاسيكي خفيف (Sharp)</span>
                            <span class="text-[11px] text-slate-500 font-mono block">Radius: 0.5rem (8px)</span>
                            <div class="w-full h-8 rounded-md bg-slate-800 border border-slate-700 flex items-center justify-center text-[11px] text-slate-400">
                                زوايا حادة
                            </div>
                        </div>
                    </label>

                    <!-- Medium -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_radius" value="medium" class="peer sr-only theme-radius-radio" {{ $current['theme_radius'] === 'medium' ? 'checked' : '' }} data-radius="1rem">
                        <div class="p-4 rounded-2xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all text-center space-y-2">
                            <span class="text-xs font-bold text-white block">عصري متوازن (Modern - موصى به)</span>
                            <span class="text-[11px] text-slate-500 font-mono block">Radius: 1rem (16px)</span>
                            <div class="w-full h-8 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-[11px] text-slate-400">
                                زوايا ناعمة
                            </div>
                        </div>
                    </label>

                    <!-- Pill / Soft -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="theme_radius" value="pill" class="peer sr-only theme-radius-radio" {{ $current['theme_radius'] === 'pill' ? 'checked' : '' }} data-radius="1.5rem">
                        <div class="p-4 rounded-3xl bg-slate-950 border-2 border-slate-800 peer-checked:border-amber-400 peer-checked:bg-slate-900 transition-all text-center space-y-2">
                            <span class="text-xs font-bold text-white block">منحني فاخر (Curved / Pill)</span>
                            <span class="text-[11px] text-slate-500 font-mono block">Radius: 1.5rem (24px)</span>
                            <div class="w-full h-8 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-[11px] text-slate-400">
                                زوايا دائرية عريضة
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 5. Display & Visual Component Controls -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                            5. خيارات العرض والعناصر التفاعلية
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">تمكين أو تعطيل المكونات الجمالية وأزرار الطوارئ في الموقع</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Ticker -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-white block">إظهار شريط الطوارئ المتحرك 24/7 أعلى الموقع</span>
                            <span class="text-[11px] text-slate-400 block mt-0.5">شريط لافت بأعلى الشاشة يوضح خدمة الطوارئ السريعة لجميع أحياء الرياض مع رقم الاتصال المباشر.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_emergency_ticker" value="1" class="sr-only peer" {{ $current['show_emergency_ticker'] ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>

                    <!-- Floating Buttons -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-white block">إظهار أزرار الاتصال السريع العائمة (WhatsApp & Phone)</span>
                            <span class="text-[11px] text-slate-400 block mt-0.5">أزرار ثابتة أسفل يمين الشاشة تتيح للعميل محادثة واتساب فورية أو الاتصال برقم الطوارئ بنقرة واحدة.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_floating_buttons" value="1" class="sr-only peer" {{ $current['show_floating_buttons'] ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>

                    <!-- Home Articles -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-between">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-white block">إظهار قسم المدونة وأحدث المقالات في الصفحة الرئيسية</span>
                            <span class="text-[11px] text-slate-400 block mt-0.5">عرض أحدث 3 مقالات ونصائح مفاتيح السيارات والأقفال الذكية لتعزيز محركات البحث والثقة.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_home_articles" value="1" class="sr-only peer" {{ $current['show_home_articles'] ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>

                    <!-- Header Style -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-xs sm:text-sm font-bold text-white block">نمط شريط التنقل (الهيدر)</span>
                            <span class="text-[11px] text-slate-400 block mt-0.5">هل يلتصق الهيدر بأعلى الشاشة عند التمرير لأسفل (Sticky) أم يبقى في أعلى الصفحة فقط؟</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="inline-flex items-center gap-1.5 text-xs text-slate-300 font-bold cursor-pointer">
                                <input type="radio" name="header_style" value="sticky" class="text-amber-500 focus:ring-0" {{ $current['header_style'] === 'sticky' ? 'checked' : '' }}>
                                ثابت عند التمرير (Sticky)
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-xs text-slate-300 font-bold cursor-pointer mr-3">
                                <input type="radio" name="header_style" value="static" class="text-amber-500 focus:ring-0" {{ $current['header_style'] === 'static' ? 'checked' : '' }}>
                                عادي (Static)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Action -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                <a href="{{ route('home') }}" target="_blank" class="text-xs font-bold text-slate-400 hover:text-white transition-colors inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    معاينة الموقع الخارجي في تبويب جديد
                </a>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="submit" class="flex-1 sm:flex-initial px-8 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm transition-all shadow-xl shadow-amber-500/20 active:scale-95 cursor-pointer">
                        حفظ وتطبيق المظهر الآن
                    </button>
                </div>
            </div>

        </form>

    </div>

    <!-- Live Preview Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logoBox = document.getElementById('preview-logo-box');
            const brandSub = document.getElementById('preview-brand-sub');
            const badge = document.getElementById('preview-badge');
            const btnCta = document.getElementById('preview-btn-cta');
            const price = document.getElementById('preview-price');
            const iconBox = document.getElementById('preview-icon-box');
            const previewContainer = document.getElementById('preview-container');
            const previewMockup = document.getElementById('preview-mockup');
            const colorLabel = document.getElementById('preview-color-label');

            const customRadio = document.getElementById('preset_custom_radio');
            const customPicker = document.getElementById('theme_custom_picker');
            const customInput = document.getElementById('theme_custom_color');

            function applyColor(hex, rgb, name) {
                if (logoBox) logoBox.style.backgroundColor = hex;
                if (brandSub) brandSub.style.color = hex;
                if (btnCta) {
                    btnCta.style.background = 'linear-gradient(135deg, ' + hex + ', #fbbf24)';
                }
                if (price) price.style.color = hex;
                if (colorLabel && name) colorLabel.textContent = name + ' (' + hex + ')';

                if (badge) {
                    badge.style.color = hex;
                    badge.style.backgroundColor = 'rgba(' + rgb + ', 0.12)';
                    badge.style.borderColor = 'rgba(' + rgb + ', 0.3)';
                }

                if (iconBox) {
                    iconBox.style.color = hex;
                    iconBox.style.backgroundColor = 'rgba(' + rgb + ', 0.15)';
                }
            }

            // Radio colors
            document.querySelectorAll('.theme-preset-radio').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        const hex = this.getAttribute('data-c500');
                        const rgb = this.getAttribute('data-rgb');
                        const name = this.getAttribute('data-name');
                        applyColor(hex, rgb, name);
                    }
                });
            });

            // Theme mode preview
            document.querySelectorAll('.theme-mode-radio').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.checked && previewMockup) {
                        if (this.value === 'light') {
                            previewMockup.style.backgroundColor = '#ffffff';
                            previewMockup.style.borderColor = '#e2e8f0';
                            document.querySelectorAll('#preview-mockup .bg-slate-900').forEach(function(el) {
                                el.style.backgroundColor = '#f8fafc';
                                el.style.borderColor = '#e2e8f0';
                            });
                            document.querySelectorAll('#preview-mockup .text-white').forEach(function(el) {
                                el.style.color = '#0f172a';
                            });
                            document.querySelectorAll('#preview-mockup .text-slate-400').forEach(function(el) {
                                el.style.color = '#64748b';
                            });
                        } else {
                            previewMockup.style.backgroundColor = '#020617';
                            previewMockup.style.borderColor = '#1e293b';
                            document.querySelectorAll('#preview-mockup .bg-slate-900').forEach(function(el) {
                                el.style.backgroundColor = '#0f172a';
                                el.style.borderColor = '#1e293b';
                            });
                            document.querySelectorAll('#preview-mockup .text-white').forEach(function(el) {
                                el.style.color = '#ffffff';
                            });
                            document.querySelectorAll('#preview-mockup .text-slate-400').forEach(function(el) {
                                el.style.color = '#94a3b8';
                            });
                        }
                    }
                });
            });

            // Custom picker
            if (customPicker && customInput) {
                customPicker.addEventListener('input', function () {
                    customInput.value = this.value;
                    if (customRadio) {
                        customRadio.checked = true;
                        customRadio.setAttribute('data-c500', this.value);
                    }
                    applyColor(this.value, '245, 158, 11', 'لون مخصص');
                });

                customInput.addEventListener('input', function () {
                    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                        customPicker.value = this.value;
                        if (customRadio) {
                            customRadio.checked = true;
                            customRadio.setAttribute('data-c500', this.value);
                        }
                        applyColor(this.value, '245, 158, 11', 'لون مخصص');
                    }
                });
            }

            // Fonts preview
            document.querySelectorAll('.theme-font-radio').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        const font = this.getAttribute('data-font');
                        if (previewMockup) {
                            previewMockup.style.fontFamily = "'" + font + "', sans-serif";
                        }
                    }
                });
            });

            // Radius preview
            document.querySelectorAll('.theme-radius-radio').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        const radius = this.getAttribute('data-radius');
                        document.querySelectorAll('#preview-mockup .rounded-xl, #preview-mockup .rounded-2xl').forEach(function (el) {
                            el.style.borderRadius = radius;
                        });
                    }
                });
            });
        });
    </script>

@endsection
