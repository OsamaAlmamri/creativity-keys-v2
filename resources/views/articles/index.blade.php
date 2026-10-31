@extends('layouts.app')

@section('content')

    <!-- Breadcrumb & Header Hero -->
    <div class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 pt-16 pb-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">الرئيسية</a>
                <span>/</span>
                <span class="text-amber-400 font-bold">المقالات والنصائح</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    مدونة ومكتبة مفاتيح الأمان
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                    أحدث المقالات والإرشادات الأمنية للأقفال والمفاتيح
                </h1>
                <p class="text-slate-300 text-base leading-relaxed">
                    نشارككم خبرتنا الفنية الممتدة لأكثر من 15 عاماً في حماية المنازل، برمجة مفاتيح السيارات الحديثة، والتعامل الآمن مع مواقف الطوارئ.
                </p>
            </div>

            <!-- Search & Filter Controls -->
            <div class="pt-8">
                <form action="{{ route('articles.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3 max-w-2xl">
                    <div class="relative flex-1 w-full">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث في المقالات (مثال: بصمة، برمجة، قفل ذكي)..." class="w-full bg-slate-900 border border-slate-750 rounded-2xl px-5 py-3.5 pr-12 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 text-sm">
                        <svg class="w-5 h-5 text-slate-500 absolute right-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <button type="submit" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition-colors shrink-0">
                        بحث
                    </button>
                    @if(request()->hasAny(['q', 'category']))
                        <a href="{{ route('articles.index') }}" class="text-xs text-slate-400 hover:text-white underline shrink-0">إلغاء الفلترة</a>
                    @endif
                </form>

                <!-- Category Pills -->
                @if($categories->isNotEmpty())
                    <div class="flex flex-wrap items-center gap-2 pt-6">
                        <a href="{{ route('articles.index') }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all {{ !request('category') ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                            الكل
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('articles.index', ['category' => $cat]) }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all {{ request('category') === $cat ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Articles Grid Section -->
    <div class="py-16 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <article class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl hover:border-amber-500/40 hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 flex flex-col justify-between group hover-brand-card">
                        
                        <div>
                            <!-- Cover Image -->
                            <div class="relative h-56 overflow-hidden bg-slate-950">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-slate-900/90 backdrop-blur-md text-amber-400 border border-slate-750 text-xs font-bold">
                                    {{ $article->category }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center gap-3 text-xs text-slate-400 font-mono">
                                    <span>{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</span>
                                    <span>•</span>
                                    <span>{{ $article->read_time }}</span>
                                </div>

                                <h2 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h2>

                                <p class="text-xs text-slate-400 leading-relaxed line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                        </div>

                        <!-- Read More Link -->
                        <div class="p-6 pt-0 border-t border-slate-800/80 mt-4 flex items-center justify-between">
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 group-hover:text-amber-300 transition-colors">
                                <span>قراءة المقال بالكامل</span>
                                <svg class="w-4 h-4 -rotate-90 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </a>
                            <span class="text-[11px] text-slate-500 font-mono">{{ $article->views_count }} مشاهدة</span>
                        </div>

                    </article>
                @empty
                    <div class="col-span-3 text-center py-16 text-slate-500">
                        لا توجد مقالات منشورة مطابقة لبحثك في الوقت الحالي.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pt-12">
                {{ $articles->links() }}
            </div>

        </div>
    </div>

@endsection
