<section id="hero"
    class="relative isolate min-h-[90vh] flex items-center justify-center overflow-hidden px-5 pb-20 pt-32 sm:px-8 lg:pt-36 bg-slate-950">
    <!-- Ambient Orbs Matching Reference Design with Dynamic Theme Glow -->
    <div class="orb orb-sage"></div>
    <div class="orb orb-terracotta"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-14 lg:grid-cols-[1.05fr_0.95fr] w-full relative z-10">

        <!-- Hero Content (Right in RTL) -->
        <div class="max-w-3xl text-center lg:text-right">
            <!-- Section Kicker with Accent Dash Line -->
            <p class="section-kicker">
                <span>{{ $settings['site_tagline'] ?? 'خدمات مفاتيح السيارات والأبواب' }}</span>
            </p>

            <!-- Main Headline -->
            <h1
                class="mt-5 text-4xl sm:text-6xl lg:text-7xl font-semibold leading-tight tracking-[-0.04em] text-slate-900 dark:text-white">
                محل مفاتيح في {{ $cityName }} | <span
                    class="text-brand-primary">{{ $settings['site_name'] ?? 'مفتاح الإبداع' }}</span>
            </h1>

            <!-- Subtitle Pitch -->
            <p class="mt-7 max-w-xl text-base sm:text-lg leading-8 text-slate-600 dark:text-slate-300 mx-auto lg:mx-0">
                إذا كنت تبحث عن اقرب محل مفاتيح من موقعك، نحن نوفر لك خدمات قص وتفصيل المفاتيح، برمجة مفاتيح السيارات،
                وفتح الأبواب المغلقة بدون كسر. نصلك أينما كنت في {{ $cityName }} وأبحر بسرعة واحترافية عالية على مدار 24
                ساعة.
            </p>

            <!-- Single Clean Call to Action Button Matching Screenshot -->
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                <a href="#services"
                    class="inline-flex min-h-12 items-center justify-center rounded-full border border-slate-300/80 dark:border-slate-800 bg-white dark:bg-slate-900 px-8 text-base font-bold text-slate-800 dark:text-white shadow-sm backdrop-blur-xl transition-all duration-300 hover:border-brand-primary hover:text-brand-primary hover:shadow-brand">
                    اكتشف خدماتنا
                </a>
            </div>
        </div>

        <!-- Hero Visual (Left in RTL): Classic Pure Roman Arch Window Frame -->
        <div
            class="relative mx-auto flex w-full max-w-[560px] justify-center justify-self-center lg:ms-0 lg:justify-self-end">
            <div class="arch-frame arch-frame-large w-full max-w-[560px]">
                <picture>
                    <source srcset="{{ asset('images/store/800_6abfe0cbeabef.webp') }}" type="image/webp">
                    <img src="{{ asset('images/store/800_6abfe0cbeabef.jpg') }}"
                        alt="واجهة محل {{ $settings['site_name'] ?? 'مفتاح الإبداع' }} لنسخ وبرمجة مفاتيح السيارات في {{ $cityName }}"
                        class="h-full w-full object-fit" width="560" height="680" fetchpriority="high" decoding="async">
                </picture>
            </div>
        </div>

    </div>
</section>