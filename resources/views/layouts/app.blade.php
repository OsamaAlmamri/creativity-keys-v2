<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.seo')

    @include('partials.theme-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-amber-500 selection:text-white">

    @if(\App\Models\Setting::get('show_emergency_ticker', '1') == '1')
        <!-- Top Emergency Notification Bar -->
        <div
            class="relative bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-500 text-white py-1.5 px-4 text-xs font-bold shadow-xs border-b border-amber-600/20 z-50">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <div class="flex items-center gap-2 truncate">
                    <span class="inline-flex relative flex h-2 w-2 shrink-0">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-600 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                    </span>
                    <span class="font-black text-red-950 shrink-0">طوارئ 24/7:</span>
                    <span
                        class="truncate">{{ $settings['coverage_note'] ?? ('ورش متنقلة وفنيون مرخصون لجميع أحياء ومناطق ' . ($settings['city_name'] ?? 'جدة')) }}</span>
                </div>
                <div class="flex items-center gap-3 shrink-0 text-[11px] sm:text-xs">
                    <span class="hidden md:inline-flex items-center gap-1 opacity-90 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>متوسط سرعة الوصول: {{ $settings['arrival_time'] ?? '15 - 25 دقيقة' }}</span>
                    </span>
                    <span class="hidden md:inline text-slate-900/30">•</span>
                    <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}"
                        class="emergency-ticker-btn inline-flex items-center gap-1.5 bg-slate-950 text-white px-3 py-0.5 rounded-full font-black text-xs hover:bg-slate-900 transition-colors shadow-xs">
                        <svg class="w-3 h-3 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
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
    <header
        class="{{ $isSticky ? 'sticky top-0' : 'relative' }} z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800 transition-all duration-300 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">
                <!-- Brand Logo & Site Identity -->
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 transition-opacity hover:opacity-85 shrink-0 group">
                    @if(!empty($settings['site_logo']))
                        <img src="{{ $settings['site_logo'] }}"
                            alt="{{ $settings['site_name'] ?? 'مفتاح الإبداع' }}"
                            class="h-11 w-11 rounded-xl object-contain bg-slate-900 border border-slate-800 p-0.5 shadow-sm">
                    @endif
                    <div class="flex flex-col items-start">
                        <span
                            class="text-xl sm:text-2xl font-black tracking-tight text-slate-900 dark:text-white block leading-tight">
                            {{ $settings['site_name'] ?? 'مفتاح الإبداع' }}
                        </span>
                        <span class="mt-0.5 text-[11px] font-bold text-amber-600 dark:text-amber-400 block leading-none">
                            - {{ $settings['site_tagline'] ?? 'لخدمات الأقفال والأمان' }} -
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links (Simplified & Clean) -->
                <nav class="hidden lg:flex items-center gap-5 xl:gap-7 text-sm font-semibold">
                    <x-nav-link :href="route('home') . '#hero'">الرئيسية</x-nav-link>
                    <x-nav-link :href="route('home') . '#about'">من نحن</x-nav-link>
                    <x-nav-link :href="route('home') . '#services'">خدماتنا</x-nav-link>
                    <x-nav-link :href="route('home') . '#gallery'">معرض الصور</x-nav-link>
                    <x-nav-link :href="route('home') . '#reviews'">التقييمات</x-nav-link>
                    <x-nav-link :href="route('home') . '#location'">موقعنا</x-nav-link>
                    <x-nav-link :href="route('home') . '#contact'">تواصل معنا</x-nav-link>
                </nav>

                <!-- Header Actions -->
                <div class="hidden lg:flex items-center gap-3 shrink-0">
                    <a href="{{ route('home') }}#contact"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-amber-500 hover:bg-amber-400 text-white font-bold text-xs sm:text-sm shadow-sm transition-all duration-300 hover:scale-[1.02]">
                        اطلب الخدمة
                    </a>

                    @if($allowVisitorToggle)
                        @if($showHeaderContactButtons)
                            <button type="button" onclick="window.toggleSiteTheme()"
                                class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-750 text-slate-700 dark:text-slate-300 transition-colors border border-slate-200 dark:border-slate-700/80 flex items-center justify-center cursor-pointer shadow-xs"
                                aria-label="تبديل المظهر">
                                <svg class="w-5 h-5 theme-icon-sun text-amber-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <svg class="w-5 h-5 theme-icon-moon text-blue-400" style="display: none;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                            </button>
                        @else
                            <button type="button" onclick="window.toggleSiteTheme()"
                                class="h-10 px-3.5 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-750 text-slate-700 dark:text-slate-300 transition-colors border border-slate-200 dark:border-slate-700/80 inline-flex items-center gap-2 cursor-pointer shadow-xs text-xs font-bold"
                                aria-label="تبديل المظهر">
                                <svg class="w-4 h-4 theme-icon-sun text-amber-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <svg class="w-4 h-4 theme-icon-moon text-blue-400" style="display: none;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                                <span class="theme-text-sun">الوضع الليلي</span>
                                <span class="theme-text-moon" style="display: none;">الوضع النهاري</span>
                            </button>
                        @endif
                    @endif

                    @if($showHeaderContactButtons)
                        <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('مرحباً، أحتاج خدمة مفاتيح عاجلة') }}"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 bg-emerald-50 dark:bg-emerald-500/10 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-600 text-emerald-700 dark:text-emerald-400 font-bold text-xs px-3.5 py-2.5 rounded-full border border-emerald-200 dark:border-emerald-500/30 transition-all shadow-xs group">
                            <svg class="w-4 h-4 fill-current text-emerald-600 dark:text-emerald-400 group-hover:text-white transition-colors"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            <span>واتساب</span>
                        </a>

                        <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-white font-black text-xs xl:text-sm px-4 py-2.5 rounded-full shadow-md shadow-amber-500/25 hover:scale-105 active:scale-95 transition-all">
                            <span class="w-2 h-2 rounded-full bg-slate-950 animate-ping"></span>
                            <span>اتصال طوارئ 24/7</span>
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden items-center gap-2">
                    @if($allowVisitorToggle)
                        <button type="button" onclick="window.toggleSiteTheme()"
                            class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-white"
                            aria-label="تبديل المظهر">
                            <svg class="w-5 h-5 theme-icon-sun text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <svg class="w-5 h-5 theme-icon-moon text-blue-400" style="display: none;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>
                    @endif
                    @if($showHeaderContactButtons)
                        <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}"
                            class="p-2.5 rounded-xl bg-amber-500 text-white font-black">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </a>
                    @endif
                    <button type="button" id="mobile-menu-toggle"
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:text-white dark:hover:text-white"
                        aria-label="القائمة">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu"
            class="hidden lg:hidden border-t border-slate-800 bg-slate-900/98 px-4 pt-3 pb-6 space-y-2">
            <x-nav-link variant="mobile" :href="route('home') . '#hero'">الرئيسية</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#about'">من نحن</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#services'">خدماتنا</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#features'">لماذا تختارنا</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#coverage'">نطاق التغطية والأحياء</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#gallery'">معرض الأعمال</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#reviews'">التقييمات</x-nav-link>
            <x-nav-link variant="mobile" :href="route('articles.index')" :active="request()->routeIs('articles.*')"
                :highlight="true">المقالات والنصائح</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#location'">موقعنا</x-nav-link>
            <x-nav-link variant="mobile" :href="route('home') . '#contact'">اتصل بنا</x-nav-link>
            @if($showHeaderContactButtons)
                <div class="pt-4 flex flex-col gap-2">
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}" target="_blank"
                        class="w-full text-center py-3 bg-emerald-600 text-white rounded-xl font-bold flex items-center justify-center gap-2">
                        محادثة واتساب سريعة
                    </a>
                    <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}"
                        class="w-full text-center py-3 bg-amber-500 text-white rounded-xl font-black flex items-center justify-center gap-2">
                        اتصال طوارئ 24 ساعة
                    </a>
                </div>
            @endif
        </div>
    </header>

    <!-- Success Toast Notification -->
    @if(session('success'))
        <div id="flash-toast"
            class="fixed bottom-6 left-6 z-50 max-w-md bg-emerald-500 text-white p-4 rounded-2xl shadow-2xl flex items-start gap-3 border-2 border-emerald-300 animate-bounce">
            <svg class="w-6 h-6 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <div class="font-bold text-base">تم بنجاح!</div>
                <div class="text-sm font-semibold text-slate-900">{{ session('success') }}</div>
            </div>
            <button onclick="document.getElementById('flash-toast').remove()" class="text-white/60 hover:text-white p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
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
                        @if(!empty($settings['site_logo']))
                            <div
                                class="h-10 flex items-center justify-center p-1 rounded-xl bg-slate-900 border border-slate-800 shadow-md">
                                <img src="{{ $settings['site_logo'] }}"
                                    alt="{{ $settings['site_name'] ?? 'مفتاح الإبداع' }}"
                                    class="h-8 w-auto max-w-[140px] object-contain">
                            </div>
                        @else
                            <div
                                class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center text-white font-black shadow-lg shadow-amber-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                        @endif
                        <span
                            class="text-xl font-black text-white">{{ $settings['site_name'] ?? 'مفتاح الإبداع' }}</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-400">
                        المركز المتخصص الأول في قص وبرمجة مفاتيح السيارات الحديثة، واستخراج ريموتات البصمة، وفتح كافة
                        أقفال المنازل والخزائن للطوارئ بدون كسر على مدار الساعة.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                            ترخيص مهني معتمد
                        </span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                            ضمان كامل على الأعمال
                        </span>
                    </div>

                    <!-- Social Media Links (Only display platforms with non-empty URLs) -->
                    @php
                        $socialPlatforms = [
                            'social_twitter' => [
                                'name' => 'منصة X (تويتر)',
                                'url' => $settings['social_twitter'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                                'hover' => 'hover:bg-slate-900 hover:text-white hover:border-slate-700',
                            ],
                            'social_instagram' => [
                                'name' => 'انستغرام',
                                'url' => $settings['social_instagram'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.13-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
                                'hover' => 'hover:bg-gradient-to-tr hover:from-amber-600 hover:to-pink-600 hover:text-white hover:border-pink-500/50',
                            ],
                            'social_tiktok' => [
                                'name' => 'تيك توك',
                                'url' => $settings['social_tiktok'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
                                'hover' => 'hover:bg-slate-900 hover:text-white hover:border-slate-700',
                            ],
                            'social_telegram' => [
                                'name' => 'تيليجرام',
                                'url' => $settings['social_telegram'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>',
                                'hover' => 'hover:bg-sky-500 hover:text-white hover:border-sky-400',
                            ],
                            'social_snapchat' => [
                                'name' => 'سناب شات',
                                'url' => $settings['social_snapchat'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.001 0c-4.493 0-8.136 3.642-8.136 8.136 0 1.25.281 2.438.784 3.504-.202.483-.699.967-1.393 1.23-.396.15-.461.579-.126.828.66.49 1.483.744 2.378.744.135 0 .273-.006.411-.018.666 1.341 1.869 2.227 3.243 2.535-.297.771-1.038 1.491-2.427 1.875-.411.114-.543.597-.234.876 1.05.945 2.583 1.485 4.317 1.485.459 0 .915-.039 1.362-.114.363-.06.726-.144 1.08-.252.357.108.72.192 1.083.252.447.075.903.114 1.362.114 1.734 0 3.267-.54 4.317-1.485.309-.279.177-.762-.234-.876-1.389-.384-2.13-1.104-2.427-1.875 1.374-.309 2.577-1.194 3.243-2.535.138.012.276.018.411.018.894 0 1.719-.255 2.379-.744.336-.249.27-.678-.126-.828-.693-.264-1.191-.747-1.392-1.23.504-1.065.783-2.253.783-3.504 0-4.494-3.642-8.136-8.136-8.136z"/></svg>',
                                'hover' => 'hover:bg-yellow-400 hover:text-white hover:border-yellow-400',
                            ],
                            'social_facebook' => [
                                'name' => 'فيسبوك',
                                'url' => $settings['social_facebook'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
                                'hover' => 'hover:bg-blue-600 hover:text-white hover:border-blue-500',
                            ],
                            'social_youtube' => [
                                'name' => 'يوتيوب',
                                'url' => $settings['social_youtube'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                                'hover' => 'hover:bg-red-600 hover:text-white hover:border-red-500',
                            ],
                            'social_linkedin' => [
                                'name' => 'لينكد إن',
                                'url' => $settings['social_linkedin'] ?? '',
                                'icon' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>',
                                'hover' => 'hover:bg-sky-600 hover:text-white hover:border-sky-500',
                            ],
                        ];
                        $activeSocials = array_filter($socialPlatforms, fn($p) => !empty(trim($p['url'] ?? '')));
                    @endphp

                    @if(!empty($activeSocials))
                        <div class="pt-2">
                            <span class="text-xs font-bold text-slate-300 block mb-2">تابعنا على وسائل التواصل:</span>
                            <div class="flex items-center gap-2 flex-wrap">
                                @foreach($activeSocials as $key => $social)
                                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                        aria-label="{{ $social['name'] }}" title="{{ $social['name'] }}"
                                        class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 text-slate-400 {{ $social['hover'] }} flex items-center justify-center transition-all duration-200 shadow-sm hover:scale-110 active:scale-95">
                                        {!! $social['icon'] !!}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        أقسام الموقع
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><x-nav-link variant="footer" :href="route('home') . '#hero'">الصفحة الرئيسية</x-nav-link>
                        </li>
                        <li><x-nav-link variant="footer" :href="route('home') . '#about'">من نحن ومميزاتنا</x-nav-link>
                        </li>
                        <li><x-nav-link variant="footer" :href="route('home') . '#services'">خدمات الأقفال
                                والمفاتيح</x-nav-link></li>
                        <li><x-nav-link variant="footer" :href="route('home') . '#gallery'">معرض الأعمال
                                والتجهيزات</x-nav-link></li>
                        <li><x-nav-link variant="footer" :href="route('home') . '#reviews'">تجارب وتقييمات
                                العملاء</x-nav-link></li>
                        <li><x-nav-link variant="footer" :href="route('articles.index')"
                                :active="request()->routeIs('articles.*')">المقالات والنصائح التوعوية</x-nav-link></li>
                        <li><x-nav-link variant="footer" :href="route('home') . '#location'">الموقع الجغرافي وساعات
                                العمل</x-nav-link></li>
                    </ul>
                </div>

                <!-- Col 3: Services -->
                <div>
                    <h3 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        أبرز الخدمات
                    </h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">برمجة مفاتيح وبصمات
                                السيارات</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">فتح أبواب المنازل والفلل
                                المقفلة</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">تركيب وبرمجة الأقفال
                                الذكية</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">فتح وصيانة الخزنات
                                والتجوري</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">قص ليزر وعمل ماستر كي
                                للعمائر</a></li>
                        <li><a href="#services" class="hover:text-amber-400 transition-colors">ورشة الطوارئ المتنقلة
                                24/7</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Hours -->
                <div class="space-y-3">
                    <h3 class="text-white font-bold text-base mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        بيانات الاتصال
                    </h3>
                    <div class="flex items-start gap-3 text-sm">
                        <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $settings['address'] ?? (($settings['city_name'] ?? 'جدة') . ' - طريق الملك عبد العزيز') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:{{ $settings['phone'] ?? '0551234567' }}" dir="ltr"
                            class="hover:text-white">{{ $settings['phone'] ?? '0551234567' }}</a>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:{{ $settings['email'] ?? 'info@keyshop.com' }}" class="hover:text-white">{{
                            $settings['email'] ?? 'info@keyshop.com' }}</a>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300">
                        <div class="font-bold text-amber-400 mb-1">أوقات العمل:</div>
                        {{ $settings['working_hours'] ?? 'طوارئ 24 ساعة لجميع أيام الأسبوع' }}
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Admin link -->
            <div
                class="pt-8 border-t border-slate-800/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <p>© {{ date('Y') }} {{ $settings['site_name'] ?? 'مفتاح الإبداع' }}. برمجة وتطوير <a
                        href="https://github.com/OsamaAlmamri" target="_blank"
                        class="text-amber-400 hover:underline">أسامة المعمري</a>. جميع الحقوق محفوظة.</p>
                <div class="flex items-center gap-4">
                    <span class="text-slate-600">تصميم وتطوير بأحدث معايير الأمان</span>
                    <a href="{{ route('admin.login') }}"
                        class="text-slate-500 hover:text-amber-400 transition-colors inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        دخول لوحة التحكم
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @if(\App\Models\Setting::get('show_floating_buttons', '1') == '1')
        <!-- Floating Action Buttons (WhatsApp, Phone Call & Back To Top) -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col items-center gap-2.5" aria-label="تواصل سريع">
            <!-- 1. WhatsApp Button -->
            <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966568191921' }}?text={{ urlencode('السلام عليكم، أحتاج مساعدة أو خدمة مفاتيح') }}"
                target="_blank" rel="noopener noreferrer"
                class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#25D366] hover:bg-[#1EBE5D] text-white flex items-center justify-center shadow-lg shadow-[#25D366]/30 hover:-translate-y-1 transition-all duration-300 group relative"
                aria-label="تواصل عبر الواتساب">
                <span
                    class="absolute right-14 bg-slate-900 text-white text-xs font-bold py-1 px-2.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg border border-slate-800 pointer-events-none">
                    واتساب
                </span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
            </a>

            <!-- 2. Phone Call Button -->
            <a href="tel:{{ $settings['emergency_phone'] ?? '0568191921' }}"
                class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#4A6B53] hover:bg-[#3A5A40] text-white flex items-center justify-center shadow-lg shadow-[#4A6B53]/30 hover:-translate-y-1 transition-all duration-300 group relative"
                aria-label="اتصل بنا">
                <span
                    class="absolute right-14 bg-slate-900 text-white text-xs font-bold py-1 px-2.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg border border-slate-800 pointer-events-none">
                    اتصال مباشر
                </span>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                </svg>
            </a>

            <!-- 3. Back to Top Button -->
            <button type="button" id="backToTop"
                class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-white hover:bg-slate-100 text-slate-800 flex items-center justify-center shadow-lg shadow-slate-900/10 border border-slate-200/90 hover:-translate-y-1 transition-all duration-300 opacity-0 invisible pointer-events-none cursor-pointer"
                aria-label="الرجوع للأعلى">
                <svg class="w-5 h-5 text-slate-800 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Scripts (Mobile Menu & Back to Top) -->
    <script>
        (function () {
            // Mobile Menu Drawer Toggle
            document.getElementById('mobile-menu-toggle')?.addEventListener('click', function () {
                const menu = document.getElementById('mobile-menu');
                menu?.classList.toggle('hidden');
            });

            // Back to Top Button Visibility and Smooth Scroll
            const backToTopBtn = document.getElementById('backToTop');
            if (backToTopBtn) {
                const updateBackToTop = function () {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
                        backToTopBtn.classList.add('opacity-100', 'visible', 'pointer-events-auto');
                    } else {
                        backToTopBtn.classList.add('opacity-0', 'invisible', 'pointer-events-none');
                        backToTopBtn.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
                    }
                };

                window.addEventListener('scroll', updateBackToTop, { passive: true });
                updateBackToTop();

                backToTopBtn.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        })();
    </script>
</body>

</html>