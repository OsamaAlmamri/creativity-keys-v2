@php
    $isEdit = isset($service) && $service->exists;
    $featuresList = old('sub_features', $isEdit ? $service->featuresList->toArray() : []);
    $pricingTiers = old('pricing_tiers', $isEdit ? $service->pricingTiers->toArray() : []);
    $faqs = old('faqs', $isEdit ? $service->faqs->toArray() : []);
    $steps = old('steps', $isEdit && is_array($service->steps) ? $service->steps : []);
@endphp

<!-- Navigation Tabs -->
<div class="flex items-center gap-2 border-b border-slate-800 pb-4 overflow-x-auto admin-scrollbar mb-6">
    <button type="button" onclick="switchServiceTab('basic')" id="tab-btn-basic"
        class="service-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 bg-amber-500 text-white shadow-md">
        1. البيانات الأساسية والكرت
    </button>
    <button type="button" onclick="switchServiceTab('content')" id="tab-btn-content"
        class="service-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white border border-slate-800">
        2. الشرح والمحتوى الموسع
    </button>
    <button type="button" onclick="switchServiceTab('features-steps')" id="tab-btn-features-steps"
        class="service-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white border border-slate-800">
        3. البطاقات الفرعية والخطوات
    </button>
    <button type="button" onclick="switchServiceTab('pricing-faqs')" id="tab-btn-pricing-faqs"
        class="service-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white border border-slate-800">
        4. الأسعار والأسئلة الشائعة
    </button>
    <button type="button" onclick="switchServiceTab('seo')" id="tab-btn-seo"
        class="service-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all duration-200 bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white border border-slate-800">
        5. إعدادات محركات البحث (SEO)
    </button>
</div>

