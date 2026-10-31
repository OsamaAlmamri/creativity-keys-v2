<section id="gallery" class="py-24 bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                معرض الصور والأعمال
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white">
                لقطات من أعمالنا وأحدث أجهزتنا
            </h2>
            <p class="text-slate-400 text-base">
                شاهد كفاءة أجهزتنا الرقمية وصور حقيقية من برمجة بصمات السيارات وتركيب الأقفال الذكية وفتح الخزائن.
            </p>

            <!-- Filter Categories Tabs -->
            @if($galleryCategories->isNotEmpty())
                <div class="flex flex-wrap items-center justify-center gap-2 pt-4" id="gallery-filters">
                    <button type="button" data-filter="all" class="filter-btn active px-4 py-2 rounded-full text-xs font-bold transition-all bg-amber-500 text-slate-950">
                        الكل ({{ $galleryItems->count() }})
                    </button>
                    @foreach($galleryCategories as $category)
                        <button type="button" data-filter="{{ $category }}" class="filter-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-slate-800 text-slate-300 hover:bg-slate-700">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="gallery-grid">
            @forelse($galleryItems as $item)
                <div class="gallery-card group relative rounded-3xl overflow-hidden bg-slate-950 border border-slate-800 shadow-xl hover-brand-card" data-category="{{ $item->category }}">
                    <!-- Image Container with Aspect Ratio -->
                    <div class="aspect-w-16 aspect-h-11 h-64 overflow-hidden">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>

                    <!-- Card Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full bg-slate-900/90 backdrop-blur-md text-amber-400 border border-slate-700 text-xs font-bold">
                            {{ $item->category }}
                        </span>
                    </div>

                    <!-- Card Content at Bottom -->
                    <div class="absolute bottom-0 inset-x-0 p-6 space-y-1">
                        <h3 class="text-white font-bold text-base group-hover:text-amber-400 transition-colors">
                            {{ $item->title }}
                        </h3>
                        @if($item->description)
                            <p class="text-xs text-slate-400 line-clamp-2">
                                {{ $item->description }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500">
                    جاري تحديث معرض الصور...
                </div>
            @endforelse
        </div>

    </div>
</section>
