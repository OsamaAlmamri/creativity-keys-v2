@extends('admin.layouts.app')

@section('page_title', 'إدارة المقالات والمدونة')

@section('content')

    <div class="space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">المقالات والنصائح التوعوية</h2>
                <p class="text-xs text-slate-400">نشر وإدارة المقالات والمدونة التعليمية لتعزيز أمان العملاء وظهور الموقع في محركات البحث (SEO)</p>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs transition-colors shadow-lg shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>كتابة مقال جديد</span>
            </a>
        </div>

        <!-- Filter tabs -->
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.articles.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ !request()->filled('status') ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                جميع المقالات
            </a>
            <a href="{{ route('admin.articles.index', ['status' => 'published']) }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ request('status') === 'published' ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                المنشورة فقط
            </a>
            <a href="{{ route('admin.articles.index', ['status' => 'draft']) }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ request('status') === 'draft' ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                المسودات المخفية
            </a>
        </div>

        <!-- Articles Grid / Table -->
        <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead class="bg-slate-950/60 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">المقال</th>
                            <th class="px-6 py-4">التصنيف</th>
                            <th class="px-6 py-4 text-center">المشاهدات</th>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4">تاريخ النشر</th>
                            <th class="px-6 py-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($articles as $art)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-950 shrink-0 border border-slate-800">
                                            <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="max-w-sm">
                                            <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="font-bold text-white hover:text-amber-400 transition-colors line-clamp-1">
                                                {{ $art->title }}
                                            </a>
                                            <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">
                                                {{ $art->excerpt }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full bg-slate-800 text-amber-400 border border-slate-750 font-bold">
                                        {{ $art->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center font-mono text-slate-300">
                                    {{ number_format($art->views_count) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.articles.toggle', $art) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-xs font-bold transition-colors {{ $art->is_published ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20' : 'bg-slate-800 text-slate-400 hover:bg-slate-700' }}" title="اضغط لتبديل حالة النشر">
                                            {{ $art->is_published ? 'منشور' : 'مسودة' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-slate-400">
                                    {{ $art->published_at ? $art->published_at->format('Y-m-d') : 'لم ينشر' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2 space-x-reverse">
                                    <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors inline-block" title="معاينة في الموقع">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $art) }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors inline-block" title="تعديل">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $art) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition-colors" title="حذف">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                    لا توجد مقالات مضافة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-800">
                {{ $articles->links() }}
            </div>
        </div>

    </div>

@endsection
