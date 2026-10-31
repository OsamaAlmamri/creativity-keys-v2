@php
    $siteName = $settings['site_name'] ?? 'مفاتيح الأمان الذهبية';
    $siteTagline = $settings['site_tagline'] ?? 'قص وبرمجة المفاتيح الذكية وفتح الأقفال على مدار 24 ساعة';
    $cityName = $settings['city_name'] ?? 'الرياض';
    $defaultDesc = $settings['meta_description'] ?? ("أفضل خدمات قص وبرمجة مفاتيح وبصمات السيارات وفتح الأقفال المغلقة للطوارئ بدون كسر على مدار 24 ساعة في {$cityName}.");

    $title = View::hasSection('title') ? View::getSection('title') : "{$siteName} | {$siteTagline} في {$cityName}";
    $description = View::hasSection('meta_description') ? View::getSection('meta_description') : $defaultDesc;
    $canonicalUrl = View::hasSection('canonical') ? View::getSection('canonical') : url()->current();
    $ogType = View::hasSection('og_type') ? View::getSection('og_type') : 'website';
    $ogImage = View::hasSection('og_image') ? View::getSection('og_image') : 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80';
    $keywords = View::hasSection('keywords') ? View::getSection('keywords') : "قص مفاتيح {$cityName}, برمجة مفاتيح سيارات {$cityName}, فتح ابواب منازل طوارئ, فتح سيارات مقفلة, صب مفاتيح, اقفال ذكية {$cityName}, مفاتيح سيارات مشفرة, ريموت بصمة, نجار فتح اقفال 24 ساعة";

    $phone = $settings['emergency_phone'] ?? ($settings['phone'] ?? '0559998877');
    $address = $settings['address'] ?? "طريق الملك فهد - حي العليا، بجوار برج الفيصلية، {$cityName}";
    $lat = $settings['map_latitude'] ?? '24.713552';
    $lng = $settings['map_longitude'] ?? '46.675296';
@endphp

<!-- Basic Meta & Title -->
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23f59e0b'><path d='M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'/></svg>">

<!-- Local & Geo SEO for Saudi Arabia / City -->
<meta name="geo.region" content="SA-01">
<meta name="geo.placename" content="{{ $cityName }}، المملكة العربية السعودية">
<meta name="geo.position" content="{{ $lat }};{{ $lng }}">
<meta name="ICBM" content="{{ $lat }}, {{ $lng }}">

<!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="ar_SA">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:alt" content="{{ $title }}">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">

<!-- Schema.org: LocalBusiness & Locksmith Rich Snippet (JSON-LD) -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Locksmith",
    "@@id": "{{ route('home') }}#localbusiness",
    "name": "{{ $siteName }}",
    "alternateName": "محل وورشة مفاتيح الأمان لقص وبرمجة المفاتيح وفتح الأقفال",
    "description": "{{ $defaultDesc }}",
    "url": "{{ route('home') }}",
    "telephone": "{{ $phone }}",
    "priceRange": "$$",
    "image": "{{ $ogImage }}",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $address }}",
        "addressLocality": "{{ $cityName }}",
        "addressRegion": "{{ $cityName }}",
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
        "name": "{{ $cityName }}"
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
