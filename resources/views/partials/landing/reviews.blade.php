<section id="reviews" class="py-24 bg-slate-950 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    آراء عملائنا
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                    {{ $settings['reviews_title'] ?? 'ثقة عملائنا هي وسام نعتز به.' }}
                </h2>
            </div>
            <p class="text-slate-400 text-sm sm:text-base leading-relaxed max-w-md">
                {{ $settings['reviews_description'] ?? 'سعداء بتقييمات عملائنا الكرام على Google، والتي تعكس جودة خدمتنا والتزامنا بالدقة والأمان في كل زيارة.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start w-full">
            
            <!-- Google Rating Highlight Card (1 of 3 columns) -->
            <div class="lg:col-span-1 w-full rounded-3xl bg-slate-900 border border-slate-800 p-8 flex flex-col items-center justify-between text-center shadow-xl lg:sticky lg:top-28">
                <div class="space-y-5 w-full">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-950 border border-slate-800 text-xs font-bold text-slate-300">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>تقييمات Google الرسمية</span>
                    </div>

                    <div class="text-6xl font-black text-white tracking-tight">
                        {{ $settings['google_review_rating'] ?? '4.9' }}
                    </div>

                    <div class="flex items-center justify-center gap-1.5 text-amber-400" aria-label="التقييم العام 4.9 من 5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ $settings['google_reviews_subtitle'] ?? 'بناءً على تقييمات عملائنا على Google' }}
                    </p>
                </div>

                <a href="{{ $settings['google_reviews_url'] ?? 'https://maps.app.goo.gl/5Z8Yifuj6SPKphLK8' }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="mt-8 w-full inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-2xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs sm:text-sm transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span>شاهد التقييمات على Google</span>
                    <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>

            <!-- Reviews Grid (2 of 3 columns, showing 2 cards per row on sm+) -->
            <div class="lg:col-span-2 w-full grid grid-cols-1 sm:grid-cols-2 gap-6 min-w-0">
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

    </div>
</section>
