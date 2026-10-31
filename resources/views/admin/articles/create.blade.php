@extends('admin.layouts.app')

@section('page_title', 'كتابة مقال جديد')

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">كتابة ونشر مقال جديد</h2>
                <p class="text-xs text-slate-400">سيظهر المقال في قسم المدونة والنصائح بالموقع لزيادة ثقة العملاء وتحسين محركات البحث</p>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                ← العودة لقائمة المقالات
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title -->
                <div class="space-y-1.5">
                    <label for="title" class="block text-xs font-bold text-slate-300">عنوان المقال الرئيسي <span class="text-amber-400">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: كيف تحافظ على بطارية ريموت سيارتك الذكية من التلف؟">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Category -->
                    <div class="space-y-1.5">
                        <label for="category" class="block text-xs font-bold text-slate-300">التصنيف <span class="text-amber-400">*</span></label>
                        <input type="text" id="category" name="category" list="categories-list" value="{{ old('category', 'مفاتيح سيارات') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
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
                        <label for="slug" class="block text-xs font-bold text-slate-300">الرابط المخصص (Slug - اختياري)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-left" placeholder="auto-generated-if-empty">
                    </div>

                    <!-- Read time -->
                    <div class="space-y-1.5">
                        <label for="read_time" class="block text-xs font-bold text-slate-300">وقت القراءة التقديري</label>
                        <input type="text" id="read_time" name="read_time" value="{{ old('read_time', '4 دقائق قراءة') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <!-- Excerpt -->
                <div class="space-y-1.5">
                    <label for="excerpt" class="block text-xs font-bold text-slate-300">المقدمة والملخص المختصر <span class="text-amber-400">*</span></label>
                    <textarea id="excerpt" name="excerpt" rows="2" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="سطرين يوضحان فكرة المقال وتظهر في بطاقة المعاينة والبحث">{{ old('excerpt') }}</textarea>
                </div>

                <!-- Content -->
                <div class="space-y-1.5">
                    <label for="content" class="block text-xs font-bold text-slate-300">نص ومحتوى المقال بالكامل <span class="text-amber-400">*</span></label>
                    <textarea id="content" name="content" rows="10" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm leading-relaxed focus:border-amber-400 focus:outline-none" placeholder="اكتب فقرات المقال هنا... يمكنك استخدام أسطر جديدة وعلامات الترقيم">{{ old('content') }}</textarea>
                </div>

                <!-- Image Upload / URL -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                    <div class="space-y-1.5">
                        <label for="image_file" class="block text-xs font-bold text-slate-300">رفع صورة الغلاف (من جهازك)</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="w-full text-slate-400 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-slate-950 hover:file:bg-amber-400">
                    </div>

                    <div class="space-y-1.5">
                        <label for="image_url" class="block text-xs font-bold text-slate-300">أو رابط صورة غلاف مباشر (URL)</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" dir="ltr" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-left" placeholder="https://images.unsplash.com/...">
                    </div>
                </div>

                <!-- Publish Status -->
                <label class="group p-4 rounded-2xl bg-slate-950 border border-slate-800 hover:border-slate-700 transition-all flex items-center justify-between gap-3 cursor-pointer select-none has-[:checked]:border-emerald-500/40 has-[:checked]:bg-emerald-500/[0.03]">
                    <div class="space-y-1 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-white block">حالة النشر: متاح للزوار</span>
                            <span class="hidden group-has-[:checked]:inline-flex text-[10px] font-black px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">منشور</span>
                            <span class="inline-flex group-has-[:checked]:hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-800 text-slate-400 border border-slate-700">مسودة</span>
                        </div>
                        <span class="text-[11px] text-slate-400 block">نشر المقال فوراً في قسم المقالات والمدونة في الموقع الرئيسي</span>
                    </div>
                    <div class="modern-switch modern-switch-emerald shrink-0">
                        <input type="checkbox" id="is_published" name="is_published" value="1" class="modern-switch-input" checked>
                        <span class="modern-switch-track">
                            <span class="modern-switch-thumb"></span>
                        </span>
                    </div>
                </label>

                <!-- Actions -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-800">
                    <a href="{{ route('admin.articles.index') }}" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                        إلغاء
                    </a>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        حفظ ونشر المقال
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
