@extends('layouts.app')

@section('content')

    <article class="py-12 bg-slate-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-amber-400 transition-colors">المقالات والنصائح</a>
                <span>/</span>
                <span class="text-amber-400 font-bold truncate max-w-xs">{{ $article->title }}</span>
            </nav>

            <!-- Article Header -->
            <header class="space-y-4">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                        {{ $article->category }}
                    </span>
                    <span class="text-slate-500">•</span>
                    <span class="text-xs text-slate-400 font-mono">
                        نُشر في: {{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}
                    </span>
                    <span class="text-slate-500">•</span>
                    <span class="text-xs text-slate-400 font-mono">{{ $article->read_time }}</span>
                    <span class="text-slate-500">•</span>
                    <span class="text-xs text-slate-400 font-mono">{{ $article->views_count }} مشاهدة</span>
                </div>

                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                    {{ $article->title }}
                </h1>

                <!-- Excerpt Highlight Box -->
                <div class="p-5 rounded-2xl bg-slate-900 border-r-4 border-amber-400 text-slate-300 text-sm sm:text-base leading-relaxed italic">
                    {{ $article->excerpt }}
                </div>
            </header>

            <!-- Featured Cover Image -->
            <div class="rounded-3xl overflow-hidden border border-slate-800 shadow-2xl h-80 sm:h-96 w-full bg-slate-900">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>

            <!-- Article Body Content -->
            <div class="prose prose-invert max-w-none text-slate-300 text-base sm:text-lg leading-relaxed space-y-6 pt-4 font-normal">
                {!! nl2br(e($article->content)) !!}
            </div>

            <!-- Share & Tag Section -->
            <div class="pt-8 border-t border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-slate-400">مشاركة المقال:</span>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="p-2 rounded-xl bg-emerald-600/20 hover:bg-emerald-600 text-emerald-400 hover:text-white transition-colors" title="مشاركة عبر واتساب">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white transition-colors" title="مشاركة عبر تويتر / X">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>

                <a href="{{ route('articles.index') }}" class="text-xs font-bold text-amber-400 hover:underline">
                    ← العودة لجميع المقالات والنصائح
                </a>
            </div>

            <!-- Locksmith Author Box -->
            <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shrink-0 shadow-lg shadow-amber-500/20">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white mb-0.5">فريق فنيي مفاتيح الأمان الذهبية</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        نخبة من أمهر فنيي فتح الأقفال وبرمجة مفاتيح السيارات في الرياض بخبرة تتجاوز 15 عاماً. نهدف من خلال هذه المقالات إلى إثراء المحتوى التوعوي وحماية ممتلكاتكم.
                    </p>
                </div>
            </div>

            <!-- Emergency CTA Inside Article -->
            <div class="p-8 rounded-3xl bg-gradient-to-r from-amber-600 via-amber-500 to-yellow-500 text-slate-950 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-2xl">
                <div>
                    <h3 class="text-xl sm:text-2xl font-black mb-1">هل تواجه موقف طوارئ الآن؟</h3>
                    <p class="text-xs sm:text-sm font-bold text-slate-900">انقفل باب منزلك أو فقدت مفتاح سيارتك؟ نصلك خلال 15-25 دقيقة أينما كنت بالرياض.</p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" class="px-6 py-3.5 rounded-2xl bg-slate-950 text-white font-black text-sm hover:bg-slate-900 transition-colors shadow-lg">
                        اتصال طوارئ 24/7
                    </a>
                    <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('مرحباً، قرأت مقال: ' . $article->title . ' وأحتاج خدمة فنية') }}" target="_blank" class="px-5 py-3.5 rounded-2xl bg-emerald-700 text-white font-bold text-sm hover:bg-emerald-600 transition-colors shadow-lg">
                        واتساب
                    </a>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->isNotEmpty())
                <div class="pt-8 space-y-6">
                    <h3 class="text-xl font-black text-white">مقالات ذات صلة قد تهمك:</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $rel)
                            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden hover:border-amber-500/40 transition-all group flex flex-col justify-between hover-brand-card">
                                <div class="h-40 overflow-hidden bg-slate-950">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-4 space-y-2">
                                    <span class="text-[10px] px-2 py-0.5 rounded bg-slate-800 text-amber-400 font-bold">
                                        {{ $rel->category }}
                                    </span>
                                    <h4 class="text-xs font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2">
                                        <a href="{{ route('articles.show', $rel->slug) }}">
                                            {{ $rel->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="p-4 pt-0">
                                    <a href="{{ route('articles.show', $rel->slug) }}" class="text-[11px] font-bold text-amber-400 hover:underline">
                                        قراءة المقال ←
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </article>

@endsection
