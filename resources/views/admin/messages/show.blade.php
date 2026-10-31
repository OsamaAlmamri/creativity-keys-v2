@extends('admin.layouts.app')

@section('page_title', 'تفاصيل الطلب من: ' . $message->name)

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-slate-400 hover:text-white flex items-center gap-1">
                <span>← العودة لقائمة الرسائل</span>
            </a>

            <div class="flex items-center gap-2">
                <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold transition-colors {{ $message->is_read ? 'bg-slate-800 text-slate-300 hover:bg-slate-750' : 'bg-amber-500 text-slate-950' }}">
                        {{ $message->is_read ? 'تحديد كـ "غير مقروءة"' : 'تحديد كـ "مقروءة"' }}
                    </button>
                </form>

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm-title="حذف الرسالة نهائياً" data-item-name="{{ $message->name }}" data-confirm-message="هل أنت متأكد من رغبتك في حذف هذه الرسالة نهائياً؟ سيتم إزالتها من سجل الطلبات.">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete px-4 py-2 rounded-xl text-xs font-bold transition-all inline-flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        <span>حذف الرسالة</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Emergency Alert Banner if Emergency -->
        @if($message->is_emergency)
            <div class="p-4 rounded-2xl bg-red-500/15 border-2 border-red-500/40 text-red-300 flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-red-500 animate-ping shrink-0"></span>
                <span class="font-bold text-sm">تنبيه: العميل حدد هذا الطلب كـ "حالة طوارئ مستعجلة"! يرجى الاتصال به في الحال.</span>
            </div>
        @endif

        <!-- Message Details Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
            
            <!-- Sender Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-800">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black text-xl">
                        {{ mb_substr($message->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-white">{{ $message->name }}</h2>
                        <div class="flex items-center gap-3 text-xs text-slate-400 mt-1">
                            <span>الحي: {{ $message->city_district ?? 'غير محدد' }}</span>
                            <span>•</span>
                            <span>الخدمة: {{ $message->service_needed ?? 'طلب عام' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Call & WhatsApp Buttons -->
                <div class="flex items-center gap-2">
                    <a href="tel:{{ $message->phone }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span dir="ltr">{{ $message->phone }}</span>
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '966', preg_replace('/\D/', '', $message->phone)) }}?text={{ urlencode('مرحباً أخي ' . $message->name . '، معك فني مفتاح باب البستان بخصوص طلبك.') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-colors shadow-lg shadow-emerald-600/20">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        مراسلة عبر واتساب
                    </a>
                </div>
            </div>

            <!-- Message Body -->
            <div class="space-y-2">
                <div class="text-xs font-bold text-slate-400">نص وتفاصيل المشكلة / الطلب:</div>
                <div class="p-6 rounded-2xl bg-slate-950 border border-slate-800 text-slate-200 text-sm leading-relaxed whitespace-pre-wrap font-sans">
                    {{ $message->message }}
                </div>
                <div class="text-[11px] text-slate-500 pt-1">
                    أُرسلت في: {{ $message->created_at->format('Y-m-d h:i A') }} ({{ $message->created_at->diffForHumans() }})
                </div>
            </div>

            <!-- Internal Staff Notes -->
            <div class="pt-6 border-t border-slate-800 space-y-3">
                <div class="text-xs font-bold text-white flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 012.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>ملاحظات داخلية لفريق العمل (لا تظهر للعميل)</span>
                </div>

                <form action="{{ route('admin.messages.notes', $message) }}" method="POST" class="space-y-3">
                    @csrf
                    <textarea name="notes" rows="3" class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-amber-400 focus:outline-none" placeholder="اكتب ملاحظاتك، مثل: تم إرسال الفني أحمد للموقع، التكلفة المتفق عليها 200 ريال...">{{ old('notes', $message->notes) }}</textarea>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                            حفظ الملاحظة
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection
