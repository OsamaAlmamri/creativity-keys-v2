@extends('admin.layouts.app')

@section('page_title', 'إضافة خدمة جديدة')

@section('content')

    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">إضافة خدمة جديدة لمحل المفاتيح</h2>
                <p class="text-xs text-slate-400">ستظهر هذه الخدمة لزوار الموقع في قسم خدماتنا</p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                ← العودة لقائمة الخدمات
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl">
            <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="space-y-1.5">
                        <label for="title" class="block text-xs font-bold text-slate-300">اسم أو عنوان الخدمة <span class="text-amber-400">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: فتح سيارات وقص مفاتيح البصمة">
                    </div>

                    <!-- Category -->
                    <div class="space-y-1.5">
                        <label for="category_id" class="block text-xs font-bold text-slate-300">صنف أو تصنيف الخدمة</label>
                        <select id="category_id" name="category_id" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="">-- بدون صنف (عام) --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Icon type -->
                    <div class="space-y-1.5">
                        <label for="icon" class="block text-xs font-bold text-slate-300">نوع الأيقونة</label>
                        <select id="icon" name="icon" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="car-key">مفتاح سيارة (Car Key)</option>
                            <option value="lock-open">قفل مفتوح (Door Unlock)</option>
                            <option value="cpu-chip">أقفال ذكية (Smart Locks)</option>
                            <option value="shield-check">خزنة وتجوري (Safe / Security)</option>
                            <option value="truck">ورشة متنقلة (Mobile Truck)</option>
                            <option value="key">مفتاح عام (General Key)</option>
                        </select>
                    </div>

                    <!-- Starting price -->
                    <div class="space-y-1.5">
                        <label for="price_starting_at" class="block text-xs font-bold text-slate-300">السعر التقديري (اختياري)</label>
                        <input type="text" id="price_starting_at" name="price_starting_at" value="{{ old('price_starting_at') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="مثال: يبدأ من 150 ر.س">
                    </div>
                </div>

                <!-- Short Description -->
                <div class="space-y-1.5">
                    <label for="short_description" class="block text-xs font-bold text-slate-300">الوصف المختصر (يظهر في الكرت) <span class="text-amber-400">*</span></label>
                    <textarea id="short_description" name="short_description" rows="3" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="شرح موجز لا يتجاوز سطرين عن الخدمة">{{ old('short_description') }}</textarea>
                </div>

                <!-- Features bullet points -->
                <div class="space-y-1.5">
                    <label for="features" class="block text-xs font-bold text-slate-300">مميزات الخدمة (ضع كل ميزة في سطر جديد)</label>
                    <textarea id="features" name="features" rows="4" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none" placeholder="قص ليزر دقيق 100%&#10;ضمان شامل على البرمجة&#10;فني معتمد يصل لموقعك">{{ old('features') }}</textarea>
                </div>

                <!-- Emergency & Active Toggles -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_emergency" value="1" {{ old('is_emergency') ? 'checked' : '' }} class="rounded border-slate-700 bg-slate-900 text-amber-500 focus:ring-amber-400 w-5 h-5">
                        <div>
                            <span class="text-xs font-bold text-white block">خدمة طوارئ 24 ساعة</span>
                            <span class="text-[11px] text-slate-400">سيتم تمييزها ببادج طوارئ باللون الأحمر</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-700 bg-slate-900 text-emerald-500 focus:ring-emerald-400 w-5 h-5">
                        <div>
                            <span class="text-xs font-bold text-white block">حالة الخدمة: نشطة</span>
                            <span class="text-[11px] text-slate-400">تظهر للزوار في الموقع مباشرة</span>
                        </div>
                    </label>
                </div>

                <!-- Sort Order -->
                <div class="space-y-1.5">
                    <label for="sort_order" class="block text-xs font-bold text-slate-300">ترتيب الظهور (الرقم الأقل يظهر أولاً)</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" class="w-32 bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                        إلغاء
                    </a>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        حفظ الخدمة
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
