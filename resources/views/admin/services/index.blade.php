@extends('admin.layouts.app')

@section('page_title', 'إدارة خدمات المحل')

@section('content')

    <div class="space-y-6">

        <!-- Header with Add Service Button -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">الخدمات المعروضة في الموقع</h2>
                <p class="text-xs text-slate-400">يمكنك إضافة أو تعديل أو حذف أي خدمة تظهر لزوار الموقع</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.service-categories.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors border border-slate-700">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <span>أصناف الخدمات</span>
                </a>
                <a href="{{ route('admin.services.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-bold text-xs transition-colors shadow-lg shadow-amber-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>إضافة خدمة جديدة</span>
                </a>
            </div>
        </div>

        <!-- Services Grid / Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 flex flex-col justify-between shadow-lg">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($service->is_emergency)
                                    <x-badge variant="red" size="xs">طوارئ</x-badge>
                                @endif
                                <x-badge :variant="$service->is_active ? 'emerald' : 'slate'" size="xs">
                                    {{ $service->is_active ? 'نشطة' : 'معطلة' }}
                                </x-badge>
                            </div>
                        </div>

                        <div>
                            @if($service->category)
                                <span
                                    class="inline-block px-2.5 py-0.5 rounded-full bg-slate-800 text-amber-400 text-[10px] font-bold mb-1.5 border border-slate-750">
                                    {{ $service->category->name }}
                                </span>
                            @endif
                            <h3 class="text-base font-bold text-white mb-1">{{ $service->title }}</h3>
                            <p class="text-xs text-slate-400 leading-relaxed">{{ $service->short_description }}</p>
                        </div>

                        <div class="text-xs text-amber-400 font-bold">
                            {{ $service->price_starting_at ?? 'السعر عند الطلب' }}
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-800 flex items-center justify-between">
                        <div class="text-xs text-slate-500">
                            ترتيب الظهور: {{ $service->sort_order }}
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('services.show', $service->slug) }}" target="_blank"
                                class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-amber-400 hover:text-amber-300 transition-colors"
                                title="معاينة الصفحة العامة">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.services.edit', $service) }}"
                                class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors"
                                title="تعديل">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                data-confirm-title="تأكيد حذف الخدمة الفنية" data-item-name="{{ $service->title }}"
                                data-confirm-message="هل أنت متأكد من رغبتك في حذف هذه الخدمة؟ سيتم إزالتها نهائياً من الموقع.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete p-2 rounded-lg transition-all" title="حذف الخدمة">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500">
                    لا توجد خدمات مضافة حتى الآن.
                </div>
            @endforelse
        </div>

        <div class="pt-4">
            {{ $services->links() }}
        </div>

    </div>

@endsection