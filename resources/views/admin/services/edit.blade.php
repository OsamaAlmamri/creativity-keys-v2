@extends('admin.layouts.app')

@section('page_title', 'تعديل الخدمة: ' . $service->title)

@section('content')

    <div class="max-w-5xl mx-auto space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">تعديل الخدمة ومحتواها التفاعلي</h2>
                <p class="text-xs text-slate-400">تحديث تفاصيل خدمة: <span class="text-amber-400 font-bold">{{ $service->title }}</span> وإعدادات محركات البحث</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-750 text-amber-400 font-bold text-xs flex items-center gap-1.5 transition-colors border border-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>معاينة الصفحة العامة</span>
                </a>
                <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                    ← العودة للخدمات
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs">
                <span class="font-bold block mb-1">يرجى تصحيح الأخطاء التالية:</span>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @include('admin.services._form')
            </form>
        </div>

    </div>

@endsection
