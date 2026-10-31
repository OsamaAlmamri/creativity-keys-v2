@extends('admin.layouts.app')

@section('page_title', 'إعدادات وبيانات المحل')

@section('content')

    <div class="max-w-4xl mx-auto space-y-8">
        
        <div>
            <h2 class="text-xl font-black text-white">إعدادات وبيانات المركز والموقع</h2>
            <p class="text-xs text-slate-400">تعديل بيانات الاتصال، خط الطوارئ، العنوان، خريطة قوقل، والنصوص الرئيسية</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- 1. General Info -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    المعلومات العامة والهوية
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="site_name" class="block text-xs font-bold text-slate-300">اسم المحل / المركز</label>
                        <input type="text" id="site_name" name="site_name" value="{{ \App\Models\Setting::get('site_name', 'مفاتيح الأمان الذهبية') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label for="site_tagline" class="block text-xs font-bold text-slate-300">الشعار اللفظي (Tagline)</label>
                        <input type="text" id="site_tagline" name="site_tagline" value="{{ \App\Models\Setting::get('site_tagline') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="meta_description" class="block text-xs font-bold text-slate-300">وصف محركات البحث (SEO)</label>
                    <textarea id="meta_description" name="meta_description" rows="2" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">{{ \App\Models\Setting::get('meta_description') }}</textarea>
                </div>
            </div>

            <!-- 2. Contact Numbers & Emergency -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                    أرقام الاتصال وخطوط الطوارئ 24/7
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="emergency_phone" class="block text-xs font-bold text-red-400">رقم خط الطوارئ السريع (24 ساعة)</label>
                        <input type="text" id="emergency_phone" name="emergency_phone" value="{{ \App\Models\Setting::get('emergency_phone', '0559998877') }}" dir="ltr" class="w-full bg-slate-950 border border-red-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-red-400 focus:outline-none text-right font-mono">
                    </div>

                    <div class="space-y-1.5">
                        <label for="phone" class="block text-xs font-bold text-slate-300">رقم الهاتف الأرضي أو الثابت</label>
                        <input type="text" id="phone" name="phone" value="{{ \App\Models\Setting::get('phone', '0551234567') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-right font-mono">
                    </div>

                    <div class="space-y-1.5">
                        <label for="whatsapp" class="block text-xs font-bold text-emerald-400">رقم الواتساب (مع الرمز الدولي بدون +)</label>
                        <input type="text" id="whatsapp" name="whatsapp" value="{{ \App\Models\Setting::get('whatsapp', '966551234567') }}" dir="ltr" class="w-full bg-slate-950 border border-emerald-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none text-right font-mono" placeholder="966551234567">
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-300">البريد الإلكتروني الرسمي</label>
                        <input type="email" id="email" name="email" value="{{ \App\Models\Setting::get('email', 'info@keyshop.com') }}" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-right">
                    </div>
                </div>
            </div>

            <!-- 3. Address & Google Map -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span>
                    العنوان وموقع خريطة قوقل (Google Maps)
                </h3>

                <div class="space-y-1.5">
                    <label for="address" class="block text-xs font-bold text-slate-300">العنوان التفصيلي للمحل</label>
                    <input type="text" id="address" name="address" value="{{ \App\Models\Setting::get('address') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="working_hours" class="block text-xs font-bold text-slate-300">ساعات الدوام والعمل</label>
                    <input type="text" id="working_hours" name="working_hours" value="{{ \App\Models\Setting::get('working_hours') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="google_map_embed" class="block text-xs font-bold text-slate-300">رابط تضمين خريطة قوقل (Google Maps Embed URL)</label>
                    <textarea id="google_map_embed" name="google_map_embed" rows="3" dir="ltr" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-xs font-mono focus:border-amber-400 focus:outline-none">{{ \App\Models\Setting::get('google_map_embed') }}</textarea>
                    <p class="text-[11px] text-slate-500">انسخ رابط src من كود التضمين في قوقل ماب وضعه هنا.</p>
                </div>
            </div>

            <!-- 4. Stats & Trust -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    أرقام وإحصائيات الثقة
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="space-y-1.5">
                        <label for="years_experience" class="block text-xs font-bold text-slate-300">سنوات الخبرة</label>
                        <input type="text" id="years_experience" name="years_experience" value="{{ \App\Models\Setting::get('years_experience', '15+') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                    <div class="space-y-1.5">
                        <label for="arrival_time" class="block text-xs font-bold text-slate-300">سرعة الوصول للطوارئ</label>
                        <input type="text" id="arrival_time" name="arrival_time" value="{{ \App\Models\Setting::get('arrival_time', '15-25 دقيقة') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                    <div class="space-y-1.5">
                        <label for="happy_clients" class="block text-xs font-bold text-slate-300">العملاء المخدومين</label>
                        <input type="text" id="happy_clients" name="happy_clients" value="{{ \App\Models\Setting::get('happy_clients', '18,500+') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                    <div class="space-y-1.5">
                        <label for="team_size" class="block text-xs font-bold text-slate-300">عدد الفنيين</label>
                        <input type="text" id="team_size" name="team_size" value="{{ \App\Models\Setting::get('team_size', '12 فني') }}" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-2">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm transition-colors shadow-xl shadow-amber-500/20 active:scale-95">
                    حفظ كافة الإعدادات وتحديث الموقع
                </button>
            </div>
        </form>

    </div>

@endsection
