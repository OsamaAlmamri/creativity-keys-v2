@extends('admin.layouts.app')

@section('page_title', 'تعديل المقال: ' . $article->title)

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">تعديل المقال</h2>
                <p class="text-xs text-slate-400">تحديث نص ومحتوى المقال وتصنيفه</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="text-xs font-bold text-amber-400 hover:underline">
                    معاينة المقال في الموقع ←
                </a>
                <span class="text-slate-600">|</span>
                <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                    العودة للمقالات
                </a>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="space-y-1.5">
                    <label for="title" class="block text-xs font-bold text-slate-300">عنوان المقال الرئيسي <span class="text-amber-400">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Category -->
                    <div class="space-y-1.5">
                        <label for="category" class="block text-xs font-bold text-slate-300">التصنيف <span class="text-amber-400">*</span></label>
                        <input type="text" id="category" name="category" list="categories-list" value="{{ old('category', $article->category) }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        <datalist id="categories-list">
                            @foreach($existingCategories as $c)
                                <option value="{{ $c }}">
                            @endforeach
                            <option value="مفاتيح سيارات">
                            <option value="أقفال ذكية">
                            <option value="نصائح أمنية">
                            <option value="طوارئ وفتح أبواب">
                            <option value="خزنات وتجوري">
                        </datalist>
                    </div>

                    <!-- Slug -->
                    <div class="space-y-1.5">
                        <label for="slug" class="block text-xs font-bold text-slate-300">الرابط المخصص (Slug)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-left">
                    </div>

                    <!-- Read time -->
                    <div class="space-y-1.5">
                        <label for="read_time" class="block text-xs font-bold text-slate-300">وقت القراءة التقديري</label>
                        <input type="text" id="read_time" name="read_time" value="{{ old('read_time', $article->read_time) }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <!-- Excerpt -->
                <div class="space-y-1.5">
                    <label for="excerpt" class="block text-xs font-bold text-slate-300">المقدمة والملخص المختصر <span class="text-amber-400">*</span></label>
                    <textarea id="excerpt" name="excerpt" rows="2" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>

                <!-- Content -->
                <div class="space-y-1.5">
                    <label for="content" class="block text-xs font-bold text-slate-300">نص ومحتوى المقال بالكامل <span class="text-amber-400">*</span></label>
                    <textarea id="content" name="content" rows="12" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm leading-relaxed focus:border-amber-400 focus:outline-none">{{ old('content', $article->content) }}</textarea>
                </div>

                <!-- Current Image Preview & Upload -->
                <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-4">
                    <div class="flex items-center gap-4">
                        @if($article->image_url)
                            <div class="w-20 h-16 rounded-xl overflow-hidden border border-slate-800 shrink-0">
                                <img src="{{ $article->image_url }}" alt="الغلاف" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="text-xs text-slate-400">
                            الصورة الحالية للمقال. يمكنك استبدالها برابط جديد أو برفع ملف من جهازك أدناه.
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-300">رفع صورة جديدة</label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-slate-400 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-400">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-300">أو رابط صورة مباشر (URL)</label>
                            <input type="url" name="image_url" value="{{ old('image_url', $article->image_url) }}" dir="ltr" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-left">
                        </div>
                    </div>
                </div>

                <!-- Publish Status -->
                <x-modern-switch
                    name="is_published"
                    id="is_published"
                    :checked="(bool)old('is_published', $article->is_published)"
                    label="حالة النشر: متاح للزوار"
                    subtitle="نشر المقال فوراً في قسم المقالات والمدونة في الموقع الرئيسي"
                    color="emerald"
                    activeBadge="منشور"
                    inactiveBadge="مسودة"
                />

                <!-- Actions -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-800">
                    <a href="{{ route('admin.articles.index') }}" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                        إلغاء
                    </a>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        حفظ التعديلات
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
