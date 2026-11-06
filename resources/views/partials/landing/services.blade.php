<section id="services" class="py-24 bg-slate-950 relative border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header Matching Reference Style -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    خدماتنا المتميزة
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
                    حلول أمان متكاملة لاحتياجاتك.
                </h2>
            </div>
            <p class="max-w-md text-base text-slate-400 leading-relaxed">
                نقدم مجموعة واسعة من الخدمات لضمان حماية ممتلكاتك بأعلى مستويات الجودة والسرعة، على يد أمهر الفنيين في {{ $cityName }} وبأحدث الأجهزة.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($services as $service)
                <x-service-card :service="$service" :settings="$settings" />
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500">
                    جاري تحديث قائمة الخدمات...
                </div>
            @endforelse
        </div>

    </div>
</section>
