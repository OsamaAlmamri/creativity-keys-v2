@extends('admin.layouts.app')

@section('page_title', 'إضافة خدمة جديدة')

@section('content')

    <div class="max-w-5xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">إضافة خدمة فنية جديدة</h2>
                <p class="text-xs text-slate-400">ستظهر هذه الخدمة لزوار الموقع وتُنشأ لها صفحة تفاصيل مخصصة مع أرشفة SEO</p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                ← العودة لقائمة الخدمات
            </a>
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
            <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
                @csrf

                @include('admin.services._form')
            </form>
        </div>

    </div>

@endsection
