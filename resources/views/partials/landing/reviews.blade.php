<section id="reviews" class="py-24 bg-slate-950 px-5 sm:px-8 border-t border-slate-800 relative overflow-hidden">
    <div class="mx-auto max-w-7xl">
        
        <!-- Section Header Matching Reference Screenshot -->
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="section-kicker">آراء عملائنا</p>
                <h2 class="mt-4 max-w-2xl text-4xl font-semibold leading-tight tracking-[-0.03em] sm:text-5xl text-slate-900 dark:text-white">
                    {{ $settings['reviews_title'] ?? 'ثقة عملائنا هي وسام نعتز به.' }}
                </h2>
            </div>
            <p class="max-w-md text-base leading-7 text-slate-600 dark:text-slate-400">
                {{ $settings['reviews_description'] ?? 'سعداء بتقييمات عملائنا الكرام على Google، والتي تعكس جودة خدمتنا والتزامنا بالدقة والأمان في كل زيارة.' }}
            </p>
        </div>

        <!-- Split Grid: Google Highlight Card (Right in RTL) & 6 Review Cards (Left in RTL) -->
        <div class="mt-12 grid gap-6 lg:grid-cols-12 items-stretch w-full">
            
            <!-- Google Rating Highlight Card (Right in RTL, 4 of 12 cols) -->
            <div class="lg:col-span-4 w-full glass-panel flex flex-col items-center justify-center rounded-[2.2rem] p-8 text-center min-w-0">
                <!-- Google Icon with Dynamic Brand Accent -->
                <div class="w-14 h-14 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 flex items-center justify-center text-3xl font-bold">
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                        <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/>
                    </svg>
                </div>

                <p class="mt-5 text-6xl font-semibold leading-none text-slate-900 dark:text-white">
                    {{ $settings['google_review_rating'] ?? '4.9' }}
                </p>

                <div role="img" class="mt-3 flex gap-1 text-amber-400" aria-label="التقييم العام {{ $settings['google_review_rating'] ?? '4.9' }} من 5">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 fill-current" aria-hidden="true" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>

                <p class="mt-4 text-sm leading-7 text-slate-600 dark:text-slate-400">
                    {{ $settings['google_reviews_subtitle'] ?? 'بناءً على تقييمات عملائنا على Google' }}
                </p>

                <a 
                    href="{{ $settings['google_reviews_url'] ?? 'https://maps.app.goo.gl/5Z8Yifuj6SPKphLK8' }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="mt-6 inline-flex min-h-11 items-center justify-center gap-2 rounded-full bg-brand-primary hover:brightness-105 px-6 py-3 text-sm font-bold text-slate-950 shadow-brand transition-all duration-300"
                >
                    <svg class="w-4 h-4 fill-current text-slate-950" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span>شاهد التقييمات على Google</span>
                </a>
            </div>

            <!-- Customer Review Cards Grid (Left in RTL, 8 of 12 cols, 2 columns inside) -->
            <div class="lg:col-span-8 w-full grid grid-cols-1 sm:grid-cols-2 gap-6 min-w-0">
                @forelse($reviews as $review)
                    <x-review-card :review="$review" class="w-full min-w-0" />
                @empty
                    <div class="col-span-2 text-center py-8 text-slate-500">
                        لا توجد تقييمات منشورة حالياً.
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</section>
