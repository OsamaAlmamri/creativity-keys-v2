@props([
    'article',
    'showDate' => true,
    'showExcerpt' => true,
    'showViews' => true,
])

<article {{ $attributes->merge(['class' => 'bg-slate-950 dark:bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl hover:border-amber-500/40 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group hover-brand-card']) }}>
    <div>
        <!-- Cover Image & Badge -->
        <div class="relative h-48 sm:h-52 overflow-hidden bg-slate-900">
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
            @if(!empty($article->category))
                <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-slate-900/90 backdrop-blur-md text-amber-400 border border-slate-750 text-xs font-bold">
                    {{ $article->category }}
                </span>
            @endif
        </div>

        <!-- Content -->
        <div class="p-6 space-y-2.5">
            <div class="flex items-center gap-3 text-xs text-slate-400 font-mono">
                @if($showDate)
                    <span>{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</span>
                    <span>•</span>
                @endif
                <span>{{ $article->read_time }}</span>
            </div>

            <h3 class="text-base sm:text-lg font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2 leading-snug">
                <a href="{{ route('articles.show', $article->slug) }}">
                    {{ $article->title }}
                </a>
            </h3>

            @if($showExcerpt && !empty($article->excerpt))
                <p class="text-xs text-slate-400 leading-relaxed line-clamp-2">
                    {{ $article->excerpt }}
                </p>
            @endif
        </div>
    </div>

    <!-- Read More Footer -->
    <div class="p-6 pt-0 border-t border-slate-800/80 pt-4 flex items-center justify-between">
        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 group-hover:text-amber-300 transition-colors">
            <span>قراءة المقال</span>
            <svg class="w-3.5 h-3.5 -rotate-90 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </a>
        @if($showViews)
            <span class="text-[11px] text-slate-500 font-mono">{{ $article->views_count }} مشاهدة</span>
        @endif
    </div>
</article>
