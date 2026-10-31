<section id="reviews" class="py-24 bg-slate-950 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                تقييمات العملاء
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white">
                ماذا يقول عملاؤنا عنا؟
            </h2>
            <p class="text-slate-400 text-base">
                نفخر بثقة آلاف العملاء في {{ $cityName }} الذين تشرفنا بخدمتهم في أوقات الطوارئ والمناسبات.
            </p>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($reviews as $review)
                <x-review-card :review="$review" />
            @empty
                <div class="col-span-4 text-center py-8 text-slate-500">
                    لا توجد تقييمات منشورة حالياً.
                </div>
            @endforelse
        </div>

    </div>
</section>