<!-- ==================== TAB 1: BASIC INFORMATION ==================== -->
<div id="service-tab-basic" class="service-tab-pane space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Title -->
        <div class="space-y-1.5">
            <label for="title" class="block text-xs font-bold text-slate-300">اسم أو عنوان الخدمة <span
                    class="text-amber-400">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" required
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                placeholder="مثال: برمجة مفاتيح وبصمات السيارات المشفرة" oninput="updateGooglePreview()">
        </div>

        <!-- Category -->
        <div class="space-y-1.5">
            <label for="category_id" class="block text-xs font-bold text-slate-300">صنف أو تصنيف الخدمة</label>
            <select id="category_id" name="category_id"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                <option value="">-- بدون صنف (عام) --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $service->category_id ?? '') == $category->id ? 'selected' : '' }}>
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
            <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug ?? '') }}"
                placeholder="مثال: car-keys-programming"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm font-mono focus:border-amber-400 focus:outline-none"
                dir="ltr" oninput="updateGooglePreview()">
            <span class="text-[10px] text-slate-500">اتركه فارغاً ليتم توليده آلياً من العنوان</span>
        </div>

        <!-- Badge -->
        <div class="space-y-1.5">
            <label for="badge" class="block text-xs font-bold text-slate-300">الوسم الترويجي (Badge)</label>
            <input type="text" id="badge" name="badge" value="{{ old('badge', $service->badge ?? '') }}"
                placeholder="مثال: تقنية ذكية / طوارئ سريعة"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
        </div>

        <!-- Starting price -->
        <div class="space-y-1.5">
            <label for="price_starting_at" class="block text-xs font-bold text-slate-300">السعر التقديري (يظهر في
                الكرت)</label>
            <input type="text" id="price_starting_at" name="price_starting_at"
                value="{{ old('price_starting_at', $service->price_starting_at ?? '') }}"
                placeholder="مثال: يبدأ من 150 ر.س"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Icon select -->
        <div class="space-y-1.5">
            <label for="icon" class="block text-xs font-bold text-slate-300">نوع الأيقونة</label>
            <select id="icon" name="icon"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                <option value="cpu-chip" {{ old('icon', $service->icon ?? '') === 'cpu-chip' ? 'selected' : '' }}>شريحة
                    ذكية (Smart Chip / Keyless)</option>
                <option value="car-key" {{ old('icon', $service->icon ?? '') === 'car-key' ? 'selected' : '' }}>مفتاح
                    سيارة وريموت (Car Key)</option>
                <option value="lock-open" {{ old('icon', $service->icon ?? '') === 'lock-open' ? 'selected' : '' }}>قفل
                    مفتوح طوارئ (Door Unlock)</option>
                <option value="shield-check" {{ old('icon', $service->icon ?? '') === 'shield-check' ? 'selected' : '' }}>
                    أمان وخزائن (Security / Safes)</option>
                <option value="key" {{ old('icon', $service->icon ?? '') === 'key' ? 'selected' : '' }}>مفتاح وقص ليزر
                    (Laser Cut Key)</option>
                <option value="truck" {{ old('icon', $service->icon ?? '') === 'truck' ? 'selected' : '' }}>ورشة متنقلة
                    (Mobile Workshop)</option>
            </select>
        </div>

        <!-- Sort Order -->
        <div class="space-y-1.5">
            <label for="sort_order" class="block text-xs font-bold text-slate-300">ترتيب الظهور في الموقع</label>
            <input type="number" id="sort_order" name="sort_order"
                value="{{ old('sort_order', $service->sort_order ?? 0) }}"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
        </div>
    </div>

    <!-- Short Description -->
    <div class="space-y-1.5">
        <label for="short_description" class="block text-xs font-bold text-slate-300">الوصف المختصر (يظهر في كرت الصفحة
            الرئيسية) <span class="text-amber-400">*</span></label>
        <textarea id="short_description" name="short_description" rows="3" required
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none leading-relaxed"
            placeholder="شرح موجز لا يتجاوز سطرين أو ثلاثة عن ماهية الخدمة">{{ old('short_description', $service->short_description ?? '') }}</textarea>
    </div>

    <!-- Quick Features bullet points -->
    <div class="space-y-1.5">
        <label for="features" class="block text-xs font-bold text-slate-300">النقاط السريعة للكرت (ضع كل ميزة في سطر
            جديد)</label>
        <textarea id="features" name="features" rows="4"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none font-sans"
            placeholder="قص ليزر مطابق للوكالة بدقة 100%&#10;استخراج كود السيارة السري Pin Code&#10;ضمان معتمد على دقة البرمجة">{{ old('features', isset($service) && is_array($service->features) ? implode("\n", $service->features) : '') }}</textarea>
    </div>

    <!-- Emergency & Active Toggles -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-800">
        <x-modern-switch name="is_emergency" :checked="(bool) old('is_emergency', $service->is_emergency ?? false)"
            label="خدمة طوارئ 24 ساعة" subtitle="تمييزها ببطاقة حمراء وبادج طوارئ 24/7" color="red"
            activeBadge="طوارئ" />

        <x-modern-switch name="is_active" :checked="(bool) old('is_active', $service->is_active ?? true)"
            label="حالة الخدمة: نشطة" subtitle="تظهر للزوار في الموقع وخريطة الـ Sitemap" color="emerald"
            activeBadge="نشطة" inactiveBadge="معطلة" />
    </div>
</div>

