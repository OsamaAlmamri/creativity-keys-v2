<section id="gallery" class="py-24 bg-slate-100/70 dark:bg-slate-950 px-5 sm:px-8 border-t border-slate-200 dark:border-slate-800/80 relative overflow-hidden transition-colors duration-300">
    <div class="mx-auto max-w-7xl">

        <!-- Section Header Matching Reference Website -->
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="section-kicker">معرض الصور والأعمال</p>
                <h2 class="mt-4 max-w-2xl text-4xl font-semibold leading-tight tracking-[-0.03em] sm:text-5xl text-slate-900 dark:text-white">
                    لمحة من داخل محلنا وأحدث أجهزتنا.
                </h2>
            </div>
            <p class="max-w-md text-base leading-7 text-slate-600 dark:text-slate-400">
                تصفّح صورًا حقيقية من داخل محل مفاتيح الإبداع: أجهزة نسخ وبرمجة المفاتيح، معدات تشخيص السيارات، وعرض شامل لمفاتيح جميع الماركات. اضغط على أي صورة لعرضها بحجم أكبر.
            </p>
        </div>

        <!-- Filter Categories Tabs -->
        @if($galleryCategories->isNotEmpty() && $galleryCategories->count() > 1)
            <div class="flex flex-wrap items-center gap-2 pt-8" id="gallery-filters" role="group" aria-label="تصنيفات المعرض">
                <button type="button" data-filter="all"
                    class="gallery-filter-btn active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 bg-amber-500 text-white shadow-xs cursor-pointer">
                    الكل ({{ $galleryItems->count() }})
                </button>
                @foreach($galleryCategories as $category)
                    <button type="button" data-filter="{{ $category }}"
                        class="gallery-filter-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-800 shadow-xs cursor-pointer">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        @endif

        <!-- Gallery Grid with Enhanced Light & Dark Mode Design -->
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" id="gallery-grid">
            @forelse($galleryItems as $index => $item)
                @php
                    $thumbWebp = preg_replace('/800_([a-zA-Z0-9_\-]+)\.(jpg|jpeg|png)$/i', '400_$1.webp', $item->image_url);
                    $thumbJpg = preg_replace('/800_([a-zA-Z0-9_\-]+)\.(jpg|jpeg|png)$/i', '400_$1.jpg', $item->image_url);
                    $hasThumbWebp = file_exists(public_path(ltrim($thumbWebp, '/')));
                    $hasThumbJpg = file_exists(public_path(ltrim($thumbJpg, '/')));
                    $cardImgSrc = $hasThumbJpg ? asset($thumbJpg) : $item->image_url;
                @endphp
                <button type="button"
                    class="gallery-item glass-panel group relative overflow-hidden rounded-[1.8rem] p-2.5 text-start transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl cursor-pointer block w-full focus:outline-none focus:ring-2 focus:ring-amber-500/70"
                    data-gallery-src="{{ $item->image_url }}"
                    data-gallery-title="{{ $item->title }}"
                    data-gallery-desc="{{ $item->description ?? '' }}"
                    data-gallery-category="{{ $item->category }}"
                    data-category="{{ $item->category }}"
                    aria-label="عرض الصورة: {{ $item->title }}">
                    
                    <!-- Clean, crystal-clear image container with subtle hover overlay -->
                    <div class="relative overflow-hidden rounded-[1.4rem] aspect-[4/3] bg-slate-200 dark:bg-slate-800">
                        <picture>
                            @if($hasThumbWebp)
                                <source srcset="{{ asset($thumbWebp) }}" type="image/webp">
                            @endif
                            <img alt="{{ $item->title }}" loading="lazy" width="400" height="300"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                src="{{ $cardImgSrc }}">
                        </picture>

                        <!-- Subtle hover veil with zoom icon (only visible on hover) -->
                        <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-white/90 dark:bg-slate-900/90 text-slate-800 dark:text-white flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Pill Category Badge (Clean contrast) -->
                        <div class="absolute top-3 right-3">
                            <span class="rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur-md px-3 py-1 text-xs font-bold text-slate-800 dark:text-amber-400 border border-slate-200/80 dark:border-slate-700/60 shadow-xs">
                                {{ $item->category }}
                            </span>
                        </div>
                    </div>

                    <!-- Clean Typography Card Footer (High contrast in Light & Dark modes) -->
                    <div class="px-3 pt-3 pb-1 flex flex-col gap-1">
                        <h3 class="text-slate-900 dark:text-white font-bold text-sm sm:text-base leading-snug group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            {{ $item->title }}
                        </h3>
                        @if($item->description)
                            <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1">
                                {{ $item->description }}
                            </p>
                        @endif
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-16 text-slate-500">
                    جاري تحديث معرض الصور والأعمال...
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Lightbox Modal matching reference website with keyboard navigation & counter -->
<div id="galleryLightbox" class="gallery-lightbox" role="dialog" aria-modal="true" aria-label="عرض صور المحل" style="display: none;">
    <!-- Close button -->
    <button type="button" id="galleryClose" class="gallery-lightbox-close" aria-label="إغلاق الصورة">
        <svg class="w-6 h-6 stroke-[2.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Prev button (In RTL, prev is on the right side pointing right) -->
    <button type="button" id="galleryPrev" class="gallery-lightbox-nav gallery-lightbox-prev" aria-label="الصورة السابقة">
        <svg class="w-6 h-6 stroke-[2.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Main Content Container -->
    <div class="gallery-lightbox-content flex flex-col items-center max-w-full max-h-full px-4 select-none">
        <img id="galleryLightboxImg" src="" alt="" class="gallery-lightbox-img" />

        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 max-w-3xl w-full px-2">
            <div class="flex items-center gap-2 text-center sm:text-start">
                <span id="galleryLightboxCategory" class="px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold border border-amber-500/30"></span>
                <h4 id="galleryLightboxTitle" class="text-white font-bold text-sm sm:text-base drop-shadow"></h4>
            </div>
            <span id="galleryLightboxCounter" class="px-3 py-1 rounded-full bg-white/10 backdrop-blur text-white/80 text-xs font-bold border border-white/10 shrink-0">1 / 1</span>
        </div>
        <p id="galleryLightboxDesc" class="mt-1 text-xs text-slate-300 max-w-3xl w-full px-2 text-center sm:text-start drop-shadow line-clamp-2"></p>
    </div>

    <!-- Next button (In RTL, next is on the left side pointing left) -->
    <button type="button" id="galleryNext" class="gallery-lightbox-nav gallery-lightbox-next" aria-label="الصورة التالية">
        <svg class="w-6 h-6 stroke-[2.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleryItems = Array.from(document.querySelectorAll('.gallery-item'));
        const lightbox = document.getElementById('galleryLightbox');
        const lightboxImg = document.getElementById('galleryLightboxImg');
        const lightboxTitle = document.getElementById('galleryLightboxTitle');
        const lightboxCategory = document.getElementById('galleryLightboxCategory');
        const lightboxDesc = document.getElementById('galleryLightboxDesc');
        const lightboxCounter = document.getElementById('galleryLightboxCounter');
        const closeBtn = document.getElementById('galleryClose');
        const prevBtn = document.getElementById('galleryPrev');
        const nextBtn = document.getElementById('galleryNext');
        const filterBtns = document.querySelectorAll('.gallery-filter-btn');

        let currentIndex = 0;

        function getVisibleItems() {
            return galleryItems.filter(item => item.style.display !== 'none');
        }

        function showImage(index) {
            const visible = getVisibleItems();
            if (!visible.length || !lightboxImg) return;
            currentIndex = ((index % visible.length) + visible.length) % visible.length;
            const item = visible[currentIndex];

            const src = item.getAttribute('data-gallery-src');
            const title = item.getAttribute('data-gallery-title') || '';
            const desc = item.getAttribute('data-gallery-desc') || '';
            const cat = item.getAttribute('data-gallery-category') || '';

            lightboxImg.src = src;
            lightboxImg.alt = title;

            if (lightboxTitle) lightboxTitle.textContent = title;
            if (lightboxDesc) {
                lightboxDesc.textContent = desc;
                lightboxDesc.style.display = desc ? 'block' : 'none';
            }
            if (lightboxCategory) {
                lightboxCategory.textContent = cat;
                lightboxCategory.style.display = cat ? 'inline-block' : 'none';
            }
            if (lightboxCounter) {
                lightboxCounter.textContent = (currentIndex + 1) + ' / ' + visible.length;
            }
        }

        function openLightbox(itemEl) {
            if (!lightbox) return;
            const visible = getVisibleItems();
            const idx = visible.indexOf(itemEl);
            currentIndex = idx >= 0 ? idx : 0;
            showImage(currentIndex);
            lightbox.style.display = 'flex';
            lightbox.classList.add('is-open');
            document.body.style.overflow = 'hidden';
            if (closeBtn) closeBtn.focus();
        }

        function closeLightbox() {
            if (!lightbox) return;
            lightbox.classList.remove('is-open');
            lightbox.style.display = 'none';
            document.body.style.overflow = '';
        }

        galleryItems.forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                openLightbox(item);
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

        if (prevBtn) {
            prevBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                showImage(currentIndex - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                showImage(currentIndex + 1);
            });
        }

        if (lightbox) {
            lightbox.addEventListener('click', function (e) {
                if (e.target === lightbox || e.target.classList.contains('gallery-lightbox-content')) {
                    closeLightbox();
                }
            });

            // Touch swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;
            lightbox.addEventListener('touchstart', function (e) {
                if (e.changedTouches && e.changedTouches[0]) {
                    touchStartX = e.changedTouches[0].screenX;
                }
            }, { passive: true });
            lightbox.addEventListener('touchend', function (e) {
                if (e.changedTouches && e.changedTouches[0]) {
                    touchEndX = e.changedTouches[0].screenX;
                    const diff = touchEndX - touchStartX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) {
                            showImage(currentIndex - 1);
                        } else {
                            showImage(currentIndex + 1);
                        }
                    }
                }
            }, { passive: true });
        }

        document.addEventListener('keydown', function (e) {
            if (!lightbox || !lightbox.classList.contains('is-open')) return;
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                showImage(currentIndex + 1);
            } else if (e.key === 'ArrowRight') {
                showImage(currentIndex - 1);
            }
        });

        // Category Filtering
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-amber-500', 'text-white', 'shadow-xs');
                    b.classList.add('bg-white', 'dark:bg-slate-900', 'text-slate-700', 'dark:text-slate-300');
                });
                btn.classList.add('active', 'bg-amber-500', 'text-white', 'shadow-xs');
                btn.classList.remove('bg-white', 'dark:bg-slate-900', 'text-slate-700', 'dark:text-slate-300');

                const filter = btn.getAttribute('data-filter');
                galleryItems.forEach(item => {
                    const cat = item.getAttribute('data-category');
                    if (filter === 'all' || cat === filter) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
