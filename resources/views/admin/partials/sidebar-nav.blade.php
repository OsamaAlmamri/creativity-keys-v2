<!-- Group 1: Overview -->
<div class="space-y-1">
    <div class="sidebar-section-title px-3 pb-1.5 text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
        نظرة عامة ومتابعة
    </div>
    <div class="sidebar-section-divider hidden my-2 mx-auto w-6 h-px bg-slate-800"></div>

    <x-admin.sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" title="لوحة التحكم الرئيسية">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </x-slot:icon>
        لوحة التحكم (الرئيسية)
    </x-admin.sidebar-link>

    <x-admin.sidebar-link :href="route('admin.messages.index')" :active="request()->routeIs('admin.messages.*')" :badge="$unreadMessagesCount ?? 0" title="رسائل وطلبات العملاء">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </x-slot:icon>
        رسائل وطلبات العملاء
    </x-admin.sidebar-link>
</div>

<!-- Group 2: Content & Services -->
<div class="space-y-1 pt-2 border-t border-slate-800/80">
    <div class="sidebar-section-title px-3 pb-1.5 text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
        إدارة المحتوى والخدمات
    </div>
    <div class="sidebar-section-divider hidden my-2 mx-auto w-6 h-px bg-slate-800"></div>

    <x-admin.sidebar-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" title="دليل الخدمات الفنية">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </x-slot:icon>
        دليل الخدمات الفنية
    </x-admin.sidebar-link>

    <x-admin.sidebar-link :href="route('admin.service-categories.index')" :active="request()->routeIs('admin.service-categories.*')" title="أصناف وتصنيفات الخدمات">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
        </x-slot:icon>
        أصناف وتصنيفات الخدمات
    </x-admin.sidebar-link>

    <x-admin.sidebar-link :href="route('admin.gallery.index')" :active="request()->routeIs('admin.gallery.*')" title="معرض الأعمال والصور">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </x-slot:icon>
        معرض الأعمال والصور
    </x-admin.sidebar-link>

    <x-admin.sidebar-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')" title="إدارة التقييمات">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        </x-slot:icon>
        إدارة التقييمات
    </x-admin.sidebar-link>

    <x-admin.sidebar-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.*')" title="المقالات والمدونة">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
        </x-slot:icon>
        المقالات والمدونة
    </x-admin.sidebar-link>
</div>

<!-- Group 3: Settings & Management -->
<div class="space-y-1 pt-2 border-t border-slate-800/80">
    <div class="sidebar-section-title px-3 pb-1.5 text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
        الإعدادات والتخصيص
    </div>
    <div class="sidebar-section-divider hidden my-2 mx-auto w-6 h-px bg-slate-800"></div>

    <x-admin.sidebar-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')" title="بيانات وإعدادات المحل">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
        </x-slot:icon>
        بيانات وإعدادات المحل
    </x-admin.sidebar-link>

    <x-admin.sidebar-link :href="route('admin.theme.index')" :active="request()->routeIs('admin.theme.*')" title="المظهر والثيم والخطوط">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 4 4 0 014-4c.77 0 1.5.21 2.13.57L19.5 3.5a2.12 2.12 0 013 3L12.43 16.87A3.99 3.99 0 017 21zM7 17a2 2 0 100 4 2 2 0 000-4z"/></svg>
        </x-slot:icon>
        المظهر والثيم والخطوط
    </x-admin.sidebar-link>

    @if(auth()->user()->isAdmin())
        <x-admin.sidebar-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" title="المستخدمين والصلاحيات">
            <x-slot:icon>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </x-slot:icon>
            المستخدمين والصلاحيات
        </x-admin.sidebar-link>
    @endif
</div>
