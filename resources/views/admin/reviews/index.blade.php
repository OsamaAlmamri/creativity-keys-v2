@extends('admin.layouts.app')

@section('page_title', 'إدارة تقييمات العملاء')

@section('content')

    <div class="space-y-8">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">آراء وتقييمات العملاء</h2>
                <p class="text-xs text-slate-400">إدارة التقييمات المعروضة في قسم "آراء العملاء" بالصفحة الرئيسية</p>
            </div>
        </div>

        <!-- Add Review Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                إضافة تقييم جديد
            </h3>

            <form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Client Name -->
                    <div class="space-y-1.5">
                        <label for="client_name" class="block text-xs font-bold text-slate-300">اسم العميل <span
                                class="text-amber-400">*</span></label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" required
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                            placeholder="مثال: تركي الشمري">
                    </div>

                    <!-- Client Title / City -->
                    <div class="space-y-1.5">
                        <label for="client_title" class="block text-xs font-bold text-slate-300">المدينة أو الحي</label>
                        <input type="text" id="client_title" name="client_title"
                            value="{{ old('client_title', 'حي الروضة، ' . \App\Models\Setting::get('city_name', 'جدة')) }}"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <!-- Rating Stars -->
                    <div class="space-y-1.5">
                        <label for="rating" class="block text-xs font-bold text-slate-300">التقييم (النجوم)</label>
                        <select id="rating" name="rating"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="5" selected>★★★★★ (5 نجوم - ممتاز)</option>
                            <option value="4">★★★★☆ (4 نجوم - جيد جداً)</option>
                            <option value="3">★★★☆☆ (3 نجوم - جيد)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Service Rendered -->
                    <div class="space-y-1.5">
                        <label for="service_rendered" class="block text-xs font-bold text-slate-300">نوع الخدمة المقدمة
                            للعميل</label>
                        <input type="text" id="service_rendered" name="service_rendered"
                            value="{{ old('service_rendered') }}"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                            placeholder="مثال: فتح باب شقة طوارئ">
                    </div>

                    <!-- Approval toggle -->
                    <div class="flex items-center gap-3 pt-6">
                        <input type="checkbox" id="is_approved" name="is_approved" value="1" checked
                            class="w-5 h-5 rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400">
                        <label for="is_approved" class="text-xs font-bold text-slate-200 cursor-pointer">
                            اعتماد ونشر التقييم في الصفحة الرئيسية فوراً
                        </label>
                    </div>
                </div>

                <!-- Comment -->
                <div class="space-y-1.5">
                    <label for="comment" class="block text-xs font-bold text-slate-300">نص التقييم أو تجربة العميل <span
                            class="text-amber-400">*</span></label>
                    <textarea id="comment" name="comment" rows="3" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                        placeholder="أشيد بسرعة الاستجابة واحترافية الفني في قص وبرمجة مفتاح سيارتي...">{{ old('comment') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        حفظ التقييم
                    </button>
                </div>
            </form>
        </div>

        <!-- Reviews List Table -->
        <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl">
            <div class="p-6 border-b border-slate-800">
                <h3 class="text-base font-bold text-white">التقييمات المسجلة ({{ $reviews->total() }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead class="bg-slate-950/60 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4">العميل</th>
                            <th class="px-6 py-4">التقييم</th>
                            <th class="px-6 py-4">الخدمة</th>
                            <th class="px-6 py-4">نص التقييم</th>
                            <th class="px-6 py-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($reviews as $rev)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.reviews.toggle', $rev) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-2.5 py-1 rounded-full text-xs font-bold transition-colors {{ $rev->is_approved ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20' : 'bg-slate-800 text-slate-400 hover:bg-slate-700' }}"
                                            title="اضغط لتغيير الحالة">
                                            {{ $rev->is_approved ? 'معتمد ومنشور' : 'مخفي' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-white">
                                    {{ $rev->client_name }}
                                    <div class="text-[11px] text-slate-400 font-normal">{{ $rev->client_title }}</div>
                                </td>
                                <td class="px-6 py-4 text-amber-400 font-black whitespace-nowrap">
                                    {{ str_repeat('★', $rev->rating) }}
                                </td>
                                <td class="px-6 py-4 text-slate-300 whitespace-nowrap">
                                    {{ $rev->service_rendered ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-slate-300 max-w-xs">
                                    <p class="line-clamp-2">{{ $rev->comment }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2 space-x-reverse">
                                    <button type="button" onclick="openReviewEditModal({{ json_encode($rev) }})"
                                        class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors"
                                        title="تعديل التقييم">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.reviews.destroy', $rev) }}" method="POST" class="inline"
                                        data-confirm-title="تأكيد حذف التقييم"
                                        data-item-name="تقييم: {{ $rev->customer_name }} ({{ $rev->rating }} نجوم)"
                                        data-confirm-message="هل أنت متأكد من حذف تقييم العميل؟ سيتم حذفه من الموقع بشكل نهائي.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete p-2 rounded-lg transition-all"
                                            title="حذف التقييم">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                    لا توجد تقييمات مسجلة بعد.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-800">
                {{ $reviews->links() }}
            </div>
        </div>

    </div>

    <!-- Edit Review Modal -->
    <div id="edit-review-modal"
        class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-6">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="text-lg font-bold text-white">تعديل بيانات التقييم</h3>
                <button type="button" onclick="document.getElementById('edit-review-modal').classList.add('hidden')"
                    class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="edit-review-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">اسم العميل <span
                                class="text-amber-400">*</span></label>
                        <input type="text" id="edit_rev_name" name="client_name" required
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">المدينة أو الحي</label>
                        <input type="text" id="edit_rev_title" name="client_title"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">التقييم بالنجوم</label>
                        <select id="edit_rev_rating" name="rating"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="5">★★★★★ (5 نجوم)</option>
                            <option value="4">★★★★☆ (4 نجوم)</option>
                            <option value="3">★★★☆☆ (3 نجوم)</option>
                            <option value="2">★★☆☆☆ (نجمتان)</option>
                            <option value="1">★☆☆☆☆ (نجمة واحدة)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">نوع الخدمة</label>
                        <input type="text" id="edit_rev_service" name="service_rendered"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">نص التقييم <span
                            class="text-amber-400">*</span></label>
                    <textarea id="edit_rev_comment" name="comment" rows="3" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_approved" id="edit_rev_approved" value="1"
                        class="rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400">
                    <label for="edit_rev_approved" class="text-xs font-bold text-slate-300 cursor-pointer">معتمد ومنشور على
                        الموقع</label>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
                    <button type="button" onclick="document.getElementById('edit-review-modal').classList.add('hidden')"
                        class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs">إلغاء</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-black text-xs shadow-lg shadow-amber-500/20">حفظ
                        التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openReviewEditModal(rev) {
            const form = document.getElementById('edit-review-form');
            form.action = `/admin/reviews/${rev.id}`;
            document.getElementById('edit_rev_name').value = rev.client_name;
            document.getElementById('edit_rev_title').value = rev.client_title || '';
            document.getElementById('edit_rev_rating').value = rev.rating;
            document.getElementById('edit_rev_service').value = rev.service_rendered || '';
            document.getElementById('edit_rev_comment').value = rev.comment;
            document.getElementById('edit_rev_approved').checked = !!rev.is_approved;

            document.getElementById('edit-review-modal').classList.remove('hidden');
        }
    </script>

@endsection