@extends('admin.layouts.app')

@section('page_title', 'إدارة معرض الصور والأعمال')

@section('content')

    <div class="space-y-8">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">معرض الصور والأعمال</h2>
                <p class="text-xs text-slate-400">إضافة صور وفيديوهات من أعمال الورشة والأجهزة والأقفال لعرضها للزوار</p>
            </div>
        </div>

        <!-- Add Photo Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                إضافة عمل أو صورة جديدة للمعرض
            </h3>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="space-y-1.5">
                        <label for="title" class="block text-xs font-bold text-slate-300">عنوان الصورة / العمل <span
                                class="text-amber-400">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                            placeholder="مثال: برمجة بصمة لاندكروزر 2024">
                    </div>

                    <!-- Category -->
                    <div class="space-y-1.5">
                        <label for="category" class="block text-xs font-bold text-slate-300">التصنيف <span
                                class="text-amber-400">*</span></label>
                        <input type="text" id="category" name="category" list="categories-list"
                            value="{{ old('category', 'مفاتيح سيارات') }}" required
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                            placeholder="اختر أو اكتب تصنيف جديد">
                        <datalist id="categories-list">
                            <option value="مفاتيح سيارات">
                            <option value="أقفال ذكية">
                            <option value="طوارئ وفتح أبواب">
                            <option value="خزنات وتجوري">
                            <option value="أجهزة ومعدات">
                        </datalist>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image File Upload -->
                    <div class="space-y-1.5">
                        <label for="image_file" class="block text-xs font-bold text-slate-300">رفع ملف صورة من جهازك (خيار
                            1)</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-slate-400 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-white hover:file:bg-amber-400">
                    </div>

                    <!-- Image URL -->
                    <div class="space-y-1.5">
                        <label for="image_url" class="block text-xs font-bold text-slate-300">أو رابط صورة مباشر (خيار
                            2)</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" dir="ltr"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-left"
                            placeholder="https://images.unsplash.com/...">
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-1.5">
                    <label for="description" class="block text-xs font-bold text-slate-300">وصف موجز للعمل (اختياري)</label>
                    <input type="text" id="description" name="description" value="{{ old('description') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                        placeholder="مثال: تم قص المفتاح بالليزر في موقع العميل خلال 20 دقيقة">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        إضافة إلى المعرض
                    </button>
                </div>
            </form>
        </div>

        <!-- Existing Photos Grid -->
        <div>
            <h3 class="text-base font-bold text-white mb-4">الصور المعروضة حالياً ({{ $items->total() }})</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($items as $item)
                    <div class="relative bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-lg group">
                        <!-- Image -->
                        <div class="h-48 overflow-hidden bg-slate-950">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Card Info -->
                        <div class="p-4 space-y-1">
                            <span
                                class="inline-block px-2 py-0.5 rounded-full bg-slate-800 text-amber-400 text-[10px] font-bold">
                                {{ $item->category }}
                            </span>
                            <h4 class="text-sm font-bold text-white truncate">{{ $item->title }}</h4>
                            @if($item->description)
                                <p class="text-xs text-slate-400 line-clamp-1">{{ $item->description }}</p>
                            @endif
                        </div>

                        <!-- Actions Overlay -->
                        <div class="p-3 border-t border-slate-800/80 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-3">
                                <a href="{{ $item->image_url }}" target="_blank"
                                    class="text-slate-400 hover:text-white transition-colors">
                                    معاينة
                                </a>
                                <button type="button" onclick="openGalleryEditModal({{ json_encode($item) }})"
                                    class="text-amber-400 hover:text-amber-300 font-bold transition-colors">
                                    تعديل
                                </button>
                            </div>
                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST"
                                data-confirm-title="تأكيد حذف الصورة" data-item-name="{{ $item->title }}"
                                data-confirm-message="هل أنت متأكد من رغبتك في حذف هذه الصورة من معرض الأعمال؟">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-400 hover:text-red-300 font-bold transition-colors cursor-pointer inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>حذف</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 text-slate-500">
                        لا توجد صور في المعرض حالياً.
                    </div>
                @endforelse
            </div>

            <div class="pt-6">
                {{ $items->links() }}
            </div>
        </div>

    </div>

    <!-- Edit Gallery Item Modal -->
    <div id="edit-gallery-modal"
        class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-6">
            <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                <h3 class="text-lg font-bold text-white">تعديل عنصر معرض الأعمال</h3>
                <button type="button" onclick="document.getElementById('edit-gallery-modal').classList.add('hidden')"
                    class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="edit-gallery-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">عنوان الصورة / العمل <span
                            class="text-amber-400">*</span></label>
                    <input type="text" id="edit_gallery_title" name="title" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">التصنيف <span
                            class="text-amber-400">*</span></label>
                    <input type="text" id="edit_gallery_category" name="category" list="edit-categories-list" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    <datalist id="edit-categories-list">
                        <option value="مفاتيح سيارات">
                        <option value="أقفال ذكية">
                        <option value="طوارئ وفتح أبواب">
                        <option value="خزنات وتجوري">
                        <option value="أجهزة ومعدات">
                    </datalist>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">رابط الصورة (URL)</label>
                    <input type="url" id="edit_gallery_url" name="image_url" dir="ltr"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-left">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">أو استبدال برفع ملف صورة جديد</label>
                    <input type="file" name="image_file" accept="image/*"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2 text-slate-400 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-white">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-300">الوصف</label>
                    <input type="text" id="edit_gallery_desc" name="description"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-300">ترتيب الظهور</label>
                        <input type="number" id="edit_gallery_sort" name="sort_order"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="flex items-center gap-2 pt-6">
                        <input type="checkbox" name="is_active" id="edit_gallery_active" value="1"
                            class="rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-400">
                        <label for="edit_gallery_active" class="text-xs font-bold text-slate-300 cursor-pointer">نشط في
                            المعرض</label>
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-800">
                    <button type="button" onclick="document.getElementById('edit-gallery-modal').classList.add('hidden')"
                        class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs">إلغاء</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-black text-xs shadow-lg shadow-amber-500/20">حفظ
                        التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openGalleryEditModal(item) {
            const form = document.getElementById('edit-gallery-form');
            form.action = `/admin/gallery/${item.id}`;
            document.getElementById('edit_gallery_title').value = item.title;
            document.getElementById('edit_gallery_category').value = item.category;
            document.getElementById('edit_gallery_url').value = item.image_url;
            document.getElementById('edit_gallery_desc').value = item.description || '';
            document.getElementById('edit_gallery_sort').value = item.sort_order;
            document.getElementById('edit_gallery_active').checked = !!item.is_active;

            document.getElementById('edit-gallery-modal').classList.remove('hidden');
        }
    </script>

@endsection