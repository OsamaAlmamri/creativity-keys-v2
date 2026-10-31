@extends('admin.layouts.app')

@section('page_title', 'لوحة التحكم الرئيسية')

@section('content')

    <div class="space-y-8">
        
        <!-- Emergency alert banner if urgent unread requests -->
        @if($stats['emergency_messages'] > 0)
            <div class="p-5 rounded-3xl bg-gradient-to-r from-red-600 to-amber-600 text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-xl shadow-red-500/20">
                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-full bg-white animate-ping shrink-0"></span>
                    <div>
                        <div class="font-black text-lg">تنبيه طلبات طوارئ عاجلة!</div>
                        <div class="text-xs text-white/90">لديك {{ $stats['emergency_messages'] }} طلب طوارئ جديد بانتظار التواصل الفوري مع العميل.</div>
                    </div>
                </div>
                <a href="{{ route('admin.messages.index', ['filter' => 'emergency']) }}" class="px-5 py-2.5 rounded-xl bg-slate-950 text-white font-bold text-xs hover:bg-slate-900 transition-colors shrink-0">
                    عرض طلبات الطوارئ الآن
                </a>
            </div>
        @endif

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Messages / Inquiries -->
            <div class="rounded-3xl bg-slate-900 border border-slate-800 p-6 flex items-center justify-between shadow-lg">
                <div>
                    <div class="text-xs font-bold text-slate-400 mb-1">الرسائل والطلبات</div>
                    <div class="text-3xl font-black text-white font-mono">{{ $stats['messages_count'] }}</div>
                    <div class="text-xs text-amber-400 font-semibold mt-1">
                        {{ $stats['unread_messages'] }} رسالة جديدة غير مقروءة
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-black">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>

            <!-- Services Count -->
            <div class="rounded-3xl bg-slate-900 border border-slate-800 p-6 flex items-center justify-between shadow-lg">
                <div>
                    <div class="text-xs font-bold text-slate-400 mb-1">الخدمات النشطة</div>
                    <div class="text-3xl font-black text-white font-mono">{{ $stats['services_count'] }}</div>
                    <div class="text-xs text-emerald-400 font-semibold mt-1">معروضة في الصفحة الرئيسية</div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-black">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>

            <!-- Gallery Items -->
            <div class="rounded-3xl bg-slate-900 border border-slate-800 p-6 flex items-center justify-between shadow-lg">
                <div>
                    <div class="text-xs font-bold text-slate-400 mb-1">معرض الصور</div>
                    <div class="text-3xl font-black text-white font-mono">{{ $stats['gallery_count'] }}</div>
                    <div class="text-xs text-blue-400 font-semibold mt-1">صورة وأعمال منجزة</div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center font-black">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>

            <!-- Reviews -->
            <div class="rounded-3xl bg-slate-900 border border-slate-800 p-6 flex items-center justify-between shadow-lg">
                <div>
                    <div class="text-xs font-bold text-slate-400 mb-1">التقييمات</div>
                    <div class="text-3xl font-black text-white font-mono">{{ $stats['reviews_count'] }}</div>
                    <div class="text-xs text-amber-400 font-semibold mt-1">
                        {{ $stats['pending_reviews'] }} تقييم بحاجة لاعتماد
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-black">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
            </div>
        </div>

        <!-- Quick Actions Row -->
        <div class="p-6 rounded-3xl bg-slate-900 border border-slate-800 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-white">إجراءات سريعة</h3>
                <p class="text-xs text-slate-400">إدارة محتوى الموقع بلمسة واحدة</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    إضافة خدمة جديدة
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs transition-colors border border-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    رفع صور للمعرض
                </a>
                <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs transition-colors border border-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    تعديل أرقام وعنوان المحل
                </a>
            </div>
        </div>

        <!-- Latest Messages Table -->
        <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl">
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white">أحدث طلبات واستفسارات الزوار</h3>
                    <p class="text-xs text-slate-400">آخر الرسائل المستلمة عبر نموذج الاتصال</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-amber-400 hover:underline">
                    عرض جميع الرسائل ({{ $stats['messages_count'] }}) ←
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead class="bg-slate-950/60 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4">العميل</th>
                            <th class="px-6 py-4">رقم الجوال</th>
                            <th class="px-6 py-4">الخدمة المطلوبة</th>
                            <th class="px-6 py-4">الحي / المنطقة</th>
                            <th class="px-6 py-4">التاريخ</th>
                            <th class="px-6 py-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($latestMessages as $msg)
                            <tr class="hover:bg-slate-800/40 transition-colors {{ !$msg->is_read ? 'bg-amber-500/5' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($msg->is_emergency)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 font-black">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                                            طوارئ
                                        </span>
                                    @elseif(!$msg->is_read)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 font-bold">
                                            جديدة
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-slate-800 text-slate-400 font-medium">
                                            مقروءة
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                    {{ $msg->name }}
                                </td>
                                <td class="px-6 py-4 font-mono text-slate-300 whitespace-nowrap" dir="ltr">
                                    {{ $msg->phone }}
                                </td>
                                <td class="px-6 py-4 text-slate-300">
                                    {{ $msg->service_needed ?? 'طلب عام' }}
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    {{ $msg->city_district ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-slate-400 font-mono whitespace-nowrap">
                                    {{ $msg->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2 space-x-reverse">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-white font-bold transition-colors">
                                        عرض
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '966', preg_replace('/\D/', '', $msg->phone)) }}?text={{ urlencode('السلام عليكم ' . $msg->name . '، بخصوص طلبك من مفاتيح الأمان') }}" target="_blank" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold transition-colors">
                                        واتساب
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                    لا توجد رسائل واردة حالياً.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
