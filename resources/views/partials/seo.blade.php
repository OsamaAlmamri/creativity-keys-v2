@php
    $siteName = $settings['site_name'] ?? 'مفتاح الإبداع';
    $siteTagline = $settings['site_tagline'] ?? 'قص وبرمجة المفاتيح الذكية';
    $cityName = $settings['city_name'] ?? 'جدة';
    $defaultDesc = $settings['meta_description'] ?? ("أفضل خدمات قص وبرمجة مفاتيح وبصمات السيارات وفتح الأقفال المغلقة للطوارئ بدون كسر على مدار 24 ساعة في {$cityName}.");

    $title = View::hasSection('title') ? View::getSection('title') : "{$siteName} | {$siteTagline} في {$cityName}";
    $description = View::hasSection('meta_description') ? View::getSection('meta_description') : $defaultDesc;
    $canonicalUrl = View::hasSection('canonical') ? View::getSection('canonical') : url()->current();
    $ogType = View::hasSection('og_type') ? View::getSection('og_type') : 'website';

    // OG Image
    $defaultOgImage = !empty($settings['og_image']) ? $settings['og_image'] : 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80';
    $ogImage = View::hasSection('og_image') ? View::getSection('og_image') : $defaultOgImage;

    // Keywords
    $defaultKeywords = !empty($settings['meta_keywords'])
        ? $settings['meta_keywords']
        : "قص مفاتيح {$cityName}, برمجة مفاتيح سيارات {$cityName}, فتح ابواب منازل طوارئ, فتح سيارات مقفلة, صب مفاتيح, اقفال ذكية {$cityName}, مفاتيح سيارات مشفرة, ريموت بصمة, نجار فتح اقفال 24 ساعة";
    $keywords = View::hasSection('keywords') ? View::getSection('keywords') : $defaultKeywords;

    // Robots Directive
    $configuredRobots = $settings['seo_robots'] ?? 'index, follow';
    $robotsDirective = $configuredRobots;
    if (str_starts_with(trim($configuredRobots), 'index') && !str_contains($configuredRobots, 'max-image-preview')) {
        $robotsDirective .= ', max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }

    $phone = $settings['emergency_phone'] ?? ($settings['phone'] ?? '0559998877');
    $address = $settings['address'] ?? "طريق الملك عبد العزيز - حي الشاطئ، {$cityName}";
    $lat = $settings['map_latitude'] ?? '21.543333';
    $lng = $settings['map_longitude'] ?? '39.172778';
    $geoRegion = $cityName === 'جدة' ? 'SA-02' : 'SA-01';

    // Favicon & Logo & Alternate name
    $faviconUrl = !empty($settings['site_favicon']) ? $settings['site_favicon'] : null;
    $siteLogo = !empty($settings['site_logo']) ? $settings['site_logo'] : null;
    $alternateName = !empty($settings['seo_alternate_name']) ? $settings['seo_alternate_name'] : "محل  {$siteName} لقص وبرمجة المفاتيح وفتح الأقفال";

    // Social accounts for schema sameAs
    $socials = array_values(array_filter([
        $settings['social_twitter'] ?? null,
        $settings['social_instagram'] ?? null,
        $settings['social_tiktok'] ?? null,
        $settings['social_telegram'] ?? null,
        $settings['social_snapchat'] ?? null,
        $settings['social_facebook'] ?? null,
        $settings['social_youtube'] ?? null,
        $settings['social_linkedin'] ?? null,
    ]));
@endphp

<!-- Basic Meta & Title -->
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
@if(!empty($keywords))
    <meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="{{ $robotsDirective }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

@if(!empty($settings['google_site_verification']))
    <meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">
@endif

<!-- Favicon & Touch Icons -->
@if(!empty($faviconUrl))
    <link rel="icon" href="{{ $faviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">
@else
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
@endif
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

<!-- Local & Geo SEO for Saudi Arabia / City -->
<meta name="geo.region" content="{{ $geoRegion }}">
<meta name="geo.placename" content="{{ $cityName }}، المملكة العربية السعودية">
<meta name="geo.position" content="{{ $lat }};{{ $lng }}">
<meta name="ICBM" content="{{ $lat }}, {{ $lng }}">

@php
    $ogImageUrl = Str::startsWith($ogImage, ['http://', 'https://']) ? $ogImage : url($ogImage);
@endphp

<!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="ar_SA">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImageUrl }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $title }}">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">

<!-- Google Analytics (GA4) -->
@if(!empty($settings['google_analytics_id']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ $settings['google_analytics_id'] }}');
    </script>
@endif

<!-- Schema.org: LocalBusiness & Locksmith Rich Snippet (JSON-LD) -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Locksmith",
    "@@id": "{{ route('home') }}#localbusiness",
    "name": "{{ $siteName }}",
    "alternateName": {!! json_encode($alternateName, JSON_UNESCAPED_UNICODE) !!},
    "description": {!! json_encode($defaultDesc, JSON_UNESCAPED_UNICODE) !!},
    "url": "{{ route('home') }}",
    "telephone": "{{ $phone }}",
    "priceRange": "$$",
    "image": "{{ $ogImage }}",
    @if(!empty($siteLogo))
        "logo": "{{ $siteLogo }}",
    @endif
    @if(!empty($socials))
        "sameAs": {!! json_encode($socials, JSON_UNESCAPED_SLASHES) !!},
    @endif
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": {!! json_encode($address, JSON_UNESCAPED_UNICODE) !!},
        "addressLocality": {!! json_encode($cityName, JSON_UNESCAPED_UNICODE) !!},
        "addressRegion": {!! json_encode($cityName, JSON_UNESCAPED_UNICODE) !!},
        "addressCountry": "SA"
    },
    "geo": {
        "@@type": "GeoCoordinates",
        "latitude": {{ (float) $lat }},
        "longitude": {{ (float) $lng }}
    },
    "openingHoursSpecification": [
        {
            "@@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
            ],
            "opens": "00:00",
            "closes": "23:59"
        }
    ],
    "areaServed": {
        "@@type": "City",
        "name": {!! json_encode($cityName, JSON_UNESCAPED_UNICODE) !!}
    },
    "currenciesAccepted": "SAR",
    "paymentAccepted": "Cash, Credit Card, Mada, Apple Pay"
    @if(isset($averageRating) && $averageRating > 0 && isset($reviewCount) && $reviewCount > 0)
        ,
        "aggregateRating": {
            "@@type": "AggregateRating",
            "ratingValue": "{{ number_format($averageRating, 1) }}",
            "reviewCount": "{{ $reviewCount }}",
            "bestRating": "5",
            "worstRating": "1"
        }
    @endif
}
</script>

@yield('schema')