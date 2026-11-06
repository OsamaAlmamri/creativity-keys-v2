@extends('admin.layouts.app')

@section('page_title', 'تعديل الخدمة: ' . $service->title)

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-white">تعديل الخدمة ومحتواها التفصيلي</h2>
                <p class="text-xs text-slate-400">تحديث تفاصيل خدمة: {{ $service->title }} وإعدادات الـ SEO</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-amber-400 font-bold text-xs flex items-center gap-1.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>معاينة الصفحة العامة</span>
                </a>
                <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">
                    ← العودة للخدمات
                </a>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- 1. Basic Service Information -->
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-amber-400 flex items-center gap-2 border-b border-slate-800 pb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>البيانات الأساسية للخدمة</span>
                    </h3>

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

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Slug -->
                        <div class="space-y-1.5">
                            <label for="slug" class="block text-xs font-bold text-slate-300">الرابط الدائم (Slug)</label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug) }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm font-mono focus:border-amber-400 focus:outline-none" dir="ltr">
                        </div>

                        <!-- Badge -->
                        <div class="space-y-1.5">
                            <label for="badge" class="block text-xs font-bold text-slate-300">الوسم المميز (Badge)</label>
                            <input type="text" id="badge" name="badge" value="{{ old('badge', $service->badge) }}" placeholder="مثال: تقنية ذكية / طوارئ" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        </div>

                        <!-- Starting price -->
                        <div class="space-y-1.5">
                            <label for="price_starting_at" class="block text-xs font-bold text-slate-300">السعر التقديري</label>
                            <input type="text" id="price_starting_at" name="price_starting_at" value="{{ old('price_starting_at', $service->price_starting_at) }}" placeholder="مثال: يبدأ من 150 ر.س" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        </div>
                    </div>

                    <!-- Hero Subtitle -->
                    <div class="space-y-1.5">
                        <label for="hero_subtitle" class="block text-xs font-bold text-slate-300">العبارة الترويجية البارزة في هيدر الصفحة</label>
                        <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $service->hero_subtitle) }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <!-- Short Description -->
                    <div class="space-y-1.5">
                        <label for="short_description" class="block text-xs font-bold text-slate-300">الوصف المختصر للبطاقات <span class="text-amber-400">*</span></label>
                        <textarea id="short_description" name="short_description" rows="2" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ old('short_description', $service->short_description) }}</textarea>
                    </div>

                    <!-- Features bullet points -->
                    <div class="space-y-1.5">
                        <label for="features" class="block text-xs font-bold text-slate-300">المميزات السريعة للبطاقة (سطر لكل ميزة)</label>
                        <textarea id="features" name="features" rows="3" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : '') }}</textarea>
                    </div>
                </div>

                <!-- 2. Detailed Page Content (Overview, Headings, Notes) -->
                <div class="space-y-4 pt-4 border-t border-slate-800">
                    <h3 class="text-sm font-black text-amber-400 flex items-center gap-2 border-b border-slate-800 pb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>محتوى صفحة تفاصيل الخدمة المتكاملة</span>
                    </h3>

                    <!-- Overview Title & Content -->
                    <div class="space-y-1.5">
                        <label for="overview_title" class="block text-xs font-bold text-slate-300">عنوان قسم الشرح التفصيلي</label>
                        <input type="text" id="overview_title" name="overview_title" value="{{ old('overview_title', $service->overview_title) }}" placeholder="مثال: التكنولوجيا الحديثة في برمجة المفاتيح" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label for="overview_content" class="block text-xs font-bold text-slate-300">المحتوى والشرح التفصيلي الموسع (يدعم فقرات متعددة)</label>
                        <textarea id="overview_content" name="overview_content" rows="5" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none leading-relaxed">{{ old('overview_content', $service->overview_content) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="space-y-1.5">
                            <label for="features_title" class="block text-xs font-bold text-slate-300">عنوان قسم الخيارات / الأنواع</label>
                            <input type="text" id="features_title" name="features_title" value="{{ old('features_title', $service->features_title) }}" placeholder="مثال: أنواع المفاتيح التي نبرمجها" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        </div>

                        <div class="space-y-1.5">
                            <label for="process_title" class="block text-xs font-bold text-slate-300">عنوان قسم خطوات التنفيذ</label>
                            <input type="text" id="process_title" name="process_title" value="{{ old('process_title', $service->process_title) }}" placeholder="مثال: خطوات برمجة المفتاح" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        </div>

                        <div class="space-y-1.5">
                            <label for="pricing_title" class="block text-xs font-bold text-slate-300">عنوان جدول الأسعار</label>
                            <input type="text" id="pricing_title" name="pricing_title" value="{{ old('pricing_title', $service->pricing_title) }}" placeholder="مثال: الأسعار والعروض التقديرية" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="pricing_note" class="block text-xs font-bold text-slate-300">ملاحظة أسفل جدول الأسعار</label>
                        <input type="text" id="pricing_note" name="pricing_note" value="{{ old('pricing_note', $service->pricing_note) }}" placeholder="مثال: * الأسعار تقريبية وتعتمد على موديل السيارة..." class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <!-- 3. Dynamic Linked Elements (Sub-features, FAQs, Pricing Tiers) -->
                <div class="space-y-4 pt-4 border-t border-slate-800">
                    <h3 class="text-sm font-black text-amber-400 flex items-center justify-between border-b border-slate-800 pb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            <span>العناصر الديناميكية المرتبطة بقاعدة البيانات</span>
                        </span>
                        <span class="text-xs text-slate-400 font-normal">تُنشأ وتُدار آلياً في الجداول المنفصلة</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800/80">
                            <span class="text-xs text-slate-400 block mb-1">البطاقات الفرعية (Features):</span>
                            <span class="text-lg font-bold text-white">{{ $service->featuresList->count() }} بطاقات</span>
                            <div class="mt-2 text-xs text-slate-500">
                                @foreach($service->featuresList->take(2) as $f)
                                    <div class="truncate">• {{ $f->title }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800/80">
                            <span class="text-xs text-slate-400 block mb-1">صفوف الأسعار (Pricing Tiers):</span>
                            <span class="text-lg font-bold text-white">{{ $service->pricingTiers->count() }} صفوف</span>
                            <div class="mt-2 text-xs text-slate-500">
                                @foreach($service->pricingTiers->take(2) as $p)
                                    <div class="truncate">• {{ $p->name }} ({{ $p->price }})</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800/80">
                            <span class="text-xs text-slate-400 block mb-1">الأسئلة الشائعة (FAQ Items):</span>
                            <span class="text-lg font-bold text-white">{{ $service->faqs->count() }} أسئلة</span>
                            <div class="mt-2 text-xs text-slate-500">
                                @foreach($service->faqs->take(2) as $q)
                                    <div class="truncate">• {{ $q->question }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. SEO & Search Engine Optimization -->
                <div class="space-y-4 pt-4 border-t border-slate-800">
                    <h3 class="text-sm font-black text-amber-400 flex items-center gap-2 border-b border-slate-800 pb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>إعدادات تحسين محركات البحث (SEO Meta Tags)</span>
                    </h3>

                    <div class="space-y-1.5">
                        <label for="meta_title" class="block text-xs font-bold text-slate-300">عنوان الصفحة المخصص لجوجل (Meta Title)</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}" placeholder="مثال: برمجة مفاتيح وبصمات السيارات في جدة | مفتاح الإبداع" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label for="meta_description" class="block text-xs font-bold text-slate-300">وصف محركات البحث (Meta Description)</label>
                        <textarea id="meta_description" name="meta_description" rows="2" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none leading-relaxed">{{ old('meta_description', $service->meta_description) }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label for="meta_keywords" class="block text-xs font-bold text-slate-300">الكلمات المفتاحية (Meta Keywords)</label>
                        <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords) }}" placeholder="مثال: برمجة مفاتيح سيارات جدة, بصمة سيارة, مفتاح ذكي" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <!-- 5. Emergency & Active Toggles -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-800">
                    <x-modern-switch
                        name="is_emergency"
                        :checked="(bool)old('is_emergency', $service->is_emergency)"
                        label="خدمة طوارئ 24 ساعة"
                        subtitle="تمييزها ببطاقة طوارئ حمراء وسرعة 15-25 دقيقة"
                        color="red"
                        activeBadge="طوارئ"
                    />

                    <x-modern-switch
                        name="is_active"
                        :checked="(bool)old('is_active', $service->is_active)"
                        label="حالة الخدمة: نشطة"
                        subtitle="تظهر للزوار وفي خريطة الموقع Sitemap"
                        color="emerald"
                        activeBadge="نشطة"
                        inactiveBadge="معطلة"
                    />
                </div>

                <!-- Sort Order -->
                <div class="space-y-1.5">
                    <label for="sort_order" class="block text-xs font-bold text-slate-300">ترتيب الظهور في الموقع</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-32 bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-slate-800 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
                        إلغاء
                    </a>
                    <button type="submit" class="px-7 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs transition-colors shadow-lg shadow-amber-500/20">
                        حفظ التعديلات الشاملة
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
