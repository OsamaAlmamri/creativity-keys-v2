@extends('admin.layouts.app')

@section('page_title', 'تعديل الخدمة: ' . $service->title)

@section('content')

    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">تعديل الخدمة</h2>
                <p class="text-xs text-slate-400">تحديث تفاصيل خدمة: {{ $service->title }}</p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                ← العودة لقائمة الخدمات
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="space-y-1.5">
                        <label for="title" class="block text-xs font-bold text-slate-300">اسم أو عنوان الخدمة <span class="text-amber-400">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <!-- Category -->
                    <div class="space-y-1.5">
                        <label for="category_id" class="block text-xs font-bold text-slate-300">صنف أو تصنيف الخدمة</label>
                        <select id="category_id" name="category_id" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                            <option value="">-- بدون صنف (عام) --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
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
                            <option value="car-key" {{ old('icon', $service->icon) === 'car-key' ? 'selected' : '' }}>مفتاح سيارة (Car Key)</option>
                            <option value="lock-open" {{ old('icon', $service->icon) === 'lock-open' ? 'selected' : '' }}>قفل مفتوح (Door Unlock)</option>
                            <option value="cpu-chip" {{ old('icon', $service->icon) === 'cpu-chip' ? 'selected' : '' }}>أقفال ذكية (Smart Locks)</option>
                            <option value="shield-check" {{ old('icon', $service->icon) === 'shield-check' ? 'selected' : '' }}>خزنة وتجوري (Safe / Security)</option>
                            <option value="truck" {{ old('icon', $service->icon) === 'truck' ? 'selected' : '' }}>ورشة متنقلة (Mobile Truck)</option>
                            <option value="key" {{ old('icon', $service->icon) === 'key' ? 'selected' : '' }}>مفتاح عام (General Key)</option>
                        </select>
                    </div>

                    <!-- Starting price -->
                    <div class="space-y-1.5">
                        <label for="price_starting_at" class="block text-xs font-bold text-slate-300">السعر التقديري (اختياري)</label>
                        <input type="text" id="price_starting_at" name="price_starting_at" value="{{ old('price_starting_at', $service->price_starting_at) }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <!-- Short Description -->
                <div class="space-y-1.5">
                    <label for="short_description" class="block text-xs font-bold text-slate-300">الوصف المختصر <span class="text-amber-400">*</span></label>
                    <textarea id="short_description" name="short_description" rows="3" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ old('short_description', $service->short_description) }}</textarea>
                </div>

                <!-- Features bullet points -->
                <div class="space-y-1.5">
                    <label for="features" class="block text-xs font-bold text-slate-300">مميزات الخدمة (سطر لكل ميزة)</label>
                    <textarea id="features" name="features" rows="4" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : '') }}</textarea>
                </div>

                <!-- Emergency & Active Toggles -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="group p-4 rounded-2xl bg-slate-950 border border-slate-800 hover:border-slate-700 transition-all flex items-center justify-between gap-3 cursor-pointer select-none has-[:checked]:border-red-500/40 has-[:checked]:bg-red-500/[0.03]">
                        <div class="space-y-1 flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-white block">خدمة طوارئ 24 ساعة</span>
                                <span class="hidden group-has-[:checked]:inline-flex text-[10px] font-black px-2 py-0.5 rounded-full bg-red-500/15 text-red-400 border border-red-500/30">طوارئ</span>
                            </div>
                            <span class="text-[11px] text-slate-400 block">تمييزها ببادج أحمر لطوارئ 24/7</span>
                        </div>
                        <div class="modern-switch modern-switch-red shrink-0">
                            <input type="checkbox" name="is_emergency" value="1" class="modern-switch-input" {{ old('is_emergency', $service->is_emergency) ? 'checked' : '' }}>
                            <span class="modern-switch-track">
                                <span class="modern-switch-thumb"></span>
                            </span>
                        </div>
                    </label>

                    <label class="group p-4 rounded-2xl bg-slate-950 border border-slate-800 hover:border-slate-700 transition-all flex items-center justify-between gap-3 cursor-pointer select-none has-[:checked]:border-emerald-500/40 has-[:checked]:bg-emerald-500/[0.03]">
                        <div class="space-y-1 flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-white block">حالة الخدمة: نشطة</span>
                                <span class="hidden group-has-[:checked]:inline-flex text-[10px] font-black px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">نشطة</span>
                                <span class="inline-flex group-has-[:checked]:hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-800 text-slate-400 border border-slate-700">معطلة</span>
                            </div>
                            <span class="text-[11px] text-slate-400 block">تظهر للزوار في الموقع</span>
                        </div>
                        <div class="modern-switch modern-switch-emerald shrink-0">
                            <input type="checkbox" name="is_active" value="1" class="modern-switch-input" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                            <span class="modern-switch-track">
                                <span class="modern-switch-thumb"></span>
                            </span>
                        </div>
                    </label>
                </div>

                <!-- Sort Order -->
                <div class="space-y-1.5">
                    <label for="sort_order" class="block text-xs font-bold text-slate-300">ترتيب الظهور</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-32 bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
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
