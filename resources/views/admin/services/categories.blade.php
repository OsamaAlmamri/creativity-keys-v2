@extends('admin.layouts.app')

@section('page_title', 'إدارة أصناف الخدمات')

@section('content')

    <div class="space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">أصناف وتصنيفات الخدمات</h2>
                <p class="text-xs text-slate-400">تقسيم وتنظيم خدمات المحل (مثل: مفاتيح السيارات، فتح الأبواب، الأقفال الذكية، الخزنات)</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.services.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                    ← العودة لقائمة الخدمات
                </a>
            </div>
        </div>

        <!-- Add Category Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                إضافة صنف خدمة جديد
            </h3>

            <form action="{{ route('admin.service-categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Category Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-bold text-slate-300">اسم صنف الخدمة <span class="text-amber-400">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: أقفال الأبواب السكنية">
                    </div>

                    <!-- Icon -->
                    <div class="space-y-1.5">
                        <label for="icon" class="block text-xs font-bold text-slate-300">أيقونة الصنف</label>
                        <select id="icon" name="icon" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="key">مفتاح عام (Key)</option>
                            <option value="car-key">مفتاح سيارة (Car Key)</option>
                            <option value="lock-open">قفل مفتوح (Lockout)</option>
                            <option value="cpu-chip">أقفال ذكية (Smart Locks)</option>
                            <option value="shield-check">خزنة وتجوري (Safe / Security)</option>
                            <option value="truck">ورشة متنقلة (Mobile)</option>
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div class="space-y-1.5">
                        <label for="sort_order" class="block text-xs font-bold text-slate-300">ترتيب الظهور</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-1.5">
                    <label for="description" class="block text-xs font-bold text-slate-300">وصف توضيحي لهذا الصنف (اختياري)</label>
                    <input type="text" id="description" name="description" value="{{ old('description') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="شرح مختصر عن نوعية الخدمات التي تندرج تحت هذا الصنف">
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400 w-5 h-5">
                        <span class="text-xs font-bold text-slate-300">صنف نشط ومفعل</span>
                    </label>

                    <button type="submit" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        إضافة الصنف
                    </button>
                </div>
            </form>
        </div>

        <!-- Categories Table -->
        <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl">
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <h3 class="text-base font-bold text-white">الأصناف الحالية ({{ $categories->count() }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead class="bg-slate-950/60 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">اسم الصنف</th>
                            <th class="px-6 py-4">الرمز التعريفي (Slug)</th>
                            <th class="px-6 py-4">الوصف</th>
                            <th class="px-6 py-4 text-center">عدد الخدمات التابعة</th>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4 text-center">الترتيب</th>
                            <th class="px-6 py-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($categories as $cat)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                        </div>
                                        <span>{{ $cat->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-mono text-slate-400 whitespace-nowrap" dir="ltr">
                                    {{ $cat->slug }}
                                </td>
                                <td class="px-6 py-4 text-slate-300 max-w-xs">
                                    <span class="line-clamp-1">{{ $cat->description ?? '—' }}</span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full bg-slate-800 text-amber-400 font-bold">
                                        {{ $cat->services_count }} خدمات
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-0.5 rounded-full {{ $cat->is_active ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-500' }} font-bold">
                                        {{ $cat->is_active ? 'نشط' : 'معطل' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-mono text-slate-400 whitespace-nowrap">
                                    {{ $cat->sort_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2 space-x-reverse">
                                    <button type="button" onclick="openCategoryEditModal({{ json_encode($cat) }})" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors" title="تعديل">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.service-categories.destroy', $cat) }}" method="POST" class="inline" data-confirm-title="تأكيد حذف صنف الخدمات" data-item-name="{{ $cat->name }}" data-confirm-message="هل أنت متأكد من رغبتك في حذف هذا الصنف؟ قد يؤثر ذلك على ترتيب الخدمات التابعة له.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete p-2 rounded-lg transition-all" title="حذف الصنف">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                    لا توجد أصناف مضافة حتى الآن.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Edit Category Modal -->
    <div id="edit-category-modal" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-6">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="text-lg font-bold text-white">تعديل صنف الخدمة</h3>
                <button type="button" onclick="document.getElementById('edit-category-modal').classList.add('hidden')" class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form id="edit-category-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">اسم صنف الخدمة <span class="text-amber-400">*</span></label>
                    <input type="text" id="edit_cat_name" name="name" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">الاسم اللطيف (Slug)</label>
                    <input type="text" id="edit_cat_slug" name="slug" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-left">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">الأيقونة</label>
                        <select id="edit_cat_icon" name="icon" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="key">مفتاح عام (Key)</option>
                            <option value="car-key">مفتاح سيارة (Car Key)</option>
                            <option value="lock-open">قفل مفتوح (Lockout)</option>
                            <option value="cpu-chip">أقفال ذكية (Smart Locks)</option>
                            <option value="shield-check">خزنة وتجوري (Safe)</option>
                            <option value="truck">ورشة متنقلة (Mobile)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">ترتيب الظهور</label>
                        <input type="number" id="edit_cat_sort" name="sort_order" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">الوصف</label>
                    <input type="text" id="edit_cat_desc" name="description" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1" class="rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400">
                    <label for="edit_cat_active" class="text-xs font-bold text-slate-300 cursor-pointer">صنف نشط ومفعل</label>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
                    <button type="button" onclick="document.getElementById('edit-category-modal').classList.add('hidden')" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs">إلغاء</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs shadow-lg shadow-amber-500/20">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCategoryEditModal(cat) {
            const form = document.getElementById('edit-category-form');
            form.action = `/admin/service-categories/${cat.id}`;
            document.getElementById('edit_cat_name').value = cat.name;
            document.getElementById('edit_cat_slug').value = cat.slug;
            document.getElementById('edit_cat_icon').value = cat.icon || 'key';
            document.getElementById('edit_cat_desc').value = cat.description || '';
            document.getElementById('edit_cat_sort').value = cat.sort_order;
            document.getElementById('edit_cat_active').checked = !!cat.is_active;

            document.getElementById('edit-category-modal').classList.remove('hidden');
        }
    </script>

@endsection
