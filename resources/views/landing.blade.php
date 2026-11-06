@extends('layouts.app')

@section('schema')
    @if(isset($services) && $services->isNotEmpty())
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "OfferCatalog",
            "name": "دليل خدمات قص وبرمجة المفاتيح وفتح الأقفال",
            "itemListElement": [
                @foreach($services as $index => $srv)
                    {
                        "@@type": "Offer",
                        "itemOffered": {
                            "@@type": "Service",
                            "name": {!! json_encode($srv->title, JSON_UNESCAPED_UNICODE) !!},
                            "description": {!! json_encode($srv->short_description, JSON_UNESCAPED_UNICODE) !!}
                        }
                    }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ]
        }
        </script>
    @endif
@endsection

@section('content')

    @php
        $cleanArrival = trim(str_replace('دقيقة', '', $settings['arrival_time'] ?? '15 - 25'));
        $cityName = $settings['city_name'] ?? 'جدة';
        $coverageAreas = $settings['coverage_areas'] ?? 'الروضة • السلامة • الزهراء • الشاطئ • الحمراء • المروة • الصفا • أبحر';
        $directionsUrl = $settings['directions_url'] ?? \App\Models\Setting::getDirectionsUrl();
        $mapEmbedUrl = $settings['map_embed_url'] ?? \App\Models\Setting::getMapEmbedUrl();
    @endphp

    <!-- 1. Hero Section -->
    @include('partials.landing.hero')

    <!-- 2. About Us Section -->
    @include('partials.landing.about')

    <!-- 3. Services Section -->
    @include('partials.landing.services')

    <!-- 4. Why Choose Us (Features) Section -->
    @include('partials.landing.features')

    <!-- 5. Geographic Coverage Areas Section (85+ Jeddah Districts) -->
    @include('partials.landing.coverage')

    <!-- 6. Work Gallery Section -->
    @include('partials.landing.gallery')

    <!-- 7. Client Reviews Section -->
    @include('partials.landing.reviews')

    <!-- 8. Latest Articles Section (Controlled by Theme Settings) -->
    @include('partials.landing.articles')

    <!-- 9. Geographic Location & Hours Section -->
    @include('partials.landing.location')

    <!-- 10. Direct Contact Form Section -->
    @include('partials.landing.contact')

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
                        b.classList.remove('bg-amber-500', 'text-white');
                        b.classList.add('bg-slate-800', 'text-slate-300');
                    });
                    this.classList.add('bg-amber-500', 'text-white');
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