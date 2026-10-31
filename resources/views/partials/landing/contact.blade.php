<section id="contact" class="py-24 bg-slate-950 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center space-y-4 mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                تواصل معنا مباشرة
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white">
                أرسل طلبك أو استفسارك
            </h2>
            <p class="text-slate-400 text-base">
                املأ النموذج التالي وسيقوم الفني المناسب بالتواصل معك فوراً خلال دقائق معدودة.
            </p>
        </div>

        <!-- Form Card -->
        <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-10 shadow-2xl">
            
            @if($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                    <div class="font-bold mb-1">يرجى تصحيح الأخطاء التالية:</div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-bold text-slate-200">
                            الاسم الكريم <span class="text-amber-400">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="مثال: فهد الدوسري" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm">
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-bold text-slate-200">
                            رقم الجوال <span class="text-amber-400">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required dir="ltr" placeholder="05XXXXXXXX" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm text-right">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Service Needed -->
                    <div class="space-y-2">
                        <label for="service_needed" class="block text-sm font-bold text-slate-200">
                            نوع الخدمة المطلوبة
                        </label>
                        <select id="service_needed" name="service_needed" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm">
                            <option value="">اختر الخدمة...</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc->title }}" {{ old('service_needed') === $svc->title ? 'selected' : '' }}>
                                    {{ $svc->title }}
                                </option>
                            @endforeach
                            <option value="خدمة أخرى">أخرى / استفسار عام</option>
                        </select>
                    </div>

                    <!-- City District -->
                    <div class="space-y-2">
                        <label for="city_district" class="block text-sm font-bold text-slate-200">
                            الحي / المنطقة في {{ $cityName }}
                        </label>
                        <input type="text" id="city_district" name="city_district" value="{{ old('city_district') }}" placeholder="مثال: حي النرجس / حي العليا" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm">
                    </div>
                </div>

                <!-- Emergency checkbox -->
                <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center gap-3">
                    <input type="checkbox" id="is_emergency" name="is_emergency" value="1" {{ old('is_emergency') ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-700 text-amber-500 focus:ring-amber-400 bg-slate-950">
                    <label for="is_emergency" class="text-sm font-bold text-amber-300 cursor-pointer">
                        حالة طوارئ مستعجلة (أنا عالق خارج المنزل / السيارة الآن وأحتاج فني بأسرع وقت)
                    </label>
                </div>

                <!-- Message Body -->
                <div class="space-y-2">
                    <label for="message" class="block text-sm font-bold text-slate-200">
                        تفاصيل المشكلة أو الاستفسار <span class="text-amber-400">*</span>
                    </label>
                    <textarea id="message" name="message" rows="4" required placeholder="اكتب نوع السيارة والموديل أو نوع القفل المطلوب فتحه أو تفاصيل طلبك..." class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm leading-relaxed">{{ old('message') }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-base transition-all shadow-xl shadow-amber-500/20 hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    <span>إرسال الطلب الآن</span>
                </button>
            </form>

        </div>

    </div>
</section>
