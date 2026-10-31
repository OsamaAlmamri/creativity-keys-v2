<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>تسجيل الدخول إلى لوحة التحكم | مفتاح باب البستان</title>

    @php
        $siteFavicon = \App\Models\Setting::get('site_favicon');
        $loginLogo = \App\Models\Setting::get('site_logo');
        $siteName = \App\Models\Setting::get('site_name', 'مفتاح باب البستان');
    @endphp

    @if(!empty($siteFavicon))
        <link rel="icon" href="{{ $siteFavicon }}">
        <link rel="apple-touch-icon" href="{{ $siteFavicon }}">
    @else
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23f59e0b'><path d='M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'/></svg>">
    @endif

    @include('partials.theme-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 selection:bg-amber-500 selection:text-slate-950">

    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8 space-y-3">
            @if(!empty($loginLogo))
                <div class="h-16 flex items-center justify-center p-2 rounded-3xl bg-slate-900 border border-slate-800 shadow-2xl max-w-[220px] mx-auto">
                    <img src="{{ $loginLogo }}" alt="{{ $siteName }}" class="max-h-full max-w-full object-contain">
                </div>
            @else
                <div class="w-16 h-16 rounded-3xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shadow-2xl shadow-amber-500/20 mx-auto">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
            @endif
            <h1 class="text-2xl font-black text-white">لوحة تحكم {{ $siteName }}</h1>
            <p class="text-xs text-slate-400">سجل الدخول لإدارة الخدمات، الطلبات، ومعرض الأعمال</p>
        </div>

        <!-- Login Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl space-y-6">
            
            @if(session('info'))
                <div class="p-3 rounded-xl bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-bold text-center">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold space-y-1">
                    @foreach($errors->all() as $err)
                        <div>• {{ $err }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-slate-300">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@keyshop.com') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm" placeholder="admin@keyshop.com" dir="ltr">
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold text-slate-300">كلمة المرور</label>
                    <input type="password" id="password" name="password" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 text-sm" placeholder="••••••••" dir="ltr">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-slate-400 cursor-pointer">
                        <input type="checkbox" name="remember" value="1" class="rounded border-slate-800 bg-slate-950 text-amber-500 focus:ring-amber-400">
                        <span>تذكرني على هذا الجهاز</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-sm transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                    تسجيل الدخول
                </button>
            </form>

            <!-- Quick Demo Credentials Box -->
            <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 text-xs space-y-2">
                <div class="text-amber-400 font-bold">بيانات تجربة الدخول الجاهزة:</div>
                <div class="text-slate-400 flex justify-between">
                    <span>المدير العام:</span>
                    <span dir="ltr" class="font-mono text-white">admin@keyshop.com</span>
                </div>
                <div class="text-slate-400 flex justify-between">
                    <span>مشرف الفرع:</span>
                    <span dir="ltr" class="font-mono text-white">manager@keyshop.com</span>
                </div>
                <div class="text-slate-400 flex justify-between border-t border-slate-850 pt-1">
                    <span>كلمة المرور:</span>
                    <span dir="ltr" class="font-mono text-amber-300">password123</span>
                </div>
            </div>

            <!-- Back to site -->
            <div class="text-center pt-2">
                <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white transition-colors inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    <span>العودة إلى واجهة الموقع الرئيسية</span>
                </a>
            </div>

        </div>
    </div>

</body>
</html>
