<section id="contact" class="py-24 bg-slate-950 relative border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header Matching Reference Style -->
        <div class="max-w-3xl mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold mb-3">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                تواصل معنا
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                أرسل طلبك أو استفسارك — نحن هنا لخدمتك دائماً.
            </h2>
            <p class="mt-4 text-slate-400 text-base leading-relaxed">
                سواء كنت بحاجة لخدمة طارئة، استفسار عن أسعار، أو استشارة لقص وبرمجة مفاتيح سيارتك، لا تتردد في مراسلتنا وسنقوم بالرد عليك في أسرع وقت.
            </p>
        </div>

        <!-- 2-Column Grid: Quick Contact Channels & Form -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Quick Contact Channels (5 Cols in RTL) -->
            <div class="lg:col-span-5 space-y-4">
                
                <!-- Call Direct Card -->
                <a 
                    href="tel:{{ $settings['emergency_phone'] ?? '0559998877' }}" 
                    class="group flex items-center gap-4 p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-amber-400/50 transition-all duration-300"
                >
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0 group-hover:bg-amber-500 group-hover:text-slate-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-amber-400 uppercase tracking-wider mb-0.5">اتصل بنا مباشرة</span>
                        <span class="block text-base sm:text-lg font-black text-white font-mono group-hover:text-amber-400 transition-colors" dir="ltr">
                            {{ $settings['emergency_phone'] ?? '055 999 8877' }}
                        </span>
                    </div>
                </a>

                <!-- WhatsApp Direct Card -->
                <a 
                    href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('مرحباً، أود الاستفسار عن خدمات مفاتيح الإبداع') }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="group flex items-center gap-4 p-5 rounded-2xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 transition-all duration-300"
                >
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-0.5">واتساب فوري ومباشر</span>
                        <span class="block text-sm font-bold text-white group-hover:text-emerald-300 transition-colors">
                            تواصل فوري ومباشر مع الفني
                        </span>
                    </div>
                </a>

                <!-- Working Hours Card -->
                <div class="flex items-center gap-4 p-5 rounded-2xl bg-slate-900 border border-slate-800">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">ساعات العمل في المعرض</span>
                        <span class="block text-sm font-semibold text-white">
                            {{ $settings['working_hours'] ?? 'يومياً من 9:00 ص حتى 11:00 م' }}
                        </span>
                    </div>
                </div>

                <!-- 24/7 Mobile Workshop -->
                <div class="flex items-center gap-4 p-5 rounded-2xl bg-slate-900 border border-slate-800">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">خدمة متنقلة 24 ساعة</span>
                        <span class="block text-sm font-semibold text-white">
                            نصلك أينما كنت في كافة أحياء جدة وأبحر
                        </span>
                    </div>
                </div>

            </div>

            <!-- Form Card (7 Cols in RTL) -->
            <div class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl">
                
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                        <div class="font-bold mb-1">يرجى مراجعة وتصحيح الحقول التالية:</div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-xs font-bold text-slate-300">
                                الاسم الكريم <span class="text-amber-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="مثال: محمد العمري" 
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm"
                            >
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone" class="block text-xs font-bold text-slate-300">
                                رقم الجوال <span class="text-amber-400">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}" 
                                required 
                                dir="ltr" 
                                placeholder="05XXXXXXXX" 
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm text-right"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Service Needed -->
                        <div class="space-y-2">
                            <label for="service_needed" class="block text-xs font-bold text-slate-300">
                                نوع الخدمة
                            </label>
                            <select 
                                id="service_needed" 
                                name="service_needed" 
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm"
                            >
                                <option value="">اختر الخدمة المطلوبة...</option>
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
                            <label for="city_district" class="block text-xs font-bold text-slate-300">
                                الحي في {{ $cityName }}
                            </label>
                            <input 
                                type="text" 
                                id="city_district" 
                                name="city_district" 
                                value="{{ old('city_district') }}" 
                                placeholder="مثال: حي الروضة / الشاطئ" 
                                class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm"
                            >
                        </div>
                    </div>

                    <!-- Emergency checkbox -->
                    <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center gap-3">
                        <input 
                            type="checkbox" 
                            id="is_emergency" 
                            name="is_emergency" 
                            value="1" 
                            {{ old('is_emergency') ? 'checked' : '' }} 
                            class="w-4 h-4 rounded border-slate-700 text-amber-500 focus:ring-amber-400 bg-slate-950"
                        >
                        <label for="is_emergency" class="text-xs sm:text-sm font-bold text-amber-300 cursor-pointer">
                            حالة طوارئ مستعجلة (عالق خارج السيارة / المنزل وأحتاج فني بأسرع وقت)
                        </label>
                    </div>

                    <!-- Message Body -->
                    <div class="space-y-2">
                        <label for="message" class="block text-xs font-bold text-slate-300">
                            تفاصيل الطلب <span class="text-amber-400">*</span>
                        </label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="3" 
                            required 
                            placeholder="اكتب نوع السيارة والموديل أو تفاصيل طلبك بدقة..." 
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm leading-relaxed"
                        >{{ old('message') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-6 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm transition-all shadow-lg shadow-amber-500/20 hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <span>إرسال الطلب الآن</span>
                    </button>
                </form>

            </div>

        </div>

    </div>
</section>
