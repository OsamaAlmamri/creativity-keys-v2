@php
    $themePreset = \App\Models\Setting::get('theme_preset', 'amber');
    $themeCustom = \App\Models\Setting::get('theme_custom_color', '#f59e0b');
    $themeMode = \App\Models\Setting::get('theme_mode', 'dark');
    $themeFont = \App\Models\Setting::get('theme_font', 'Cairo');
    $themeRadius = \App\Models\Setting::get('theme_radius', 'medium');
    $visitorToggle = (bool) \App\Models\Setting::get('theme_visitor_toggle', '1');

    $activeColors = \App\Services\ThemeService::getActiveColors();

    $radiusMap = [
        'sharp' => '0.5rem',
        'medium' => '1rem',
        'pill' => '1.5rem',
    ];
    $radiusVal = $radiusMap[$themeRadius] ?? '1rem';
@endphp

<!-- Google Fonts (Cairo, Tajawal, Alexandria, Almarai) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;400;600;700;800;900&family=Almarai:wght@300;400;700;800&family=Cairo:wght@300;400;500;600;700;800;900&family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

<style>
    :root {
        --brand-font: '{{ $themeFont }}', system-ui, -apple-system, sans-serif;
        --brand-300: {{ $activeColors['300'] }};
        --brand-400: {{ $activeColors['400'] }};
        --brand-500: {{ $activeColors['500'] }};
        --brand-600: {{ $activeColors['600'] }};
        --brand-700: {{ $activeColors['700'] }};
        --brand-rgb: {{ $activeColors['rgb'] }};
        --brand-radius: {{ $radiusVal }};

        /* Direct Tailwind Theme Color Mapping */
        --color-amber-300: var(--brand-300);
        --color-amber-400: var(--brand-400);
        --color-amber-500: var(--brand-500);
        --color-amber-600: var(--brand-600);
        --color-amber-700: var(--brand-700);
        --color-yellow-300: var(--brand-300);
        --color-yellow-400: var(--brand-400);
        --color-yellow-500: var(--brand-500);
    }

    html, body {
        font-family: var(--brand-font) !important;
    }

    ::selection {
        background-color: var(--brand-500) !important;
        color: #ffffff !important;
    }

    /* Dynamic Hero Radial Glow Background */
    .hero-radial-glow {
        background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(var(--brand-rgb), 0.22), rgba(2, 6, 23, 0));
    }
    html.theme-light .hero-radial-glow {
        background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(var(--brand-rgb), 0.14), rgba(248, 250, 252, 0));
    }

    /* Dynamic Brand Utilities */
    .bg-brand-primary {
        background-color: var(--brand-500) !important;
    }
    .text-brand-primary {
        color: var(--brand-500) !important;
    }
    .border-brand-primary {
        border-color: var(--brand-500) !important;
    }
    .shadow-brand {
        box-shadow: 0 10px 25px -5px rgba(var(--brand-rgb), 0.3) !important;
    }

    /* Dynamic Brand Linear Gradients */
    .bg-brand-gradient {
        background: linear-gradient(135deg, var(--brand-600) 0%, var(--brand-500) 50%, var(--brand-400) 100%) !important;
    }
    .hover\:bg-brand-gradient:hover {
        background: linear-gradient(135deg, var(--brand-500) 0%, var(--brand-400) 50%, var(--brand-300) 100%) !important;
    }
    .text-brand-gradient {
        background: linear-gradient(135deg, var(--brand-300) 0%, var(--brand-400) 50%, var(--brand-500) 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }

    /* Dynamic Hover & Transitions */
    .group:hover .group-hover\:text-amber-400,
    .group:hover .group-hover\:text-amber-300 {
        color: var(--brand-400) !important;
    }

    .hover\:text-amber-400:hover,
    .hover\:text-amber-300:hover {
        color: var(--brand-400) !important;
    }

    .hover\:border-amber-400:hover,
    .hover\:border-amber-500\/40:hover {
        border-color: var(--brand-400) !important;
    }

    .hover\:bg-amber-400:hover,
    .hover\:bg-amber-500:hover {
        background-color: var(--brand-400) !important;
    }

    .hover\:from-amber-400:hover {
        --tw-gradient-from: var(--brand-400) var(--tw-gradient-from-position) !important;
    }

    .hover\:to-yellow-400:hover,
    .hover\:to-amber-500:hover {
        --tw-gradient-to: var(--brand-300) var(--tw-gradient-to-position) !important;
    }

    /* Dynamic Brand Shadow Glows */
    .shadow-amber-500\/20,
    .shadow-amber-500\/25,
    .shadow-amber-500\/30,
    .shadow-amber-500\/10 {
        --tw-shadow-color: rgba(var(--brand-rgb), 0.25) !important;
        box-shadow: 0 10px 25px -5px rgba(var(--brand-rgb), 0.25) !important;
    }

    .hover\:shadow-amber-500\/10:hover,
    .hover\:shadow-amber-500\/20:hover {
        box-shadow: 0 20px 25px -5px rgba(var(--brand-rgb), 0.22) !important;
    }

    /* Smooth Interactive Card Hover */
    .hover-brand-card {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-brand-card:hover {
        transform: translateY(-4px);
        border-color: var(--brand-400) !important;
        box-shadow: 0 20px 25px -5px rgba(var(--brand-rgb), 0.16), 0 8px 10px -6px rgba(var(--brand-rgb), 0.1) !important;
    }

    /* Focus states */
    input:focus, textarea:focus, select:focus {
        border-color: var(--brand-400) !important;
        --tw-ring-color: rgba(var(--brand-rgb), 0.2) !important;
    }

    /* Radius Modifiers */
    @if($themeRadius === 'sharp')
        .rounded-2xl { border-radius: 0.5rem !important; }
        .rounded-3xl { border-radius: 0.75rem !important; }
    @elseif($themeRadius === 'pill')
        .rounded-2xl { border-radius: 1.5rem !important; }
        .rounded-3xl { border-radius: 2rem !important; }
    @endif

    /* ========================================================= */
    /* ☀️ COMPLETE LIGHT MODE OVERHAUL (متناسق، مريح ومثالي)       */
    /* ========================================================= */

    html.theme-light body,
    body.theme-light {
        background-color: #f8fafc !important;
        color: #1e293b !important;
    }

    /* 1. Global Backgrounds & Gradients in Light Mode */
    html.theme-light .bg-slate-950 {
        background-color: #ffffff !important;
    }

    html.theme-light .bg-slate-900 {
        background-color: #ffffff !important;
    }

    html.theme-light .bg-slate-900\/90,
    html.theme-light .bg-slate-900\/80,
    html.theme-light .bg-slate-900\/60,
    html.theme-light .bg-slate-900\/50,
    html.theme-light .bg-slate-900\/40,
    html.theme-light .bg-slate-900\/98 {
        background-color: rgba(255, 255, 255, 0.96) !important;
    }

    html.theme-light .bg-slate-800,
    html.theme-light .bg-slate-800\/60,
    html.theme-light .bg-slate-800\/80 {
        background-color: #f1f5f9 !important;
    }

    html.theme-light .border-slate-800,
    html.theme-light .border-slate-800\/80,
    html.theme-light .border-slate-800\/60,
    html.theme-light .border-slate-700,
    html.theme-light .border-slate-700\/60,
    html.theme-light .border-slate-750 {
        border-color: #e2e8f0 !important;
    }

    /* Section Gradients in Light Mode */
    html.theme-light #hero,
    html.theme-light .bg-gradient-to-b.from-slate-950.via-slate-900.to-slate-950 {
        background-image: linear-gradient(180deg, #ffffff 0%, #f1f5f9 60%, #f8fafc 100%) !important;
    }

    /* Hero Headline Gradient in Light Mode - High Contrast */
    html.theme-light .text-brand-gradient {
        background: linear-gradient(135deg, var(--brand-700) 0%, var(--brand-600) 50%, var(--brand-500) 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }

    /* 2. Text Color Harmony in Light Mode */
    html.theme-light h1,
    html.theme-light h2,
    html.theme-light h3,
    html.theme-light h4,
    html.theme-light h5,
    html.theme-light h6 {
        color: #0f172a !important;
    }

    html.theme-light p {
        color: #334155 !important;
    }

    html.theme-light .text-slate-100 {
        color: #0f172a !important;
    }

    html.theme-light .text-slate-200 {
        color: #1e293b !important;
    }

    html.theme-light .text-slate-300 {
        color: #475569 !important;
    }

    html.theme-light .text-slate-400 {
        color: #64748b !important;
    }

    html.theme-light .text-slate-500 {
        color: #64748b !important;
    }

    /* Replace pale text colors with rich, readable contrast on white */
    html.theme-light .text-amber-400,
    html.theme-light .text-amber-300 {
        color: var(--brand-700, #b45309) !important;
    }

    html.theme-light .text-emerald-400 {
        color: #047857 !important;
    }

    html.theme-light .text-blue-400 {
        color: #1d4ed8 !important;
    }

    html.theme-light .text-red-400 {
        color: #b91c1c !important;
    }

    html.theme-light .text-purple-400 {
        color: #7e22ce !important;
    }

    /* 3. PROTECT BUTTONS AND OVERLAYS WITH INTENDED WHITE TEXT */
    html.theme-light button.text-white,
    html.theme-light a.text-white,
    html.theme-light .bg-emerald-600,
    html.theme-light .bg-emerald-600 *,
    html.theme-light .bg-emerald-500,
    html.theme-light .bg-emerald-500 *,
    html.theme-light .bg-red-600,
    html.theme-light .bg-red-600 *,
    html.theme-light .bg-red-500,
    html.theme-light .bg-red-500 *,
    html.theme-light .bg-gradient-to-r.from-red-600,
    html.theme-light .bg-gradient-to-r.from-red-600 *,
    html.theme-light .gallery-card h3,
    html.theme-light .gallery-card p,
    html.theme-light .gallery-card span.text-white,
    html.theme-light span.bg-red-500.text-white,
    html.theme-light .badge-white-text {
        color: #ffffff !important;
    }

    /* Standalone .text-white elements that are NOT buttons/badges */
    html.theme-light div > .text-white:not(button):not(a):not(span[class*="bg-red"]):not(span[class*="bg-emerald"]),
    html.theme-light tr > td.text-white,
    html.theme-light label.text-white {
        color: #0f172a !important;
    }

    /* 4. Navigation Bar & Header in Light Mode */
    html.theme-light header {
        background-color: rgba(255, 255, 255, 0.94) !important;
        border-bottom-color: #e2e8f0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
    }

    html.theme-light header a > span.text-white {
        color: #0f172a !important;
    }

    html.theme-light header nav {
        background-color: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
    }

    html.theme-light header nav a {
        color: #475569 !important;
    }

    html.theme-light header nav a:hover {
        color: #0f172a !important;
        background-color: #e2e8f0 !important;
    }

    /* 5. Cards & Containers in Light Mode */
    html.theme-light .bg-slate-900.border.border-slate-800,
    html.theme-light .bg-slate-950.border.border-slate-800 {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 4px -2px rgba(15, 23, 42, 0.05) !important;
    }

    /* Sub-panels and inner wells in Light Mode */
    html.theme-light .peer + div {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
    }

    html.theme-light .peer:checked + div {
        background-color: #ffffff !important;
        border-color: var(--brand-500) !important;
        box-shadow: 0 4px 15px -2px rgba(var(--brand-rgb), 0.15) !important;
    }

    /* Font sample preview box in Theme Customizer */
    html.theme-light .theme-font-radio + div > div:last-child {
        background-color: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
        color: var(--brand-700, #b45309) !important;
        font-weight: 600;
    }

    /* Map iframe in Light Mode */
    html.theme-light iframe {
        filter: none !important;
    }

    /* Service Category Badge */
    html.theme-light .bg-slate-800.text-amber-400 {
        background-color: #f1f5f9 !important;
        color: var(--brand-700, #b45309) !important;
        border-color: #cbd5e1 !important;
    }

    /* Gallery Tabs Inactive */
    html.theme-light .gallery-tab-btn:not(.bg-amber-500) {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border-color: #cbd5e1 !important;
    }

    html.theme-light .gallery-tab-btn:not(.bg-amber-500):hover {
        background-color: #e2e8f0 !important;
        color: #0f172a !important;
    }

    /* 6. Form Inputs & Selects in Light Mode */
    html.theme-light input:not([type="checkbox"]):not([type="radio"]):not([type="color"]),
    html.theme-light textarea,
    html.theme-light select {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
    }

    html.theme-light input::placeholder,
    html.theme-light textarea::placeholder {
        color: #94a3b8 !important;
    }

    html.theme-light input:focus,
    html.theme-light textarea:focus,
    html.theme-light select:focus {
        background-color: #ffffff !important;
        border-color: var(--brand-500) !important;
        box-shadow: 0 0 0 3px rgba(var(--brand-rgb), 0.15) !important;
    }

    /* 7. Footer in Light Mode */
    html.theme-light footer {
        background-color: #f8fafc !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light footer p,
    html.theme-light footer a {
        color: #64748b !important;
    }

    html.theme-light footer a:hover {
        color: var(--brand-700, #b45309) !important;
    }

    /* 8. ADMIN PANEL COMPLETE LIGHT MODE STYLING */
    /* Admin Sidebar */
    html.theme-light aside {
        background-color: #ffffff !important;
        border-left-color: #e2e8f0 !important;
    }

    html.theme-light aside .border-b,
    html.theme-light aside .border-t {
        border-color: #e2e8f0 !important;
    }

    html.theme-light aside nav a:not([class*="bg-amber-500"]) {
        color: #475569 !important;
    }

    html.theme-light aside nav a:not([class*="bg-amber-500"]):hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
    }

    html.theme-light aside .bg-slate-950\/60 {
        background-color: #f8fafc !important;
    }

    /* Admin Topbar */
    html.theme-light div.flex-1 > header.h-16 {
        background-color: #ffffff !important;
        border-bottom-color: #e2e8f0 !important;
    }

    html.theme-light div.flex-1 > header.h-16 h1 {
        color: #0f172a !important;
    }

    /* Admin Tables */
    html.theme-light thead.bg-slate-950\/60,
    html.theme-light thead.bg-slate-950 {
        background-color: #f8fafc !important;
        color: #475569 !important;
        border-bottom-color: #e2e8f0 !important;
    }

    html.theme-light tbody.divide-slate-800 > tr,
    html.theme-light tr.hover\:bg-slate-800\/40 {
        border-bottom-color: #f1f5f9 !important;
    }

    html.theme-light tr.hover\:bg-slate-800\/40:hover {
        background-color: #f8fafc !important;
    }

    html.theme-light td {
        color: #1e293b !important;
    }

    /* Admin Stat Cards */
    html.theme-light .rounded-3xl.bg-slate-900.border.border-slate-800 {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
    }

    html.theme-light .font-mono.text-white {
        color: #0f172a !important;
    }

    /* Admin Badges & Pills in Light Mode */
    html.theme-light .bg-emerald-500\/10 {
        background-color: #ecfdf5 !important;
        border-color: #a7f3d0 !important;
    }

    html.theme-light .bg-amber-500\/10,
    html.theme-light .bg-amber-500\/5 {
        background-color: #fffbeb !important;
        border-color: #fde68a !important;
    }

    html.theme-light .bg-blue-500\/10 {
        background-color: #eff6ff !important;
        border-color: #bfdbfe !important;
    }

    html.theme-light .bg-red-500\/10 {
        background-color: #fef2f2 !important;
        border-color: #fecaca !important;
    }

    /* Admin Action Buttons */
    html.theme-light .bg-slate-800.text-white,
    html.theme-light .bg-slate-800.text-slate-300 {
        background-color: #f1f5f9 !important;
        color: #334155 !important;
        border-color: #cbd5e1 !important;
    }

    html.theme-light .bg-slate-800.text-white:hover,
    html.theme-light .bg-slate-800.text-slate-300:hover {
        background-color: #e2e8f0 !important;
        color: #0f172a !important;
    }

    /* Admin Modals */
    html.theme-light .fixed.z-50.bg-slate-950\/80 {
        background-color: rgba(15, 23, 42, 0.6) !important;
    }

    html.theme-light .fixed.z-50 .bg-slate-900 {
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }

    html.theme-light .fixed.z-50 .border-slate-800 {
        border-color: #e2e8f0 !important;
    }

    html.theme-light .fixed.z-50 label {
        color: #334155 !important;
    }
</style>

<!-- Immediate Theme Mode Initialization (Zero Flicker) -->
<script>
    (function () {
        var stored = localStorage.getItem('keyshop_theme_mode');
        var defaultMode = '{{ $themeMode }}';
        var mode = stored || defaultMode;

        if (mode === 'system') {
            mode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        if (mode === 'light') {
            document.documentElement.classList.add('theme-light');
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('theme-light');
        }
    })();

    window.toggleSiteTheme = function () {
        var isLight = document.documentElement.classList.contains('theme-light');
        if (isLight) {
            document.documentElement.classList.remove('theme-light');
            document.documentElement.classList.add('dark');
            localStorage.setItem('keyshop_theme_mode', 'dark');
        } else {
            document.documentElement.classList.add('theme-light');
            document.documentElement.classList.remove('dark');
            localStorage.setItem('keyshop_theme_mode', 'light');
        }
        updateThemeIcons();
    };

    function updateThemeIcons() {
        var isLight = document.documentElement.classList.contains('theme-light');
        document.querySelectorAll('.theme-icon-sun').forEach(function(el) {
            el.style.display = isLight ? 'none' : 'inline-block';
        });
        document.querySelectorAll('.theme-icon-moon').forEach(function(el) {
            el.style.display = isLight ? 'inline-block' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', updateThemeIcons);
</script>
