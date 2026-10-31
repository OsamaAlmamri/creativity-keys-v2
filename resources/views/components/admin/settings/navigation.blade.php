@props([
    'activeTab' => 'branding',
])

<div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-1.5 shadow-xl backdrop-blur-md">
    <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar scroll-smooth" id="settings-tabs-nav">
        
        <!-- 1. Branding Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'branding']) }}"
            data-tab-link="branding"
            onclick="switchTab(event, 'branding')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'branding' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'branding' ? 'text-slate-950' : 'text-amber-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
            </svg>
            <span>الهوية والشعار</span>
        </a>

        <!-- 2. SEO Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'seo']) }}"
            data-tab-link="seo"
            onclick="switchTab(event, 'seo')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'seo' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'seo' ? 'text-slate-950' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <span>محركات البحث (SEO)</span>
        </a>

        <!-- 3. Social Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'social']) }}"
            data-tab-link="social"
            onclick="switchTab(event, 'social')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'social' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'social' ? 'text-slate-950' : 'text-sky-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            <span>وسائل التواصل</span>
        </a>

        <!-- 4. Contact Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'contact']) }}"
            data-tab-link="contact"
            onclick="switchTab(event, 'contact')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'contact' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'contact' ? 'text-slate-950' : 'text-red-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>الاتصال والطوارئ</span>
        </a>

        <!-- 5. Coverage Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'coverage']) }}"
            data-tab-link="coverage"
            onclick="switchTab(event, 'coverage')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'coverage' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'coverage' ? 'text-slate-950' : 'text-amber-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>نطاق التغطية</span>
        </a>

        <!-- 6. Location Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'location']) }}"
            data-tab-link="location"
            onclick="switchTab(event, 'location')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'location' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'location' ? 'text-slate-950' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </svg>
            <span>العنوان والخرائط</span>
        </a>

        <!-- 7. Stats Tab Button -->
        <a href="{{ route('admin.settings.index', ['tab' => 'stats']) }}"
            data-tab-link="stats"
            onclick="switchTab(event, 'stats')"
            class="tab-btn shrink-0 flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ $activeTab === 'stats' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-black' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
            <svg class="w-4 h-4 {{ $activeTab === 'stats' ? 'text-slate-950' : 'text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span>إحصائيات الثقة</span>
        </a>

    </div>
</div>
