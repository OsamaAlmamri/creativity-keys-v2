<section id="contact" class="py-24 contact-section px-5 sm:px-8 border-t border-slate-200/80 dark:border-slate-800 relative">
    <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-center">
        
        <!-- Right Column in RTL: Contact Information & Quick Channels -->
        <div>
            <p class="section-kicker">تواصل معنا</p>
            <h2 class="mt-4 max-w-2xl text-4xl font-semibold leading-tight tracking-[-0.03em] sm:text-5xl text-slate-900 dark:text-white">
                أرسل طلبك أو استفسارك — نحن هنا لخدمتك دائماً.
            </h2>
            <p class="mt-6 max-w-xl text-base leading-8 text-slate-600 dark:text-slate-400">
                سواء كنت بحاجة لخدمة طارئة، استفسار عن أسعار، أو استشارة لقص وبرمجة مفاتيح سيارتك، لا تتردد في مراسلتنا وسنقوم بالرد عليك في أسرع وقت.
            </p>

            <!-- 2x2 Mini-Grid of Glass Info Cards -->
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                
                <!-- Phone Card -->
                <a 
                    href="tel:{{ $settings['emergency_phone'] ?? '0568191921' }}" 
                    class="glass-panel flex items-center gap-4 rounded-2xl p-4 transition-all duration-300 hover:border-[#588157]"
                >
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#C0CFB2]/40 text-[#588157] dark:bg-slate-800 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </span>
                    <span class="min-w-0">
                        <span class="block text-xs font-bold uppercase tracking-widest text-slate-900 dark:text-white">اتصل بنا</span>
                        <span class="block text-sm text-slate-600 dark:text-slate-300 font-mono" dir="ltr">
                            {{ $settings['emergency_phone'] ?? '0568191921' }}
                        </span>
                    </span>
                </a>

                <!-- WhatsApp Card -->
                <a 
                    href="https://wa.me/{{ $settings['whatsapp'] ?? '966568191921' }}?text={{ urlencode('مرحباً، أود الاستفسار عن خدمات مفاتيح الإبداع') }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="glass-panel flex items-center gap-4 rounded-2xl p-4 transition-all duration-300 hover:border-[#588157]"
                >
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#C0CFB2]/40 text-[#588157] dark:bg-slate-800 dark:text-emerald-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </span>
                    <span class="min-w-0">
                        <span class="block text-xs font-bold uppercase tracking-widest text-slate-900 dark:text-white">محادثة واتساب</span>
                        <span class="block text-sm text-slate-600 dark:text-slate-300">تواصل سريع ومباشر</span>
                    </span>
                </a>

                <!-- Working Hours Card -->
                <div class="glass-panel flex items-center gap-4 rounded-2xl p-4">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#C0CFB2]/40 text-[#588157] dark:bg-slate-800 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="min-w-0">
                        <span class="block text-xs font-bold uppercase tracking-widest text-slate-900 dark:text-white">ساعات العمل</span>
                        <span class="block text-sm text-slate-600 dark:text-slate-300">{{ $settings['working_hours'] ?? 'يومياً من 9 صباحاً حتى 11 مساءً' }}</span>
                    </span>
                </div>

                <!-- Mobile Workshop Card -->
                <div class="glass-panel flex items-center gap-4 rounded-2xl p-4">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#C0CFB2]/40 text-[#588157] dark:bg-slate-800 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                    </span>
                    <span class="min-w-0">
                        <span class="block text-xs font-bold uppercase tracking-widest text-slate-900 dark:text-white">خدمة متنقلة</span>
                        <span class="block text-sm text-slate-600 dark:text-slate-300">نصل إليك في كافة أحياء {{ $cityName }}</span>
                    </span>
                </div>

            </div>
        </div>

        <!-- Left Column in RTL: Contact Form in Rounded Glass Panel -->
        <div class="glass-panel rounded-[2.2rem] p-6 sm:p-8 shadow-md">
            
            @if($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-600 dark:text-red-400 text-sm">
                    <div class="font-bold mb-1">يرجى مراجعة وتصحيح الحقول التالية:</div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            الاسم الكريم <span class="text-[#588157] dark:text-emerald-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            placeholder="اسمك الكريم" 
                            class="w-full rounded-full border border-slate-300/80 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 px-5 py-3 text-slate-900 dark:text-white placeholder-slate-400 focus:border-[#588157] focus:outline-none focus:ring-1 focus:ring-[#588157] text-sm"
                        >
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            رقم الجوال <span class="text-[#588157] dark:text-emerald-400">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone') }}" 
                            required 
                            dir="ltr" 
                            placeholder="05XXXXXXXX" 
                            class="w-full rounded-full border border-slate-300/80 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 px-5 py-3 text-slate-900 dark:text-white placeholder-slate-400 focus:border-[#588157] focus:outline-none focus:ring-1 focus:ring-[#588157] text-sm text-right font-mono"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Service Needed -->
                    <div>
                        <label for="service_needed" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            نوع الخدمة
                        </label>
                        <select 
                            id="service_needed" 
                            name="service_needed" 
                            class="w-full rounded-full border border-slate-300/80 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 px-5 py-3 text-slate-900 dark:text-white focus:border-[#588157] focus:outline-none focus:ring-1 focus:ring-[#588157] text-sm"
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
                    <div>
                        <label for="city_district" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                            الحي في {{ $cityName }}
                        </label>
                        <input 
                            type="text" 
                            id="city_district" 
                            name="city_district" 
                            value="{{ old('city_district') }}" 
                            placeholder="مثال: حي الروضة / الشاطئ / أبحر" 
                            class="w-full rounded-full border border-slate-300/80 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 px-5 py-3 text-slate-900 dark:text-white placeholder-slate-400 focus:border-[#588157] focus:outline-none focus:ring-1 focus:ring-[#588157] text-sm"
                        >
                    </div>
                </div>

                <!-- Emergency checkbox -->
                <div class="p-3.5 rounded-2xl bg-[#C0CFB2]/20 dark:bg-slate-800/60 border border-[#588157]/20 flex items-center gap-3">
                    <input 
                        type="checkbox" 
                        id="is_emergency" 
                        name="is_emergency" 
                        value="1" 
                        {{ old('is_emergency') ? 'checked' : '' }} 
                        class="w-4 h-4 rounded border-slate-300 text-[#588157] focus:ring-[#588157]"
                    >
                    <label for="is_emergency" class="text-xs sm:text-sm font-semibold text-slate-800 dark:text-slate-200 cursor-pointer">
                        حالة طوارئ مستعجلة (عالق خارج السيارة / المنزل وأحتاج فني بأسرع وقت)
                    </label>
                </div>

                <!-- Message Body -->
                <div>
                    <label for="message" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                        تفاصيل الطلب <span class="text-[#588157] dark:text-emerald-400">*</span>
                    </label>
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="3" 
                        required 
                        placeholder="اكتب نوع السيارة والموديل أو تفاصيل طلبك بدقة..." 
                        class="w-full rounded-3xl border border-slate-300/80 dark:border-slate-700 bg-white/70 dark:bg-slate-900/70 p-4 text-slate-900 dark:text-white placeholder-slate-400 focus:border-[#588157] focus:outline-none focus:ring-1 focus:ring-[#588157] text-sm leading-relaxed"
                    >{{ old('message') }}</textarea>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full min-h-12 py-3 px-8 rounded-full bg-[#C0CFB2] hover:bg-[#A5BA95] dark:bg-[#588157] dark:hover:bg-[#4A6B53] text-[#1F2E23] dark:text-white font-bold text-sm sm:text-base shadow-sm transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    <span>إرسال الطلب</span>
                </button>
            </form>

        </div>

    </div>
</section>
