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

    /* 1. Global Section Backgrounds Alternation in Light Mode */
    html.theme-light #hero,
    html.theme-light .hero-section,
    html.theme-light .bg-gradient-to-b.from-slate-950.via-slate-900.to-slate-950 {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 40%, #f1f5f9 100%) !important;
    }

    html.theme-light #about {
        background-color: #ffffff !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light #services {
        background-color: #f8fafc !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light #gallery {
        background-color: #ffffff !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light #reviews {
        background-color: #f8fafc !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light #articles {
        background-color: #ffffff !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light #location {
        background-color: #f8fafc !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light #contact {
        background-color: #ffffff !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light footer {
        background-color: #f1f5f9 !important;
        border-top-color: #e2e8f0 !important;
    }

    /* 2. Global Slate Background Fallbacks in Light Mode */
    html.theme-light .bg-slate-950 {
        background-color: #f8fafc !important;
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
    html.theme-light .bg-slate-800\/90,
    html.theme-light .bg-slate-800\/80,
    html.theme-light .bg-slate-800\/60,
    html.theme-light .bg-slate-800\/50,
    html.theme-light .bg-slate-750,
    html.theme-light .bg-slate-850 {
        background-color: #f1f5f9 !important;
    }

    html.theme-light .border-slate-800,
    html.theme-light .border-slate-800\/80,
    html.theme-light .border-slate-800\/60,
    html.theme-light .border-slate-700,
    html.theme-light .border-slate-700\/60,
    html.theme-light .border-slate-750,
    html.theme-light .border-slate-850 {
        border-color: #e2e8f0 !important;
    }

    html.theme-light .divide-slate-800 > :not([hidden]) ~ :not([hidden]) {
        border-color: #f1f5f9 !important;
    }

    /* 3. Hero Headline Gradient & Badges in Light Mode */
    html.theme-light .text-brand-gradient {
        background: linear-gradient(135deg, var(--brand-700) 0%, var(--brand-600) 50%, var(--brand-500) 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }

    /* Hero Quick Emergency Card & Highlight Items */
    html.theme-light #hero .bg-slate-900 {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08) !important;
    }

    html.theme-light #hero .bg-slate-800\/50 {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
    }

    html.theme-light #hero .border-y.border-slate-800\/80,
    html.theme-light #hero .border-x.border-slate-800 {
        border-color: #e2e8f0 !important;
    }

    /* 4. Text Color Typography in Light Mode */
    html.theme-light h1,
    html.theme-light h2,
    html.theme-light h3:not(.gallery-card h3),
    html.theme-light h4:not(.gallery-card h4),
    html.theme-light h5,
    html.theme-light h6 {
        color: #0f172a !important;
    }

    html.theme-light p:not(.gallery-card p) {
        color: #334155 !important;
    }

    html.theme-light .text-slate-100 {
        color: #0f172a !important;
    }

    html.theme-light .text-slate-200 {
        color: #1e293b !important;
    }

    html.theme-light .text-slate-300:not(.gallery-card *) {
        color: #475569 !important;
    }

    html.theme-light .text-slate-400:not(.gallery-card *) {
        color: #64748b !important;
    }

    html.theme-light .text-slate-500:not(.gallery-card *) {
        color: #64748b !important;
    }

    /* Replace pale text colors with rich, readable contrast on white */
    html.theme-light .text-amber-400:not(.gallery-card *):not(.bg-gradient-to-r *),
    html.theme-light .text-amber-300:not(.gallery-card *):not(.bg-gradient-to-r *) {
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

    /* 5. Button & Action Link Contrasts in Light Mode */
    /* Secondary Action Buttons (was dark slate with white text) */
    html.theme-light a[class*="bg-slate-800"],
    html.theme-light button[class*="bg-slate-800"],
    html.theme-light a[class*="bg-slate-700"],
    html.theme-light button[class*="bg-slate-700"] {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
    }

    html.theme-light a[class*="bg-slate-800"]:hover,
    html.theme-light button[class*="bg-slate-800"]:hover,
    html.theme-light a[class*="bg-slate-700"]:hover,
    html.theme-light button[class*="bg-slate-700"]:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    /* Primary and Colored Buttons (retain white or dark text appropriately) */
    html.theme-light .bg-emerald-600,
    html.theme-light .bg-emerald-600 *,
    html.theme-light .bg-emerald-500,
    html.theme-light .bg-emerald-500 *,
    html.theme-light .bg-red-600,
    html.theme-light .bg-red-600 *,
    html.theme-light .bg-red-500,
    html.theme-light .bg-red-500 *,
    html.theme-light .bg-brand-primary,
    html.theme-light .bg-brand-primary *,
    html.theme-light .badge-white-text,
    html.theme-light span.bg-red-500.text-white {
        color: #ffffff !important;
    }

    html.theme-light a[class*="from-amber"],
    html.theme-light button[class*="from-amber"],
    html.theme-light a[class*="from-amber"] *,
    html.theme-light button[class*="from-amber"] * {
        color: #020617 !important;
    }

    /* Standalone .text-white elements that are NOT colored buttons/badges */
    html.theme-light div > .text-white:not(button):not(a):not(span[class*="bg-red"]):not(span[class*="bg-emerald"]):not(.gallery-card *):not(.badge-white-text),
    html.theme-light tr > td.text-white,
    html.theme-light label.text-white {
        color: #0f172a !important;
    }

    /* 6. Navigation Bar & Header in Light Mode */
    html.theme-light header {
        background-color: rgba(255, 255, 255, 0.95) !important;
        border-bottom-color: #e2e8f0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
    }

    html.theme-light header a > span.text-white {
        color: #0f172a !important;
    }

    html.theme-light header nav {
        background-color: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
    }

    html.theme-light header nav a {
        color: #475569 !important;
        font-weight: 600 !important;
    }

    html.theme-light header nav a:hover {
        color: #0f172a !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
    }

    /* Mobile Dropdown Menu in Light Mode */
    html.theme-light #mobile-menu {
        background-color: #ffffff !important;
        border-top-color: #e2e8f0 !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08) !important;
    }

    html.theme-light #mobile-menu a:not([class*="bg-emerald"]):not([class*="bg-amber"]) {
        color: #334155 !important;
    }

    html.theme-light #mobile-menu a:not([class*="bg-emerald"]):not([class*="bg-amber"]):hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
    }

    /* 7. Cards & Containers Hierarchy in Light Mode */
    /* Cards inside Services, Reviews, Location, Contact */
    html.theme-light #services .bg-slate-900,
    html.theme-light #reviews .bg-slate-900,
    html.theme-light #location .bg-slate-950,
    html.theme-light #contact .bg-slate-900,
    html.theme-light #articles article.bg-slate-950 {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.04) !important;
    }

    html.theme-light #services .hover-brand-card:hover,
    html.theme-light #reviews .hover-brand-card:hover,
    html.theme-light #articles .hover-brand-card:hover {
        transform: translateY(-4px) !important;
        border-color: var(--brand-400) !important;
        box-shadow: 0 20px 25px -5px rgba(var(--brand-rgb), 0.15), 0 8px 10px -6px rgba(var(--brand-rgb), 0.08) !important;
    }

    /* About Section Elements */
    html.theme-light #about .absolute.bottom-6 {
        background-color: rgba(255, 255, 255, 0.95) !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1) !important;
    }

    html.theme-light #about .grid-cols-2 .bg-slate-950 {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
    }

    /* Service Category Badge */
    html.theme-light #services .bg-slate-800.text-amber-400,
    html.theme-light .bg-slate-800.text-amber-400 {
        background-color: #fffbeb !important;
        color: #92400e !important;
        border-color: #fde68a !important;
    }

    /* Service Card Order Button */
    html.theme-light #services a[class*="bg-slate-800"] {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
    }

    html.theme-light #services a[class*="bg-slate-800"]:hover {
        background-color: var(--brand-500) !important;
        color: #ffffff !important;
        border-color: var(--brand-500) !important;
    }

    /* Gallery Section in Light Mode */
    html.theme-light .filter-btn:not(.active):not(.bg-amber-500) {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #e2e8f0 !important;
    }

    html.theme-light .filter-btn:not(.active):not(.bg-amber-500):hover {
        background-color: #e2e8f0 !important;
        color: #0f172a !important;
    }

    html.theme-light .filter-btn.active,
    html.theme-light .filter-btn.bg-amber-500 {
        background-color: var(--brand-500) !important;
        color: #ffffff !important;
    }

    html.theme-light .gallery-card {
        border-color: #e2e8f0 !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.06) !important;
    }

    /* Gallery text over dark image gradient overlay MUST stay light */
    html.theme-light .gallery-card h3 {
        color: #ffffff !important;
    }

    html.theme-light .gallery-card p {
        color: #e2e8f0 !important;
    }

    html.theme-light .gallery-card .bg-slate-900\/90 {
        background-color: rgba(15, 23, 42, 0.8) !important;
        color: #fde68a !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
    }

    /* Map iframe in Light Mode */
    html.theme-light iframe {
        filter: none !important;
    }

    /* Badges & Alert Pills in Light Mode */
    html.theme-light .bg-amber-500\/10 {
        background-color: #fffbeb !important;
        border-color: #fde68a !important;
        color: #92400e !important;
    }

    html.theme-light .bg-emerald-500\/10 {
        background-color: #ecfdf5 !important;
        border-color: #a7f3d0 !important;
        color: #047857 !important;
    }

    html.theme-light .bg-blue-500\/10 {
        background-color: #eff6ff !important;
        border-color: #bfdbfe !important;
        color: #1d4ed8 !important;
    }

    html.theme-light .bg-red-500\/10 {
        background-color: #fef2f2 !important;
        border-color: #fecaca !important;
        color: #b91c1c !important;
    }

    /* 8. Form Inputs & Selects in Light Mode */
    html.theme-light input:not([type="checkbox"]):not([type="radio"]):not([type="color"]),
    html.theme-light textarea,
    html.theme-light select {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
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
        box-shadow: 0 0 0 3px rgba(var(--brand-rgb), 0.18) !important;
    }

    html.theme-light input[type="checkbox"],
    html.theme-light input[type="radio"] {
        border-color: #cbd5e1 !important;
        background-color: #ffffff !important;
    }

    /* Emergency Checkbox Box */
    html.theme-light #contact .bg-amber-500\/10 {
        background-color: #fffbeb !important;
        border-color: #fde68a !important;
    }

    html.theme-light #contact label[for="is_emergency"] {
        color: #92400e !important;
    }

    /* 9. Articles Page & Typography in Light Mode */
    html.theme-light .prose {
        color: #334155 !important;
    }

    html.theme-light .prose h1,
    html.theme-light .prose h2,
    html.theme-light .prose h3,
    html.theme-light .prose h4,
    html.theme-light .prose strong {
        color: #0f172a !important;
    }

    html.theme-light .prose a {
        color: var(--brand-700, #b45309) !important;
    }

    html.theme-light .prose blockquote {
        color: #475569 !important;
        border-right-color: var(--brand-500) !important;
    }

    /* 10. Footer in Light Mode */
    html.theme-light footer {
        background-color: #f1f5f9 !important;
        border-top-color: #e2e8f0 !important;
    }

    html.theme-light footer h3 {
        color: #0f172a !important;
    }

    html.theme-light footer p,
    html.theme-light footer a:not([class*="bg-"]) {
        color: #475569 !important;
    }

    html.theme-light footer a:not([class*="bg-"]):hover {
        color: var(--brand-700, #b45309) !important;
    }

    html.theme-light footer .bg-slate-900 {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
        color: #334155 !important;
    }

    /* 11. ADMIN PANEL COMPLETE LIGHT MODE STYLING */
    /* Admin Sidebar */
    html.theme-light aside {
        background-color: #ffffff !important;
        border-left-color: #e2e8f0 !important;
        box-shadow: 1px 0 3px 0 rgba(0, 0, 0, 0.03) !important;
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

    /* Admin Stat Cards & Action Bars */
    html.theme-light .rounded-3xl.bg-slate-900.border.border-slate-800,
    html.theme-light .bg-slate-900.border.border-slate-800 {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
    }

    html.theme-light .font-mono.text-white {
        color: #0f172a !important;
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
        background-color: rgba(15, 23, 42, 0.5) !important;
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
