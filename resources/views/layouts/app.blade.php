<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings['site_name'] ?? 'مفاتيح الأمان الذهبية' }} | {{ $settings['site_tagline'] ?? 'قص وبرمجة المفاتيح وفتح الأقفال 24/7' }}</title>
    <meta name="description" content="{{ $settings['meta_description'] ?? ('أفضل خدمات قص وبرمجة مفاتيح السيارات وفتح الأقفال للطوارئ على مدار 24 ساعة في ' . ($settings['city_name'] ?? 'الرياض')) }}">

    @include('partials.theme-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-amber-500 selection:text-slate-950">

    @if(\App\Models\Setting::get('show_emergency_ticker', '1') == '1')
    <!-- Top Emergency Notification Bar -->
    <div class="relative bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-500 text-slate-950 py-1.5 px-4 text-xs font-bold shadow-xs border-b border-amber-600/20 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 truncate">
                <span class="inline-flex relative flex h-2 w-2 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-600 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                </span>
                <span class="font-black text-red-950 shrink-0">طوارئ 24/7:</span>
                <span class="truncate">{{ $settings['coverage_note'] ?? ('ورش متنقلة وفنيون مرخصون لجميع أحياء ومناطق ' . ($settings['city_name'] ?? 'الرياض')) }}</span>
            </div>
            <div class="flex items-center gap-3 shrink-0 text-[11px] sm:text-xs">
                <span class="hidden md:inline-flex items-center gap-1 opacity-90 font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>متوسط سرعة الوصول: {{ $settings['arrival_time'] ?? '15 - 25 دقيقة' }}</span>
                </span>
                <span class="hidden md:inline text-slate-900/30">•</span>
                <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="emergency-ticker-btn inline-flex items-center gap-1.5 bg-slate-950 text-white px-3 py-0.5 rounded-full font-black text-xs hover:bg-slate-900 transition-colors shadow-xs">
                    <svg class="w-3 h-3 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>اتصال فوري:</span>
                    <span dir="ltr">{{ $settings['emergency_phone'] ?? '0559998877' }}</span>
                </a>
            </div>
        </div>
    </div>
    @endif

    @php
        $isSticky = \App\Models\Setting::get('header_style', 'sticky') === 'sticky';
        $allowVisitorToggle = (bool) \App\Models\Setting::get('theme_visitor_toggle', '1');
        $showHeaderContactButtons = (bool) \App\Models\Setting::get('show_header_contact_buttons', '1');
    @endphp

    <!-- Main Navigation Bar -->
    <header class="{{ $isSticky ? 'sticky top-0' : 'relative' }} z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800 transition-all duration-300 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-amber-500 via-amber-400 to-yellow-300 p-0.5 shadow-md shadow-amber-500/20 group-hover:scale-105 transition-transform">
                        <div class="w-full h-full bg-slate-950 rounded-[14px] flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-400 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base sm:text-lg font-black tracking-tight text-slate-900 dark:text-white block leading-snug">
                            {{ $settings['site_name'] ?? 'مفاتيح الأمان الذهبية' }}
                        </span>
                        <span class="text-[11px] text-amber-600 dark:text-amber-400 font-bold block leading-none">
                            قص وبرمجة المفاتيح والأقفال الذكية
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-0.5 bg-slate-100/90 dark:bg-slate-800/60 p-1.5 rounded-full border border-slate-200/80 dark:border-slate-700/60 shadow-inner">
                    <a href="{{ route('home') }}#hero" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">الرئيسية</a>
                    <a href="{{ route('home') }}#about" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">من نحن</a>
                    <a href="{{ route('home') }}#services" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">خدماتنا</a>
                    <a href="{{ route('home') }}#gallery" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">معرض الأعمال</a>
                    <a href="{{ route('home') }}#reviews" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">التقييمات</a>
                    <a href="{{ route('articles.index') }}" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">المقالات</a>
                    <a href="{{ route('home') }}#location" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">موقعنا</a>
                    <a href="{{ route('home') }}#contact" class="px-3 xl:px-3.5 py-1.5 rounded-full text-xs xl:text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-white dark:hover:bg-slate-700 transition-all">اتصل بنا</a>
                </nav>

                <!-- Header Actions -->
                <div class="hidden sm:flex items-center gap-2.5 shrink-0">
                    @if($allowVisitorToggle)
                        @if($showHeaderContactButtons)
                            <button type="button" onclick="window.toggleSiteTheme()" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-750 text-slate-700 dark:text-slate-300 transition-colors border border-slate-200 dark:border-slate-700/80 flex items-center justify-center cursor-pointer shadow-xs" aria-label="تبديل المظهر">
                                <svg class="w-5 h-5 theme-icon-sun text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <svg class="w-5 h-5 theme-icon-moon text-blue-400" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                            </button>
                        @else
                            <button type="button" onclick="window.toggleSiteTheme()" class="h-10 px-3.5 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-750 text-slate-700 dark:text-slate-300 transition-colors border border-slate-200 dark:border-slate-700/80 inline-flex items-center gap-2 cursor-pointer shadow-xs text-xs font-bold" aria-label="تبديل المظهر">
                                <svg class="w-4 h-4 theme-icon-sun text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <svg class="w-4 h-4 theme-icon-moon text-blue-400" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                                <span class="theme-text-sun">الوضع الليلي</span>
                                <span class="theme-text-moon" style="display: none;">الوضع النهاري</span>
                            </button>
                        @endif
                    @endif

                    @if($showHeaderContactButtons)
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('مرحباً، أحتاج خدمة مفاتيح عاجلة') }}" target="_blank" class="inline-flex items-center gap-1.5 bg-emerald-50 dark:bg-emerald-500/10 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-600 text-emerald-700 dark:text-emerald-400 font-bold text-xs px-3.5 py-2.5 rounded-full border border-emerald-200 dark:border-emerald-500/30 transition-all shadow-xs group">
                        <svg class="w-4 h-4 fill-current text-emerald-600 dark:text-emerald-400 group-hover:text-white transition-colors" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>واتساب</span>
                    </a>

                    <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-xs xl:text-sm px-4 py-2.5 rounded-full shadow-md shadow-amber-500/25 hover:scale-105 active:scale-95 transition-all">
                        <span class="w-2 h-2 rounded-full bg-slate-950 animate-ping"></span>
                        <span>اتصال طوارئ 24/7</span>
                    </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden items-center gap-2">
                    @if($allowVisitorToggle)
                        <button type="button" onclick="window.toggleSiteTheme()" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-white" aria-label="تبديل المظهر">
                            <svg class="w-5 h-5 theme-icon-sun text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <svg class="w-5 h-5 theme-icon-moon text-blue-400" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        </button>
                    @endif
                    @if($showHeaderContactButtons)
                    <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="p-2.5 rounded-xl bg-amber-500 text-slate-950 font-black">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </a>
                    @endif
                    <button type="button" id="mobile-menu-toggle" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white" aria-label="القائمة">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-800 bg-slate-900/98 px-4 pt-3 pb-6 space-y-2">
            <a href="{{ route('home') }}#hero" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-200 hover:bg-slate-800">الرئيسية</a>
            <a href="{{ route('home') }}#about" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-300 hover:bg-slate-800">من نحن</a>
            <a href="{{ route('home') }}#services" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-300 hover:bg-slate-800">خدماتنا</a>
            <a href="{{ route('home') }}#gallery" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-300 hover:bg-slate-800">معرض الأعمال</a>
            <a href="{{ route('home') }}#reviews" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-300 hover:bg-slate-800">التقييمات</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-amber-400 hover:bg-slate-800">المقالات والنصائح</a>
            <a href="{{ route('home') }}#location" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-300 hover:bg-slate-800">موقعنا</a>
            <a href="{{ route('home') }}#contact" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-300 hover:bg-slate-800">اتصل بنا</a>
            @if($showHeaderContactButtons)
            <div class="pt-4 flex flex-col gap-2">
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}" target="_blank" class="w-full text-center py-3 bg-emerald-600 text-white rounded-xl font-bold flex items-center justify-center gap-2">
                    محادثة واتساب سريعة
                </a>
                <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="w-full text-center py-3 bg-amber-500 text-slate-950 rounded-xl font-black flex items-center justify-center gap-2">
                    اتصال طوارئ 24 ساعة
                </a>
            </div>
            @endif
        </div>
    </header>

    <!-- Success Toast Notification -->
    @if(session('success'))
        <div id="flash-toast" class="fixed bottom-6 left-6 z-50 max-w-md bg-emerald-500 text-slate-950 p-4 rounded-2xl shadow-2xl flex items-start gap-3 border-2 border-emerald-300 animate-bounce">
            <svg class="w-6 h-6 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="flex-1">
                <div class="font-bold text-base">تم بنجاح!</div>
                <div class="text-sm font-semibold text-slate-900">{{ session('success') }}</div>
            </div>
            <button onclick="document.getElementById('flash-toast').remove()" class="text-slate-950/60 hover:text-slate-950 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800/80 pt-16 pb-12 text-slate-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: About & Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center text-slate-950 font-black shadow-lg shadow-amber-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                        <span class="text-xl font-black text-white">{{ $settings['site_name'] ?? 'مفاتيح الأمان الذهبية' }}</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-400">
                        المركز المتخصص الأول في قص وبرمجة مفاتيح السيارات الحديثة، واستخراج ريموتات البصمة، وفتح كافة أقفال المنازل والخزائن للطوارئ بدون كسر على مدار الساعة.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                            ترخيص مهني معتمد
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                            ضمان كامل على الأعمال
                        </span>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        أقسام الموقع
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}#hero" class="hover:text-amber-400 transition-colors">الصفحة الرئيسية</a></li>
                        <li><a href="{{ route('home') }}#about" class="hover:text-amber-400 transition-colors">من نحن ومميزاتنا</a></li>
                        <li><a href="{{ route('home') }}#services" class="hover:text-amber-400 transition-colors">خدمات الأقفال والمفاتيح</a></li>
                        <li><a href="{{ route('home') }}#gallery" class="hover:text-amber-400 transition-colors">معرض الأعمال والتجهيزات</a></li>
                        <li><a href="{{ route('home') }}#reviews" class="hover:text-amber-400 transition-colors">تجارب وتقييمات العملاء</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-amber-400 transition-colors">المقالات والنصائح التوعوية</a></li>
                        <li><a href="{{ route('home') }}#location" class="hover:text-amber-400 transition-colors">الموقع الجغرافي وساعات العمل</a></li>
                    </ul>
                </div>

                <!-- Col 3: Services -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        أبرز الخدمات
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">برمجة مفاتيح وبصمات السيارات</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">فتح أبواب المنازل والفلل المقفلة</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">تركيب وبرمجة الأقفال الذكية</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">فتح وصيانة الخزنات والتجوري</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">قص ليزر وعمل ماستر كي للعمائر</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">ورشة الطوارئ المتنقلة 24/7</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Hours -->
                <div class="space-y-3">
                    <h3 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        بيانات الاتصال
                    </h3>
                    <div class="flex items-start gap-3 text-sm">
                        <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $settings['address'] ?? (($settings['city_name'] ?? 'الرياض') . ' - طريق الملك فهد') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ $settings['phone'] ?? '0551234567' }}" dir="ltr" class="hover:text-white">{{ $settings['phone'] ?? '0551234567' }}</a>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ $settings['email'] ?? 'info@keyshop.com' }}" class="hover:text-white">{{ $settings['email'] ?? 'info@keyshop.com' }}</a>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300">
                        <div class="font-bold text-amber-400 mb-1">أوقات العمل:</div>
                        {{ $settings['working_hours'] ?? 'طوارئ 24 ساعة لجميع أيام الأسبوع' }}
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Admin link -->
            <div class="pt-8 border-t border-slate-800/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <p>© {{ date('Y') }} {{ $settings['site_name'] ?? 'مفاتيح الأمان الذهبية' }}. جميع الحقوق محفوظة.</p>
                <div class="flex items-center gap-4">
                    <span class="text-slate-600">تصميم وتطوير بأحدث معايير الأمان</span>
                    <a href="{{ route('admin.login') }}" class="text-slate-500 hover:text-amber-400 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        دخول لوحة التحكم
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @if(\App\Models\Setting::get('show_floating_buttons', '1') == '1')
    <!-- Floating Action Buttons (Call Emergency & WhatsApp) -->
    <div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
        <!-- WhatsApp Floating Button -->
        <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('السلام عليكم، أحتاج مساعدة أو خدمة مفاتيح') }}" target="_blank" class="w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-400 text-white flex items-center justify-center shadow-xl shadow-emerald-500/30 hover:scale-110 transition-transform group relative" title="تواصل عبر الواتساب">
            <span class="absolute right-16 bg-slate-900 text-white text-xs font-bold py-1.5 px-3 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg border border-slate-800">
                محادثة واتساب فورية
            </span>
            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
        </a>

        <!-- Emergency Call Pulsing Button -->
        <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="w-14 h-14 rounded-full bg-gradient-to-r from-red-600 to-amber-500 hover:from-red-500 hover:to-amber-400 text-white flex items-center justify-center shadow-xl shadow-red-500/30 hover:scale-110 transition-transform group relative" title="اتصال طوارئ فوري">
            <span class="absolute inset-0 rounded-full bg-red-500 animate-ping opacity-30"></span>
            <span class="absolute right-16 bg-slate-900 text-white text-xs font-bold py-1.5 px-3 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg border border-slate-800">
                طوارئ 24 ساعة (اتصال مباشر)
            </span>
            <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </a>
    </div>
    @endif

    <!-- Mobile menu toggle script -->
    <script>
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
