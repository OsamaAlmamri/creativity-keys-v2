@props([
    'review',
])

<div {{ $attributes->merge(['class' => 'rounded-3xl bg-slate-900 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all hover-brand-card']) }}>
    <div class="space-y-4">
        <!-- Star Rating -->
        <div class="flex items-center gap-1 text-amber-400">
            @for($i = 0; $i < $review->rating; $i++)
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @endfor
        </div>

        <!-- Comment Text -->
        <p class="text-sm text-slate-300 leading-relaxed italic">
            "{{ $review->comment }}"
        </p>
    </div>

    <!-- Client Info at Bottom -->
    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-sm flex items-center justify-center shrink-0">
            {{ mb_substr($review->client_name, 0, 1) }}
        </div>
        <div class="overflow-hidden">
            <h4 class="text-sm font-bold text-white truncate">{{ $review->client_name }}</h4>
            <div class="text-xs text-amber-400/80 truncate">
                {{ $review->service_rendered ?? $review->client_title }}
            </div>
        </div>
    </div>
</div>
