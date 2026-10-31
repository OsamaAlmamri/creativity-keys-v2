<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>لوحة التحكم | {{ $title ?? 'مفاتيح الأمان' }}</title>

    @include('partials.theme-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Pre-load sidebar state to avoid layout shift on desktop -->
    <script>
        (function() {
            try {
                if (localStorage.getItem('admin_sidebar_collapsed') === 'true' && window.innerWidth >= 1024) {
                    document.documentElement.classList.add('sidebar-is-collapsed');
                }
            } catch (e) {}
        })();
    </script>

    <style>
        /* Custom scrollbar for sidebar nav */
        .admin-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .admin-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .admin-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.2);
            border-radius: 9999px;
        }
        .admin-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.4);
        }

        /* Collapsed Sidebar Styles */
        html.sidebar-is-collapsed #admin-sidebar {
            width: 4.75rem !important; /* 76px */
        }
        html.sidebar-is-collapsed #admin-sidebar .sidebar-text,
        html.sidebar-is-collapsed #admin-sidebar .sidebar-section-title {
            display: none !important;
        }
        html.sidebar-is-collapsed #admin-sidebar .sidebar-badge {
            position: absolute !important;
            top: 0.35rem !important;
            right: 0.75rem !important;
            width: 0.55rem !important;
            height: 0.55rem !important;
            padding: 0 !important;
            border-radius: 9999px !important;
            font-size: 0 !important;
            border: 2px solid #0f172a !important;
        }
        html.sidebar-is-collapsed #admin-sidebar .sidebar-section-divider {
            display: block !important;
        }
        html.sidebar-is-collapsed #admin-sidebar nav a {
            justify-content: center !important;
            padding-left: 0.25rem !important;
            padding-right: 0.25rem !important;
        }
        html.sidebar-is-collapsed #admin-sidebar .sidebar-header-box {
            justify-content: center !important;
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        html.sidebar-is-collapsed #admin-sidebar .sidebar-user-card {
            justify-content: center !important;
            padding: 0.25rem !important;
            background: transparent !important;
            border-color: transparent !important;
        }
        html.sidebar-is-collapsed .sidebar-toggle-arrow {
            transform: rotate(180deg) !important;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex selection:bg-amber-500 selection:text-slate-950">

    @php
        $unreadMessagesCount = \App\Models\ContactMessage::where('is_read', false)->count();
    @endphp

    <!-- ======================================================== -->
    <!-- 1. MOBILE SIDEBAR DRAWER (OVERLAY & OFF-CANVAS)           -->
    <!-- ======================================================== -->
    <div id="mobile-sidebar-backdrop" 
         class="fixed inset-0 bg-slate-950/80 backdrop-blur-xs z-50 lg:hidden transition-opacity duration-300 opacity-0 pointer-events-none" 
         onclick="toggleMobileSidebar(false)">
    </div>

    <aside id="mobile-sidebar" 
           class="fixed top-0 bottom-0 right-0 w-72 max-w-[85vw] bg-slate-900 border-l border-slate-800 z-50 flex flex-col transition-transform duration-300 ease-in-out translate-x-full lg:hidden shadow-2xl">
        
        <!-- Mobile Drawer Header -->
        <div class="h-16 px-5 border-b border-slate-800 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shadow-md shadow-amber-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <div>
                    <span class="text-sm font-black text-white block">لوحة الإدارة</span>
                    <span class="text-[11px] text-amber-400 font-bold block">مفاتيح الأمان</span>
                </div>
            </div>
            <button type="button" 
                    onclick="toggleMobileSidebar(false)" 
                    class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white transition-colors"
                    aria-label="إغلاق القائمة">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile Navigation Links -->
        <nav class="flex-1 p-3.5 space-y-4 overflow-y-auto admin-scrollbar">
            <!-- Group 1: Overview -->
            <div class="space-y-1">
                <div class="px-3 pb-1.5 text-[10px] font-black uppercase tracking-wider text-slate-500">
                    نظرة عامة ومتابعة
                </div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span>لوحة التحكم الرئيسية</span>
                </a>

                <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.messages.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.messages.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span>رسائل وطلبات العملاء</span>
                    </div>
                    @if($unreadMessagesCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ request()->routeIs('admin.messages.*') ? 'bg-slate-950 text-white' : 'bg-red-500 text-white animate-pulse' }}">
                            {{ $unreadMessagesCount }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Group 2: Content & Services -->
            <div class="space-y-1 pt-2 border-t border-slate-800/80">
                <div class="px-3 pb-1.5 text-[10px] font-black uppercase tracking-wider text-slate-500">
                    إدارة المحتوى والخدمات
                </div>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.services.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.services.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span>دليل الخدمات الفنية</span>
                </a>

                <a href="{{ route('admin.service-categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.service-categories.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.service-categories.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </div>
                    <span>أصناف وتصنيفات الخدمات</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.gallery.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span>معرض الأعمال والصور</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.reviews.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <span>إدارة التقييمات</span>
                </a>

                <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.articles.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.articles.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <span>المقالات والمدونة</span>
                </a>
            </div>

            <!-- Group 3: Settings & Management -->
            <div class="space-y-1 pt-2 border-t border-slate-800/80">
                <div class="px-3 pb-1.5 text-[10px] font-black uppercase tracking-wider text-slate-500">
                    الإعدادات والمظهر
                </div>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    <span>بيانات وإعدادات المحل</span>
                </a>

                <a href="{{ route('admin.theme.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.theme.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.theme.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 4 4 0 014-4c.77 0 1.5.21 2.13.57L19.5 3.5a2.12 2.12 0 013 3L12.43 16.87A3.99 3.99 0 017 21zM7 17a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    </div>
                    <span>المظهر والثيم والخطوط</span>
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.users.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.users.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <span>المستخدمين والصلاحيات</span>
                    </a>
                @endif
            </div>
        </nav>

        <!-- Mobile Drawer Bottom Profile -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/60">
            <div class="flex items-center gap-3 mb-3">
                <div class="relative w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-400 text-slate-950 font-black flex items-center justify-center shadow-md">
                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                    <span class="absolute -bottom-0.5 -left-0.5 w-3 h-3 bg-emerald-500 border-2 border-slate-900 rounded-full"></span>
                </div>
                <div class="overflow-hidden flex-1">
                    <div class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-amber-400 font-bold">
                        {{ auth()->user()->role === 'admin' ? 'مدير النظام (Admin)' : 'مشرف (Manager)' }}
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="flex-1 text-center py-2 px-3 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-bold text-slate-200 transition-colors">
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

    <!-- ======================================================== -->
    <!-- 2. DESKTOP STICKY SIDEBAR (COLLAPSIBLE LIKE MODERN APPS)   -->
    <!-- ======================================================== -->
    <aside id="admin-sidebar" 
           class="hidden lg:flex flex-col sticky top-0 h-screen bg-slate-900 border-l border-slate-800 transition-all duration-300 ease-in-out z-40 shrink-0 w-64 shadow-xl">
        
        <!-- Brand Header (Clean & Centered when collapsed) -->
        <div class="h-16 px-4 border-b border-slate-800 flex items-center shrink-0 sidebar-header-box overflow-hidden">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 overflow-hidden sidebar-logo-link w-full" title="لوحة الإدارة - مفاتيح الأمان">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shadow-lg shadow-amber-500/20 shrink-0 group-hover:scale-105 transition-transform mx-auto lg:mx-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <div class="sidebar-text truncate">
                    <span class="text-sm font-black text-white block tracking-tight">لوحة الإدارة</span>
                    <span class="text-[11px] text-amber-400 font-bold block flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        مفاتيح الأمان
                    </span>
                </div>
            </a>
        </div>

        <!-- Scrollable Navigation Groups -->
        <nav class="flex-1 p-3 space-y-4 overflow-y-auto admin-scrollbar">
            
            <!-- Group 1: Overview -->
            <div class="space-y-1">
                <div class="sidebar-section-title px-3 pb-1 text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    نظرة عامة
                </div>
                <div class="sidebar-section-divider hidden my-2 mx-auto w-6 h-px bg-slate-800"></div>

                <a href="{{ route('admin.dashboard') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="لوحة التحكم الرئيسية">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span class="sidebar-text truncate">لوحة التحكم (الرئيسية)</span>
                </a>

                <a href="{{ route('admin.messages.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.messages.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="رسائل وطلبات العملاء">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.messages.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="sidebar-text truncate">رسائل وطلبات العملاء</span>
                    @if($unreadMessagesCount > 0)
                        <span class="sidebar-badge mr-auto px-2 py-0.5 rounded-full text-[10px] font-black {{ request()->routeIs('admin.messages.*') ? 'bg-slate-950 text-white' : 'bg-red-500 text-white animate-pulse' }}">
                            {{ $unreadMessagesCount }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Group 2: Content & Services -->
            <div class="space-y-1 pt-2 border-t border-slate-800/80">
                <div class="sidebar-section-title px-3 pb-1 text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    المحتوى والخدمات
                </div>
                <div class="sidebar-section-divider hidden my-2 mx-auto w-6 h-px bg-slate-800"></div>

                <a href="{{ route('admin.services.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.services.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="دليل الخدمات الفنية">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.services.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span class="sidebar-text truncate">دليل الخدمات</span>
                </a>

                <a href="{{ route('admin.service-categories.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.service-categories.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="أصناف وتصنيفات الخدمات">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.service-categories.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </div>
                    <span class="sidebar-text truncate">أصناف الخدمات</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.gallery.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="معرض الأعمال والصور">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.gallery.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="sidebar-text truncate">معرض الأعمال والصور</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="إدارة التقييمات">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.reviews.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <span class="sidebar-text truncate">إدارة التقييمات</span>
                </a>

                <a href="{{ route('admin.articles.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.articles.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="المقالات والمدونة">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.articles.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <span class="sidebar-text truncate">المقالات والمدونة</span>
                </a>
            </div>

            <!-- Group 3: Settings & Management -->
            <div class="space-y-1 pt-2 border-t border-slate-800/80">
                <div class="sidebar-section-title px-3 pb-1 text-[10px] font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    الإعدادات والتخصيص
                </div>
                <div class="sidebar-section-divider hidden my-2 mx-auto w-6 h-px bg-slate-800"></div>

                <a href="{{ route('admin.settings.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="بيانات وإعدادات المحل">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    <span class="sidebar-text truncate">بيانات وإعدادات المحل</span>
                </a>

                <a href="{{ route('admin.theme.index') }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.theme.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                   title="المظهر والثيم والخطوط">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.theme.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 4 4 0 014-4c.77 0 1.5.21 2.13.57L19.5 3.5a2.12 2.12 0 013 3L12.43 16.87A3.99 3.99 0 017 21zM7 17a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    </div>
                    <span class="sidebar-text truncate">المظهر والثيم والخطوط</span>
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" 
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative {{ request()->routeIs('admin.users.*') ? 'bg-amber-500 text-slate-950 font-black shadow-md shadow-amber-500/20' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                       title="المستخدمين والصلاحيات">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('admin.users.*') ? 'bg-slate-950/15 text-slate-950' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }} transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <span class="sidebar-text truncate">المستخدمين والصلاحيات</span>
                    </a>
                @endif
            </div>
        </nav>

        <!-- Bottom User Profile Card -->
        <div class="p-3 border-t border-slate-800 bg-slate-950/60 shrink-0">
            <div class="flex items-center gap-3 p-1.5 rounded-xl bg-slate-900/80 border border-slate-800/80 mb-2 sidebar-user-card">
                <div class="relative w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-400 text-slate-950 font-black flex items-center justify-center shadow-md shrink-0 mx-auto" title="{{ auth()->user()->name }}">
                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                    <span class="absolute -bottom-0.5 -left-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-slate-900 rounded-full" title="متصل الآن"></span>
                </div>
                <div class="sidebar-text overflow-hidden flex-1">
                    <div class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-amber-400 font-bold">
                        {{ auth()->user()->role === 'admin' ? 'مدير النظام (Admin)' : 'مشرف (Manager)' }}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-text flex-1 text-center py-1.5 px-2 rounded-lg bg-slate-800 hover:bg-slate-750 text-[11px] font-bold text-slate-300 hover:text-white transition-colors truncate" title="زيارة الموقع">
                    معاينة الموقع
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="w-full lg:w-auto">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center p-2 rounded-lg bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition-colors" title="تسجيل الخروج">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ======================================================== -->
    <!-- 3. MAIN CONTENT WRAPPER & MODERN APP BAR                  -->
    <!-- ======================================================== -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Modern Floating / Sticky Topbar -->
        <header class="admin-header h-16 bg-slate-900/80 backdrop-blur-md border-b border-slate-800/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            
            <!-- Left Side: Modern Sidebar Toggle Icon & Breadcrumbs -->
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                <!-- Unified Modern Sidebar Toggle Icon Button (Next to Breadcrumbs) -->
                <button type="button" 
                        onclick="handleSidebarToggle()" 
                        class="p-2 sm:p-2.5 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-amber-400 hover:border-amber-400/40 transition-all border border-slate-700/60 shadow-xs cursor-pointer flex items-center justify-center shrink-0 group" 
                        title="طي / توسيع القائمة الجانبية (Ctrl+B)" 
                        aria-label="تبديل القائمة الجانبية">
                    <!-- Modern PanelLeft / Sidebar Toggle Icon -->
                    <svg class="w-5 h-5 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="3" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v18"/>
                    </svg>
                </button>

                <!-- Subtle Vertical Divider -->
                <div class="h-5 w-px bg-slate-800 hidden sm:block"></div>

                <!-- Breadcrumb Navigation -->
                <nav class="admin-breadcrumb flex items-center gap-2 text-xs font-bold truncate" aria-label="مسار التصفح">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-amber-500 transition-colors hidden sm:inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>لوحة الإدارة</span>
                    </a>
                    <span class="text-slate-600 hidden sm:inline">/</span>
                    <h1 class="text-xs sm:text-sm font-black text-white truncate">
                        @yield('page_title', 'لوحة التحكم')
                    </h1>
                </nav>
            </div>

            <!-- Right Side: Status, Actions, Theme Toggle -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                
                <!-- Live Operational Beacon -->
                <div class="hidden md:inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700/60 text-xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[11px] font-bold text-slate-300">طوارئ 24/7 نشط</span>
                </div>

                <!-- Unread Messages Bell Shortcut -->
                <a href="{{ route('admin.messages.index') }}" 
                   class="relative p-2 rounded-xl bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors border border-slate-700/60" 
                   title="الرسائل وطلبات العملاء">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if($unreadMessagesCount > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white rounded-full text-[9px] font-black flex items-center justify-center animate-pulse">
                            {{ $unreadMessagesCount }}
                        </span>
                    @endif
                </a>

                <!-- Theme Toggle Button -->
                <button type="button" 
                        onclick="window.toggleSiteTheme()" 
                        class="p-2 rounded-xl bg-slate-800 hover:bg-slate-750 text-slate-300 hover:text-white transition-colors cursor-pointer border border-slate-700/60" 
                        title="تبديل المظهر النهاري / الليلي" 
                        aria-label="تبديل المظهر">
                    <svg class="w-4 h-4 theme-icon-sun text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg class="w-4 h-4 theme-icon-moon text-blue-400" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>

                <!-- Live External Site Link -->
                <a href="{{ route('home') }}" 
                   target="_blank" 
                   class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-xl bg-amber-500/10 hover:bg-amber-500 text-amber-400 hover:text-slate-950 border border-amber-500/30 transition-all shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="hidden sm:inline">معاينة المتجر</span>
                </a>
            </div>
        </header>

        <!-- Flash Alerts & Notifications -->
        <div class="px-4 sm:px-8 pt-6">
            @if(session('success'))
                <div id="alert-success" class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-bold text-xs sm:text-sm flex items-center justify-between gap-3 shadow-md">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="document.getElementById('alert-success').remove()" class="p-1 text-emerald-400 hover:text-white" aria-label="إغلاق التنبيه">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div id="alert-error" class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 font-bold text-xs sm:text-sm flex items-start justify-between gap-3 shadow-md">
                    <div class="flex items-start gap-2.5">
                        <svg class="w-5 h-5 shrink-0 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <div>
                            @if(session('error'))
                                <div>{{ session('error') }}</div>
                            @endif
                            @if($errors->any())
                                <ul class="list-disc list-inside space-y-0.5 mt-1">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('alert-error').remove()" class="p-1 text-red-400 hover:text-white" aria-label="إغلاق التنبيه">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Main Workspace Canvas -->
        <main class="flex-1 p-4 sm:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Client-side Interactive Scripts for Modern Sidebar Behavior -->
    <script>
        function toggleMobileSidebar(open) {
            const drawer = document.getElementById('mobile-sidebar');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');
            if (!drawer || !backdrop) return;

            if (open) {
                backdrop.classList.remove('opacity-0', 'pointer-events-none');
                backdrop.classList.add('opacity-100', 'pointer-events-auto');
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
                document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
            } else {
                backdrop.classList.remove('opacity-100', 'pointer-events-auto');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
                drawer.classList.remove('translate-x-0');
                drawer.classList.add('translate-x-full');
                document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
            }
        }

        function handleSidebarToggle() {
            if (window.innerWidth < 1024) {
                const drawer = document.getElementById('mobile-sidebar');
                const isOpen = drawer && !drawer.classList.contains('translate-x-full');
                toggleMobileSidebar(!isOpen);
            } else {
                toggleDesktopSidebar();
            }
        }

        function toggleDesktopSidebar() {
            const isCollapsed = document.documentElement.classList.toggle('sidebar-is-collapsed');
            try {
                localStorage.setItem('admin_sidebar_collapsed', isCollapsed ? 'true' : 'false');
            } catch (e) {}
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggleMobileSidebar(false);
            }
            // Ctrl+B or Cmd+B to toggle sidebar like modern IDEs and Dashboards
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'b') {
                e.preventDefault();
                handleSidebarToggle();
            }
        });
    </script>

</body>
</html>
