@extends('admin.layouts.app')

@section('page_title', 'إعدادات وبيانات المحل')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Top Header & Breadcrumb Info -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-800 pb-6">
            <div>
                <h2 class="text-2xl font-black text-white flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-amber-400 shadow-lg shadow-amber-400/30"></span>
                    إعدادات وبيانات المركز والموقع
                </h2>
                <p class="text-xs text-slate-400 mt-1.5">
                    إدارة شاملة ومستقلة لكل قسم: الهوية والشعار، محركات البحث SEO، وسائل التواصل، الاتصال، التغطية، والعنوان.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" target="_blank"
                    class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white text-xs font-bold transition-all border border-slate-800 inline-flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    معاينة الموقع
                </a>
            </div>
        </div>

        <!-- Global Success Alert -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm flex items-start gap-3 shadow-lg shadow-emerald-500/5 transition-all">
                <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 font-medium leading-relaxed">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Global Error Alert -->
        @if($errors->any())
            <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 text-sm flex items-start gap-3 shadow-lg shadow-red-500/5">
                <svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 space-y-1">
                    <strong class="font-bold block">يرجى مراجعة الأخطاء التالية وتصحيحها:</strong>
                    <ul class="list-disc list-inside text-xs space-y-0.5 text-red-200">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- 1. Tabs Navigation Component -->
        <x-admin.settings.navigation :active-tab="$activeTab" />

        <!-- 2. Settings Tab Components -->
        <!-- Tab 1: Branding (الهوية والشعار) -->
        <x-admin.settings.branding-tab :active="$activeTab === 'branding'" />

        <!-- Tab 2: SEO (محركات البحث) -->
        <x-admin.settings.seo-tab :active="$activeTab === 'seo'" />

        <!-- Tab 3: Social Media (وسائل التواصل) -->
        <x-admin.settings.social-tab :active="$activeTab === 'social'" />

        <!-- Tab 4: Contact & Emergency (الاتصال والطوارئ) -->
        <x-admin.settings.contact-tab :active="$activeTab === 'contact'" />

        <!-- Tab 5: Coverage Scope (نطاق التغطية) -->
        <x-admin.settings.coverage-tab :active="$activeTab === 'coverage'" />

        <!-- Tab 6: Location & Maps (العنوان والخرائط) -->
        <x-admin.settings.location-tab :active="$activeTab === 'location'" />

        <!-- Tab 7: Trust Stats (إحصائيات وأرقام الثقة) -->
        <x-admin.settings.stats-tab :active="$activeTab === 'stats'" />

    </div>

    <!-- Client-side tab switching and helper scripts -->
    <script>
        /**
         * Switch active tab with instant UI update and URL history push
         */
        function switchTab(event, tabKey) {
            if (event) {
                event.preventDefault();
            }

            // 1. Hide all tab panels
            document.querySelectorAll('.tab-panel').forEach(function(panel) {
                panel.classList.add('hidden');
            });

            // 2. Show target tab panel
            const activePanel = document.getElementById('tab-panel-' + tabKey);
            if (activePanel) {
                activePanel.classList.remove('hidden');
            }

            // 3. Update tab buttons active classes
            document.querySelectorAll('.tab-btn').forEach(function(btn) {
                const isCurrent = btn.getAttribute('data-tab-link') === tabKey;
                const icon = btn.querySelector('svg');

                if (isCurrent) {
                    btn.className = 'tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-black bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 transition-all duration-200';
                    if (icon) {
                        icon.classList.remove('text-amber-400', 'text-emerald-400', 'text-sky-400', 'text-red-400', 'text-blue-400', 'text-purple-400');
                        icon.classList.add('text-slate-950');
                    }
                } else {
                    btn.className = 'tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800/80 transition-all duration-200';
                    if (icon) {
                        icon.classList.remove('text-slate-950');
                        // restore specific tab icon color
                        const targetKey = btn.getAttribute('data-tab-link');
                        if (targetKey === 'seo') icon.classList.add('text-emerald-400');
                        else if (targetKey === 'social') icon.classList.add('text-sky-400');
                        else if (targetKey === 'contact') icon.classList.add('text-red-400');
                        else if (targetKey === 'location') icon.classList.add('text-blue-400');
                        else if (targetKey === 'stats') icon.classList.add('text-purple-400');
                        else icon.classList.add('text-amber-400');
                    }
                }
            });

            // 4. Update browser URL without reloading
            const baseUrl = "{{ url('admin/settings') }}";
            const newUrl = baseUrl + '/' + tabKey;
            window.history.pushState({ tab: tabKey }, '', newUrl);

            // Scroll tab nav button into view if on mobile
            const targetBtn = document.querySelector(`[data-tab-link="${tabKey}"]`);
            if (targetBtn) {
                targetBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        }

        // Support browser Back/Forward buttons
        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.tab) {
                switchTab(null, event.state.tab);
            }
        });

        // Image & Favicon upload helpers
        function previewUploadedImage(input, imgId, fallbackId, removeBtnId, removeFlagId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(imgId);
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                    if (fallbackId) {
                        const fallback = document.getElementById(fallbackId);
                        if (fallback) fallback.classList.add('hidden');
                    }
                    if (removeBtnId) {
                        const btn = document.getElementById(removeBtnId);
                        if (btn) btn.classList.remove('hidden');
                    }
                    if (removeFlagId) {
                        const flag = document.getElementById(removeFlagId);
                        if (flag) flag.value = "0";
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewUrlImage(url, imgId, fallbackId, removeBtnId, removeFlagId) {
            const img = document.getElementById(imgId);
            if (!img) return;

            if (url && url.trim().length > 5) {
                img.src = url.trim();
                img.classList.remove('hidden');
                if (fallbackId) {
                    const fallback = document.getElementById(fallbackId);
                    if (fallback) fallback.classList.add('hidden');
                }
                if (removeBtnId) {
                    const btn = document.getElementById(removeBtnId);
                    if (btn) btn.classList.remove('hidden');
                }
                if (removeFlagId) {
                    const flag = document.getElementById(removeFlagId);
                    if (flag) flag.value = "0";
                }
            }
        }

        function clearSiteLogo() {
            const img = document.getElementById('site-logo-preview-img');
            const fallback = document.getElementById('site-logo-fallback');
            const fileInput = document.getElementById('site_logo_file');
            const urlInput = document.getElementById('site_logo');
            const removeBtn = document.getElementById('remove-logo-btn');
            const removeFlag = document.getElementById('remove_site_logo');

            if (img) {
                img.src = '';
                img.classList.add('hidden');
            }
            if (fallback) fallback.classList.remove('hidden');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = '';
            if (removeBtn) removeBtn.classList.add('hidden');
            if (removeFlag) removeFlag.value = '1';
        }

        function clearSiteFavicon() {
            const img = document.getElementById('site-favicon-preview-img');
            const fallback = document.getElementById('site-favicon-fallback');
            const fileInput = document.getElementById('site_favicon_file');
            const urlInput = document.getElementById('site_favicon');
            const removeBtn = document.getElementById('remove-favicon-btn');
            const removeFlag = document.getElementById('remove_site_favicon');

            if (img) {
                img.src = '';
                img.classList.add('hidden');
            }
            if (fallback) fallback.classList.remove('hidden');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = '';
            if (removeBtn) removeBtn.classList.add('hidden');
            if (removeFlag) removeFlag.value = '1';
        }

        function clearOgImage() {
            const img = document.getElementById('og-image-preview-img');
            const fileInput = document.getElementById('og_image_file');
            const urlInput = document.getElementById('og_image');
            const removeBtn = document.getElementById('remove-og-btn');
            const removeFlag = document.getElementById('remove_og_image');

            const defaultOg = 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&h=630&q=80';
            if (img) img.src = defaultOg;
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = defaultOg;
            if (removeBtn) removeBtn.classList.add('hidden');
            if (removeFlag) removeFlag.value = '1';
        }

        function updateCharCounter(textarea, counterId, max) {
            const counter = document.getElementById(counterId);
            if (!counter) return;
            const len = textarea.value.length;
            counter.textContent = `${len} / ${max} حرف`;
            if (len > max) {
                counter.classList.add('text-amber-400');
                counter.classList.remove('text-slate-400');
            } else {
                counter.classList.remove('text-amber-400');
                counter.classList.add('text-slate-400');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const metaDesc = document.getElementById('meta_description');
            if (metaDesc) updateCharCounter(metaDesc, 'meta-desc-counter', 160);
        });

        function extractCoordsFromEmbed() {
            const embedInput = document.getElementById('google_map_embed');
            if (!embedInput) return;

            const text = embedInput.value;
            const match = text.match(/!2d([0-9\.\-]+)!3d([0-9\.\-]+)/);

            if (match && match.length >= 3) {
                const lng = match[1];
                const lat = match[2];
                document.getElementById('map_longitude').value = lng;
                document.getElementById('map_latitude').value = lat;

                updatePreviewUrl(lat, lng);
                alert(`تم استخراج الإحداثيات بنجاح!\nخط العرض (Lat): ${lat}\nخط الطول (Lng): ${lng}`);
            } else {
                alert('لم يتم العثور على إحداثيات صريحة داخل كود التضمين. يمكنك إدخال خطوط الطول والعرض يدوياً.');
            }
        }

        function generateDirectionsUrl() {
            const lat = document.getElementById('map_latitude')?.value.trim();
            const lng = document.getElementById('map_longitude')?.value.trim();

            if (lat && lng) {
                const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                document.getElementById('map_directions_url').value = url;
                updatePreviewUrl(lat, lng);
                alert('تم توليد رابط الملاحة والاتجاهات المباشر بنجاح!');
            } else {
                alert('يرجى كتابة خط العرض وخط الطول أولاً لتوليد الرابط.');
            }
        }

        function updatePreviewUrl(lat, lng) {
            const previewBtn = document.getElementById('preview-directions-btn');
            if (previewBtn && lat && lng) {
                previewBtn.href = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            }
        }
    </script>

@endsection
