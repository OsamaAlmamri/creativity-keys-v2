<section id="location" class="py-24 bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Location Info (Right in RTL) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    مقرنا الجغرافي
                </div>

                <h2 class="text-3xl sm:text-4xl font-black text-white">
                    موقع المحل وساعات العمل
                </h2>

                <p class="text-slate-300 text-base leading-relaxed">
                    تفضل بزيارة مركزنا ومعرضنا الرئيسي لتجربة الأقفال الذكية ونسخ المفاتيح الفورية، أو اطلب ورشة الطوارئ لتصلك مباشرة إلى موقعك في أي حي من أحياء {{ $cityName }}.
                </p>

                <!-- Info Cards -->
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white mb-0.5">العنوان</h4>
                            <p class="text-xs text-slate-400">{{ $settings['address'] ?? ($cityName . ' - المركز الرئيسي') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white mb-0.5">مواعيد الدوام</h4>
                            <p class="text-xs text-slate-400">{{ $settings['working_hours'] ?? 'خدمة الطوارئ: 24 ساعة | المعرض: 8 ص - 11:30 م' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Direct Directions Link -->
                <div class="pt-2">
                    <a href="{{ $directionsUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm px-6 py-3 rounded-xl border border-slate-700 transition-colors shadow-sm">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <span>فتح الاتجاهات عبر Google Maps</span>
                    </a>
                </div>
            </div>

            <!-- Google Maps Embedded (Left in RTL) -->
            <div class="lg:col-span-7">
                <div class="rounded-3xl overflow-hidden border-2 border-slate-800 shadow-2xl bg-slate-950 p-2">
                    <div class="relative w-full h-[400px] sm:h-[460px] rounded-2xl overflow-hidden">
                        <iframe 
                            src="{{ $mapEmbedUrl }}" 
                            class="w-full h-full border-0 filter grayscale-[25%] contrast-[110%]" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
