@extends('admin.layouts.app')

@section('page_title', 'رسائل واستفسارات الزوار')

@section('content')

    <div class="space-y-6">
        
        <!-- Header & Filters -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">صندوق طلبات واستفسارات الزوار</h2>
                <p class="text-xs text-slate-400">الطلبات الواردة مباشرة من نموذج "اتصل بنا" في واجهة الموقع</p>
            </div>

            <!-- Filter tabs -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.messages.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ !request()->filled('filter') ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                    جميع الرسائل
                </a>
                <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ request('filter') === 'unread' ? 'bg-amber-500 text-slate-950' : 'bg-slate-800 text-slate-300 hover:bg-slate-750' }}">
                    غير المقروءة ({{ $unreadCount }})
                </a>
                <a href="{{ route('admin.messages.index', ['filter' => 'emergency']) }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ request('filter') === 'emergency' ? 'bg-red-500 text-white' : 'bg-slate-800 text-red-400 hover:bg-slate-750' }}">
                    طلبات الطوارئ فقط
                </a>
            </div>
        </div>

        <!-- Messages Table Card -->
        <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead class="bg-slate-950/60 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4">اسم العميل</th>
                            <th class="px-6 py-4">رقم الجوال</th>
                            <th class="px-6 py-4">الخدمة المطلوبة</th>
                            <th class="px-6 py-4">الحي / المنطقة</th>
                            <th class="px-6 py-4">تاريخ الإرسال</th>
                            <th class="px-6 py-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($messages as $msg)
                            <tr class="hover:bg-slate-800/40 transition-colors {{ !$msg->is_read ? 'bg-amber-500/5' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5">
                                        @if($msg->is_emergency)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 font-black">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                                                طوارئ
                                            </span>
                                        @endif
                                        @if(!$msg->is_read)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 font-bold">
                                                جديدة
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-800 text-slate-500 font-medium">
                                                تم الاطلاع
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-white">
                                    {{ $msg->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-slate-300" dir="ltr">
                                    {{ $msg->phone }}
                                </td>
                                <td class="px-6 py-4 text-slate-300">
                                    {{ $msg->service_needed ?? 'طلب عام' }}
                                </td>
                                <td class="px-6 py-4 text-slate-400 whitespace-nowrap">
                                    {{ $msg->city_district ?? '—' }}
                                </td>
                                <td class="px-6 py-4 font-mono text-slate-400 whitespace-nowrap">
                                    {{ $msg->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2 space-x-reverse">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-white font-bold transition-colors">
                                        عرض وتفاصيل
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '966', preg_replace('/\D/', '', $msg->phone)) }}?text={{ urlencode('مرحباً أخي ' . $msg->name . '، بخصوص طلبك من مركز مفاتيح الأمان') }}" target="_blank" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold transition-colors">
                                        واتساب
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline" data-confirm-title="تأكيد حذف الرسالة" data-item-name="{{ $msg->name }} ({{ $msg->phone }})" data-confirm-message="هل أنت متأكد من رغبتك في حذف طلب وتواصل العميل؟">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete p-1.5 rounded-lg transition-all" title="حذف الرسالة">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                    لا توجد رسائل مسجلة مطابقة للفلتر.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-800">
                {{ $messages->links() }}
            </div>
        </div>

    </div>

@endsection
