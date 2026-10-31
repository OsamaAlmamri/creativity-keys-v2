@if((\App\Models\Setting::get('show_home_articles', '1') == '1') && isset($latestArticles) && $latestArticles->isNotEmpty())
<section id="articles" class="py-24 bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    المدونة والتوعية الأمنية
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white">
                    نصائح وإرشادات الأقفال والمفاتيح
                </h2>
                <p class="text-slate-400 text-base max-w-2xl">
                    تعرف على أحدث طرق الحماية الأمنية، كيفية التصرف عند فقدان مفاتيح السيارات، ومقارنات الأقفال الذكية.
                </p>
            </div>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors border border-slate-700 shrink-0">
                <span>عرض كافة المقالات (المدونة)</span>
                <svg class="w-4 h-4 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestArticles as $art)
                <x-article-card :article="$art" />
            @endforeach
        </div>
    </div>
</section>
@endif