<!-- ==================== TAB 2: EXTENDED CONTENT ==================== -->
<div id="service-tab-content" class="service-tab-pane space-y-6 hidden">
    <!-- Hero Subtitle -->
    <div class="space-y-1.5">
        <label for="hero_subtitle" class="block text-xs font-bold text-slate-300">العبارة الترويجية البارزة في هيدر صفحة
            الخدمة</label>
        <input type="text" id="hero_subtitle" name="hero_subtitle"
            value="{{ old('hero_subtitle', $service->hero_subtitle ?? '') }}"
            placeholder="مثال: برمجة وتوليف أحدث مفاتيح وبصمات السيارات بأحدث أجهزة الكمبيوتر دون سحب السيارة"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
    </div>

    <!-- Overview Section Title -->
    <div class="space-y-1.5">
        <label for="overview_title" class="block text-xs font-bold text-slate-300">عنوان قسم الشرح التفصيلي</label>
        <input type="text" id="overview_title" name="overview_title"
            value="{{ old('overview_title', $service->overview_title ?? '') }}"
            placeholder="مثال: التكنولوجيا الحديثة في برمجة المفاتيح المشفرة"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
    </div>

    <!-- Overview Content -->
    <div class="space-y-1.5">
        <label for="overview_content" class="block text-xs font-bold text-slate-300">المحتوى والشرح التفصيلي الموسع
            (فقرات متعددة تثري الصفحة وتدعم الـ SEO)</label>
        <textarea id="overview_content" name="overview_content" rows="6"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none leading-relaxed"
            placeholder="اكتب شرحاً وافياً ومقنعاً عن كيفية تنفيذ الخدمة، التجهيزات المستخدمة، والمميزات التنافسية لورشة مفتاح الإبداع...">{{ old('overview_content', $service->overview_content ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-slate-800">
        <div class="space-y-1.5">
            <label for="features_title" class="block text-xs font-bold text-slate-300">عنوان قسم الخيارات
                والأنواع</label>
            <input type="text" id="features_title" name="features_title"
                value="{{ old('features_title', $service->features_title ?? '') }}"
                placeholder="مثال: أنواع المفاتيح التي نبرمجها"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
        </div>

        <div class="space-y-1.5">
            <label for="process_title" class="block text-xs font-bold text-slate-300">عنوان قسم خطوات التنفيذ</label>
            <input type="text" id="process_title" name="process_title"
                value="{{ old('process_title', $service->process_title ?? '') }}"
                placeholder="مثال: خطوات برمجة المفتاح"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
        </div>

        <div class="space-y-1.5">
            <label for="pricing_title" class="block text-xs font-bold text-slate-300">عنوان جدول الأسعار والعروض</label>
            <input type="text" id="pricing_title" name="pricing_title"
                value="{{ old('pricing_title', $service->pricing_title ?? '') }}"
                placeholder="مثال: الأسعار والعروض التقديرية"
                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
        </div>
    </div>

    <!-- Pricing Note -->
    <div class="space-y-1.5">
        <label for="pricing_note" class="block text-xs font-bold text-slate-300">ملاحظة أسفل جدول الأسعار</label>
        <input type="text" id="pricing_note" name="pricing_note"
            value="{{ old('pricing_note', $service->pricing_note ?? '') }}"
            placeholder="مثال: * الأسعار تقريبية وتعتمد على موديل السيارة ونوع الشريحة الإلكترونية."
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
    </div>
</div>

<!-- ==================== TAB 3: SUB-FEATURES & STEPS ==================== -->
<div id="service-tab-features-steps" class="service-tab-pane space-y-8 hidden">
    <!-- Sub-Features Repeater -->
    <div class="space-y-4">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>بطاقات المزايا والأنواع (Sub-Features)</span>
                </h3>
                <p class="text-xs text-slate-400">تظهر في شبكة كروت أنيقة مثل "أنواع المفاتيح"، "أسباب تعطل الريموت"، أو
                    "لماذا تختارنا"</p>
            </div>
            <button type="button" onclick="addSubFeatureRow()"
                class="px-3.5 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>إضافة بطاقة ميزة</span>
            </button>
        </div>

        <div id="sub-features-container" class="space-y-3">
            @forelse($featuresList as $idx => $feat)
                <div class="sub-feature-row p-4 rounded-2xl bg-slate-950 border border-slate-800 relative space-y-3">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs font-bold text-amber-400 row-number">بطاقة #{{ $loop->iteration }}</span>
                        <button type="button" onclick="this.closest('.sub-feature-row').remove()"
                            class="text-red-400 hover:text-red-300 text-xs font-bold p-1">
                            حذف البطاقة ✕
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <input type="text" name="sub_features[{{ $idx }}][title]" value="{{ $feat['title'] ?? '' }}"
                            placeholder="عنوان الميزة (مثال: المفاتيح الذكية)"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none font-bold">

                        <input type="text" name="sub_features[{{ $idx }}][badge]" value="{{ $feat['badge'] ?? '' }}"
                            placeholder="الوسم الفرعي (مثال: الأكثر طلباً)"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none">

                        <select name="sub_features[{{ $idx }}][icon]"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none">
                            <option value="cpu-chip" {{ ($feat['icon'] ?? '') === 'cpu-chip' ? 'selected' : '' }}>شريحة ذكية
                                (cpu-chip)</option>
                            <option value="sparkles" {{ ($feat['icon'] ?? '') === 'sparkles' ? 'selected' : '' }}>بريق ولمعان
                                (sparkles)</option>
                            <option value="shield-check" {{ ($feat['icon'] ?? '') === 'shield-check' ? 'selected' : '' }}>درع
                                أمان (shield-check)</option>
                            <option value="lock-open" {{ ($feat['icon'] ?? '') === 'lock-open' ? 'selected' : '' }}>قفل مفتوح
                                (lock-open)</option>
                            <option value="battery" {{ ($feat['icon'] ?? '') === 'battery' ? 'selected' : '' }}>بطارية
                                (battery)</option>
                            <option value="wrench" {{ ($feat['icon'] ?? '') === 'wrench' ? 'selected' : '' }}>مفتاح صيانة
                                (wrench)</option>
                            <option value="clock" {{ ($feat['icon'] ?? '') === 'clock' ? 'selected' : '' }}>ساعة وسرعة (clock)
                            </option>
                            <option value="key" {{ ($feat['icon'] ?? '') === 'key' ? 'selected' : '' }}>مفتاح (key)</option>
                        </select>
                    </div>

                    <textarea name="sub_features[{{ $idx }}][description]" rows="2"
                        placeholder="شرح موجز للميزة وتأثيرها للعميل..."
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-amber-400 focus:outline-none leading-relaxed">{{ $feat['description'] ?? '' }}</textarea>
                </div>
            @empty
                <!-- Default empty message / placeholder -->
                <div id="no-sub-features-hint"
                    class="text-center py-6 text-slate-500 text-xs border border-dashed border-slate-800 rounded-2xl">
                    لا توجد بطاقات فرعية مضافة حتى الآن. اضغط "إضافة بطاقة ميزة" لإضافة كروت تفاعلية لصفحة الخدمة.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Work Process Steps Repeater -->
    <div class="space-y-4 pt-6 border-t border-slate-800">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>خطوات تنفيذ الخدمة (Work Process Steps)</span>
                </h3>
                <p class="text-xs text-slate-400">تظهر للعميل لتبسيط الخطوات وطمأنته حول سرعة واحترافية الإنجاز</p>
            </div>
            <button type="button" onclick="addStepRow()"
                class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>إضافة خطوة عمل</span>
            </button>
        </div>

        <div id="steps-container" class="space-y-3">
            @forelse($steps as $idx => $st)
                <div class="step-row p-4 rounded-2xl bg-slate-950 border border-slate-800 relative space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs font-bold text-emerald-400 step-number">الخطوة
                            {{ $st['step'] ?? ($idx + 1) }}</span>
                        <button type="button" onclick="this.closest('.step-row').remove(); reindexSteps();"
                            class="text-red-400 hover:text-red-300 text-xs font-bold p-1">
                            حذف الخطوة ✕
                        </button>
                    </div>

                    <input type="text" name="steps[{{ $idx }}][title]" value="{{ $st['title'] ?? '' }}"
                        placeholder="عنوان الخطوة (مثال: فحص النظام / الوصول السريع)"
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-emerald-400 focus:outline-none font-bold">

                    <textarea name="steps[{{ $idx }}][desc]" rows="2" placeholder="شرح الخطوة بإيجاز..."
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-emerald-400 focus:outline-none leading-relaxed">{{ $st['desc'] ?? '' }}</textarea>
                </div>
            @empty
                <div id="no-steps-hint"
                    class="text-center py-6 text-slate-500 text-xs border border-dashed border-slate-800 rounded-2xl">
                    لا توجد خطوات عمل مضافة. اضغط "إضافة خطوة عمل" لترتيب مراحل تقديم الخدمة.
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- ==================== TAB 4: PRICING TIERS & FAQS ==================== -->
<div id="service-tab-pricing-faqs" class="service-tab-pane space-y-8 hidden">
    <!-- Pricing Tiers Table Repeater -->
    <div class="space-y-4">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>صفوف جدول الأسعار والعروض (Pricing Tiers)</span>
                </h3>
                <p class="text-xs text-slate-400">تظهر في جدول الأسعار الشفاف في صفحة الخدمة</p>
            </div>
            <button type="button" onclick="addPricingRow()"
                class="px-3.5 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>إضافة صف سعر</span>
            </button>
        </div>

        <div id="pricing-container" class="space-y-3">
            @forelse($pricingTiers as $idx => $tier)
                <div
                    class="pricing-row p-4 rounded-2xl bg-slate-950 border border-slate-800 flex flex-col sm:flex-row items-center gap-3">
                    <div class="flex-1 w-full space-y-1">
                        <label class="text-[10px] text-slate-400">نوع الخدمة / موديل السيارة</label>
                        <input type="text" name="pricing_tiers[{{ $idx }}][name]" value="{{ $tier['name'] ?? '' }}"
                            placeholder="مثال: برمجة مفتاح ذكي (بصمة Smart Key)"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none font-bold">
                    </div>

                    <div class="w-full sm:w-44 space-y-1">
                        <label class="text-[10px] text-slate-400">السعر التقديري</label>
                        <input type="text" name="pricing_tiers[{{ $idx }}][price]" value="{{ $tier['price'] ?? '' }}"
                            placeholder="مثال: يبدأ من 250 ر.س"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs font-mono focus:border-amber-400 focus:outline-none font-bold text-[#588157]">
                    </div>

                    <div class="flex-1 w-full space-y-1">
                        <label class="text-[10px] text-slate-400">ملاحظة إضافية (اختياري)</label>
                        <input type="text" name="pricing_tiers[{{ $idx }}][note]" value="{{ $tier['note'] ?? '' }}"
                            placeholder="مثال: شامل فحص الكمبيوتر وبرمجة الشريحة"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none">
                    </div>

                    <button type="button" onclick="this.closest('.pricing-row').remove()"
                        class="text-red-400 hover:text-red-300 text-xs font-bold p-2 mt-4 sm:mt-5 self-end sm:self-center">
                        ✕
                    </button>
                </div>
            @empty
                <div id="no-pricing-hint"
                    class="text-center py-6 text-slate-500 text-xs border border-dashed border-slate-800 rounded-2xl">
                    لا توجد صفوف أسعار مضافة. اضغط "إضافة صف سعر" لعرض جدول شفاف بالأسعار التقديرية.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Frequently Asked Questions (FAQs) Repeater -->
    <div class="space-y-4 pt-6 border-t border-slate-800">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <span>الأسئلة الشائعة الخاصة بالخدمة (FAQ Items)</span>
                </h3>
                <p class="text-xs text-slate-400">تظهر في أكورديون تفاعلي وتولد كود Schema.org FAQPage لمحركات البحث
                    تلقائياً</p>
            </div>
            <button type="button" onclick="addFaqRow()"
                class="px-3.5 py-1.5 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>إضافة سؤال شائع</span>
            </button>
        </div>

        <div id="faqs-container" class="space-y-3">
            @forelse($faqs as $idx => $q)
                <div class="faq-row p-4 rounded-2xl bg-slate-950 border border-slate-800 relative space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-xs font-bold text-cyan-400">سؤال #{{ $loop->iteration }}</span>
                        <button type="button" onclick="this.closest('.faq-row').remove()"
                            class="text-red-400 hover:text-red-300 text-xs font-bold p-1">
                            حذف السؤال ✕
                        </button>
                    </div>

                    <input type="text" name="faqs[{{ $idx }}][question]" value="{{ $q['question'] ?? '' }}"
                        placeholder="نص السؤال (مثال: هل سيتم كسر زجاج السيارة لفتحها؟)"
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-cyan-400 focus:outline-none font-bold">

                    <textarea name="faqs[{{ $idx }}][answer]" rows="2" placeholder="الإجابة الشافية والمعتمدة..."
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-cyan-400 focus:outline-none leading-relaxed">{{ $q['answer'] ?? '' }}</textarea>
                </div>
            @empty
                <div id="no-faqs-hint"
                    class="text-center py-6 text-slate-500 text-xs border border-dashed border-slate-800 rounded-2xl">
                    لا توجد أسئلة شائعة مضافة. اضغط "إضافة سؤال شائع" لرفع تصنيف الصفحة في جوجل ومساعدة العملاء.
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- ==================== TAB 5: SEO META TAGS ==================== -->
<div id="service-tab-seo" class="service-tab-pane space-y-6 hidden">
    <!-- Meta Title -->
    <div class="space-y-1.5">
        <div class="flex items-center justify-between">
            <label for="meta_title" class="block text-xs font-bold text-slate-300">عنوان الصفحة المخصص لمحركات البحث
                (Meta Title)</label>
            <span id="meta_title_count" class="text-[11px] text-slate-500">0 / 60 حرف</span>
        </div>
        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $service->meta_title ?? '') }}"
            placeholder="مثال: برمجة مفاتيح وبصمات السيارات في جدة | مفتاح الإبداع"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
            oninput="updateGooglePreview()">
        <span class="text-[10px] text-slate-500">العنوان المثالي يفضل أن يتراوح بين 45 و 60 حرفاً ويحتوي على الكلمة
            المفتاحية واسم المدينة.</span>
    </div>

    <!-- Meta Description -->
    <div class="space-y-1.5">
        <div class="flex items-center justify-between">
            <label for="meta_description" class="block text-xs font-bold text-slate-300">وصف محركات البحث (Meta
                Description)</label>
            <span id="meta_description_count" class="text-[11px] text-slate-500">0 / 160 حرف</span>
        </div>
        <textarea id="meta_description" name="meta_description" rows="3"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none leading-relaxed"
            placeholder="أفضل محل لبرمجة ونسخ مفاتيح وبصمات السيارات في جدة. فنيون متخصصون وأجهزة كمبيوتر ليزرية متطورة بالموقع..."
            oninput="updateGooglePreview()">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
        <span class="text-[10px] text-slate-500">الوصف المثالي يتراوح بين 120 و 155 حرفاً ويحفز الباحث على النقر.</span>
    </div>

    <!-- Meta Keywords -->
    <div class="space-y-1.5">
        <label for="meta_keywords" class="block text-xs font-bold text-slate-300">الكلمات المفتاحية (Meta Keywords -
            مفصولة بفواصل)</label>
        <input type="text" id="meta_keywords" name="meta_keywords"
            value="{{ old('meta_keywords', $service->meta_keywords ?? '') }}"
            placeholder="مثال: برمجة مفاتيح سيارات جدة, بصمة سيارة, مفتاح ذكي, فتح سيارات مقفلة"
            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
    </div>

    <!-- Google SERP Live Snippet Preview Box -->
    <div class="mt-8 p-6 rounded-2xl bg-slate-950 border border-slate-800 space-y-3">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 mb-2">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span>معاينة حية لشكل ظهور الصفحة في نتائج بحث Google (Google SERP Preview):</span>
        </div>

        <div class="p-4 rounded-xl bg-[#202124] text-right font-sans text-sm space-y-1 shadow-inner border border-slate-800"
            dir="ltr">
            <div class="text-[12px] text-[#dadce0] truncate flex items-center gap-1.5">
                <span
                    class="w-4 h-4 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-[9px]">K</span>
                <span>https://creativity-keys.com › services › <span
                        id="serp-slug-preview">{{ $service->slug ?? 'car-keys-programming' }}</span></span>
            </div>
            <h4 id="serp-title-preview"
                class="text-[#8ab4f8] text-base hover:underline cursor-pointer font-medium truncate" dir="rtl">
                {{ $service->meta_title ?? ($service->title ?? 'عنوان الخدمة في نتائج البحث') }} | مفتاح الإبداع
            </h4>
            <p id="serp-desc-preview" class="text-[#bdc1c6] text-xs leading-relaxed line-clamp-2" dir="rtl">
                {{ $service->meta_description ?? ($service->short_description ?? 'وصف الخدمة ومميزاتها سيظهر هنا لجذب العملاء في نتائج البحث...') }}
            </p>
        </div>
    </div>
</div>

<!-- ==================== SUBMISSION ACTIONS ==================== -->
<div class="pt-6 border-t border-slate-800 flex items-center justify-between">
    <div class="text-xs text-slate-500">
        تأكد من مراجعة التبويبات قبل الحفظ النهائي
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.services.index') }}"
            class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-750 text-white font-bold text-xs transition-colors">
            إلغاء
        </a>
        <button type="submit"
            class="px-7 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-black text-xs transition-colors shadow-lg shadow-amber-500/20 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ $isEdit ? 'حفظ التعديلات الشاملة' : 'حفظ ونشر الخدمة الجديدة' }}</span>
        </button>
    </div>
</div>

<!-- ==================== DYNAMIC REPEATER SCRIPTS ==================== -->
<script>
    let subFeatureCount = {{ count($featuresList) + 10 }};
    let stepCount = {{ count($steps) + 10 }};
    let pricingCount = {{ count($pricingTiers) + 10 }};
    let faqCount = {{ count($faqs) + 10 }};

    function switchServiceTab(tabName) {
        document.querySelectorAll('.service-tab-pane').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.service-tab-btn').forEach(btn => {
            btn.classList.remove('bg-amber-500', 'text-white', 'shadow-md');
            btn.classList.add('bg-slate-900', 'text-slate-400', 'border', 'border-slate-800');
        });

        const activePane = document.getElementById('service-tab-' + tabName);
        const activeBtn = document.getElementById('tab-btn-' + tabName);
        if (activePane) activePane.classList.remove('hidden');
        if (activeBtn) {
            activeBtn.classList.remove('bg-slate-900', 'text-slate-400', 'border', 'border-slate-800');
            activeBtn.classList.add('bg-amber-500', 'text-white', 'shadow-md');
        }
    }

    function addSubFeatureRow() {
        const hint = document.getElementById('no-sub-features-hint');
        if (hint) hint.remove();

        const container = document.getElementById('sub-features-container');
        const idx = subFeatureCount++;
        const row = document.createElement('div');
        row.className = 'sub-feature-row p-4 rounded-2xl bg-slate-950 border border-slate-800 relative space-y-3';
        row.innerHTML = `
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-bold text-amber-400">بطاقة جديدة</span>
                <button type="button" onclick="this.closest('.sub-feature-row').remove()" class="text-red-400 hover:text-red-300 text-xs font-bold p-1">
                    حذف البطاقة ✕
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <input type="text" name="sub_features[${idx}][title]" placeholder="عنوان الميزة (مثال: المفاتيح الذكية)" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none font-bold" required>
                <input type="text" name="sub_features[${idx}][badge]" placeholder="الوسم الفرعي (مثال: الأكثر طلباً)" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none">
                <select name="sub_features[${idx}][icon]" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none">
                    <option value="cpu-chip">شريحة ذكية (cpu-chip)</option>
                    <option value="sparkles">بريق ولمعان (sparkles)</option>
                    <option value="shield-check">درع أمان (shield-check)</option>
                    <option value="lock-open">قفل مفتوح (lock-open)</option>
                    <option value="battery">بطارية (battery)</option>
                    <option value="wrench">مفتاح صيانة (wrench)</option>
                    <option value="clock">ساعة وسرعة (clock)</option>
                    <option value="key">مفتاح (key)</option>
                </select>
            </div>
            <textarea name="sub_features[${idx}][description]" rows="2" placeholder="شرح موجز للميزة وتأثيرها للعميل..." class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-amber-400 focus:outline-none leading-relaxed"></textarea>
        `;
        container.appendChild(row);
    }

    function addStepRow() {
        const hint = document.getElementById('no-steps-hint');
        if (hint) hint.remove();

        const container = document.getElementById('steps-container');
        const idx = stepCount++;
        const currentCount = container.querySelectorAll('.step-row').length + 1;
        const row = document.createElement('div');
        row.className = 'step-row p-4 rounded-2xl bg-slate-950 border border-slate-800 relative space-y-2';
        row.innerHTML = `
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-bold text-emerald-400 step-number">الخطوة ${currentCount}</span>
                <button type="button" onclick="this.closest('.step-row').remove(); reindexSteps();" class="text-red-400 hover:text-red-300 text-xs font-bold p-1">
                    حذف الخطوة ✕
                </button>
            </div>
            <input type="text" name="steps[${idx}][title]" placeholder="عنوان الخطوة (مثال: فحص النظام / استخراج الكود السري)" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-emerald-400 focus:outline-none font-bold" required>
            <textarea name="steps[${idx}][desc]" rows="2" placeholder="شرح تفاصيل هذه الخطوة..." class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-emerald-400 focus:outline-none leading-relaxed"></textarea>
        `;
        container.appendChild(row);
    }

    function reindexSteps() {
        const rows = document.querySelectorAll('.step-row');
        rows.forEach((r, i) => {
            const badge = r.querySelector('.step-number');
            if (badge) badge.innerText = 'الخطوة ' + (i + 1);
        });
    }

    function addPricingRow() {
        const hint = document.getElementById('no-pricing-hint');
        if (hint) hint.remove();

        const container = document.getElementById('pricing-container');
        const idx = pricingCount++;
        const row = document.createElement('div');
        row.className = 'pricing-row p-4 rounded-2xl bg-slate-950 border border-slate-800 flex flex-col sm:flex-row items-center gap-3';
        row.innerHTML = `
            <div class="flex-1 w-full space-y-1">
                <label class="text-[10px] text-slate-400">نوع الخدمة / موديل السيارة</label>
                <input type="text" name="pricing_tiers[${idx}][name]" placeholder="مثال: برمجة مفتاح ذكي (بصمة Smart Key)" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none font-bold" required>
            </div>
            <div class="w-full sm:w-44 space-y-1">
                <label class="text-[10px] text-slate-400">السعر التقديري</label>
                <input type="text" name="pricing_tiers[${idx}][price]" placeholder="مثال: يبدأ من 250 ر.س" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs font-mono focus:border-amber-400 focus:outline-none font-bold text-[#588157]">
            </div>
            <div class="flex-1 w-full space-y-1">
                <label class="text-[10px] text-slate-400">ملاحظة إضافية (اختياري)</label>
                <input type="text" name="pricing_tiers[${idx}][note]" placeholder="مثال: شامل البرمجة وقص سن الطوارئ" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-amber-400 focus:outline-none">
            </div>
            <button type="button" onclick="this.closest('.pricing-row').remove()" class="text-red-400 hover:text-red-300 text-xs font-bold p-2 mt-4 sm:mt-5 self-end sm:self-center">
                ✕
            </button>
        `;
        container.appendChild(row);
    }

    function addFaqRow() {
        const hint = document.getElementById('no-faqs-hint');
        if (hint) hint.remove();

        const container = document.getElementById('faqs-container');
        const idx = faqCount++;
        const currentCount = container.querySelectorAll('.faq-row').length + 1;
        const row = document.createElement('div');
        row.className = 'faq-row p-4 rounded-2xl bg-slate-950 border border-slate-800 relative space-y-2';
        row.innerHTML = `
            <div class="flex items-center justify-between gap-3">
                <span class="text-xs font-bold text-cyan-400">سؤال جديد #${currentCount}</span>
                <button type="button" onclick="this.closest('.faq-row').remove()" class="text-red-400 hover:text-red-300 text-xs font-bold p-1">
                    حذف السؤال ✕
                </button>
            </div>
            <input type="text" name="faqs[${idx}][question]" placeholder="نص السؤال (مثال: كم يستغرق وقت وصول الفني؟)" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-white text-xs focus:border-cyan-400 focus:outline-none font-bold" required>
            <textarea name="faqs[${idx}][answer]" rows="2" placeholder="الإجابة الشافية والمعتمدة..." class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-white text-xs focus:border-cyan-400 focus:outline-none leading-relaxed" required></textarea>
        `;
        container.appendChild(row);
    }

    function updateGooglePreview() {
        const titleInput = document.getElementById('meta_title');
        const mainTitleInput = document.getElementById('title');
        const descInput = document.getElementById('meta_description');
        const shortDescInput = document.getElementById('short_description');
        const slugInput = document.getElementById('slug');

        const titleText = (titleInput && titleInput.value.trim()) || (mainTitleInput && mainTitleInput.value.trim()) || 'عنوان الخدمة في نتائج البحث';
        const descText = (descInput && descInput.value.trim()) || (shortDescInput && shortDescInput.value.trim()) || 'وصف الخدمة ومميزاتها سيظهر هنا لجذب العملاء في نتائج البحث...';
        const slugText = (slugInput && slugInput.value.trim()) || 'service-slug';

        const serpTitle = document.getElementById('serp-title-preview');
        const serpDesc = document.getElementById('serp-desc-preview');
        const serpSlug = document.getElementById('serp-slug-preview');

        if (serpTitle) serpTitle.innerText = titleText + ' | مفتاح الإبداع';
        if (serpDesc) serpDesc.innerText = descText;
        if (serpSlug) serpSlug.innerText = slugText;

        const titleCounter = document.getElementById('meta_title_count');
        const descCounter = document.getElementById('meta_description_count');
        if (titleCounter && titleInput) titleCounter.innerText = titleInput.value.length + ' / 60 حرف';
        if (descCounter && descInput) descCounter.innerText = descInput.value.length + ' / 160 حرف';
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateGooglePreview();
    });
</script>