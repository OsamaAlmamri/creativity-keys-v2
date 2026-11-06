@props([
    'review',
])

<article {{ $attributes->merge(['class' => 'glass-panel flex flex-col justify-between rounded-[2rem] p-6 min-w-0 transition-all duration-300 hover-brand-card']) }}>
    <div>
        <!-- Top Row: Avatar Initial, Client Name, Date, Google Icon -->
        <div class="flex items-center gap-4">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-500/10 border border-amber-500/20 text-lg font-bold text-amber-400">
                {{ mb_substr($review->client_name, 0, 1) }}
            </span>
            <div class="min-w-0">
                <h3 class="truncate text-base font-semibold text-slate-900 dark:text-white leading-snug">
                    {{ $review->client_name }}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ $review->client_title ?? 'قبل شهر' }}
                </p>
            </div>
            <!-- Google G Icon on Opposite Side -->
            <div class="ms-auto shrink-0 text-amber-400">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/>
                </svg>
            </div>
        </div>

        <!-- Middle Row: Stars with Dynamic Brand Color -->
        <div class="mt-4 flex gap-0.5 text-amber-400" aria-label="{{ $review->rating ?? 5 }} من 5">
            @for($i = 0; $i < ($review->rating ?? 5); $i++)
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @endfor
        </div>

        <!-- Bottom: Customer Review Text -->
        <p class="mt-4 flex-1 text-sm leading-7 text-slate-600 dark:text-slate-300">
            {{ $review->comment }}
        </p>
    </div>
</article>
