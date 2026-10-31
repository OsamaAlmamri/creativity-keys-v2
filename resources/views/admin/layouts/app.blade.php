<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>لوحة التحكم | {{ $title ?? 'مفاتيح الأمان' }}</title>

    @include('partials.theme-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col selection:bg-amber-500 selection:text-slate-950">

    <div class="flex-1 flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 border-l border-slate-800 flex flex-col shrink-0">
            <!-- Brand -->
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shadow-lg shadow-amber-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    </div>
                    <div>
                        <span class="text-base font-black text-white block">لوحة الإدارة</span>
                        <span class="text-xs text-amber-400 font-bold block">مفاتيح الأمان</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>لوحة التحكم (الرئيسية)</span>
                </a>

                <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>رسائل وطلبات العملاء</span>
                    </div>
                    @php
                        $unreadBadge = \App\Models\ContactMessage::where('is_read', false)->count();
                    @endphp
                    @if($unreadBadge > 0)
                        <span class="px-2 py-0.5 rounded-full text-xs font-black {{ request()->routeIs('admin.messages.*') ? 'bg-slate-950 text-white' : 'bg-red-500 text-white' }}">
                            {{ $unreadBadge }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>إدارة الخدمات</span>
                </a>

                <a href="{{ route('admin.service-categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 mr-3 rounded-xl text-xs font-bold transition-colors {{ request()->routeIs('admin.service-categories.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    <span>أصناف وتصنيفات الخدمات</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>معرض الأعمال والصور</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    <span>إدارة التقييمات</span>
                </a>

                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.articles.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>المقالات والمدونة</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    <span>بيانات وإعدادات المحل</span>
                </a>

                <a href="{{ route('admin.theme.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.theme.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 4 4 0 014-4c.77 0 1.5.21 2.13.57L19.5 3.5a2.12 2.12 0 013 3L12.43 16.87A3.99 3.99 0 017 21zM7 17a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    <span>المظهر والثيم والخطوط</span>
                </a>

                @if(auth()->user()->isAdmin())
                    <div class="pt-4 mt-4 border-t border-slate-800">
                        <div class="px-4 pb-2 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            الصلاحيات والإدارة العليا
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-amber-500 text-slate-950 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span>المستخدمين والصلاحيات</span>
                        </a>
                    </div>
                @endif
            </nav>

            <!-- Bottom User & Logout -->
            <div class="p-4 border-t border-slate-800 bg-slate-950/60">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-amber-400">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-amber-400 font-semibold">
                            {{ auth()->user()->role === 'admin' ? 'مدير النظام (Admin)' : 'مشرف (Manager)' }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank" class="flex-1 text-center py-2 px-3 rounded-lg bg-slate-800 hover:bg-slate-750 text-xs font-bold text-slate-300 hover:text-white transition-colors">
                        معاينة الموقع
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition-colors" title="تسجيل الخروج">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="h-16 bg-slate-900 border-b border-slate-800 px-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <h1 class="text-base sm:text-lg font-bold text-white">
                        @yield('page_title', 'لوحة التحكم')
                    </h1>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" onclick="window.toggleSiteTheme()" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors cursor-pointer border border-slate-700/60" title="تبديل المظهر النهاري / الليلي" aria-label="تبديل المظهر">
                        <svg class="w-4 h-4 theme-icon-sun text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <svg class="w-4 h-4 theme-icon-moon text-blue-400" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </button>

                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg bg-slate-800 text-slate-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        زيارة الموقع الخارجي
                    </a>
                </div>
            </header>

            <!-- Alerts -->
            <div class="p-6 pb-0">
                @if(session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-bold text-sm flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 font-bold text-sm mb-4">
                        @if(session('error'))
                            <div>{{ session('error') }}</div>
                        @endif
                        @if($errors->any())
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Page Body -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
