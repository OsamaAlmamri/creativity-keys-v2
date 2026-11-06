@props([
    'active' => false,
])

<div id="tab-panel-stats" class="tab-panel {{ $active ? '' : 'hidden' }}">
    <form action="{{ route('admin.settings.update-tab', ['tab' => 'stats']) }}" method="POST" class="space-y-8">
        @csrf

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-purple-400"></span>
                    <h3 class="text-base font-bold text-white">أرقام وإحصائيات الثقة (Trust & Stats Badges)</h3>
                </div>
                <span class="text-xs text-purple-400 font-medium">تظهر في بطاقات الثقة وقسم من نحن والصفحة
                    الرئيسية</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="space-y-1.5">
                    <label for="years_experience" class="block text-xs font-bold text-slate-300">سنوات الخبرة</label>
                    <input type="text" id="years_experience" name="years_experience"
                        value="{{ \App\Models\Setting::get('years_experience', '15+') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-purple-400 focus:outline-none text-center">
                </div>

                <div class="space-y-1.5">
                    <label for="arrival_time" class="block text-xs font-bold text-slate-300">سرعة الوصول للطوارئ</label>
                    <input type="text" id="arrival_time" name="arrival_time"
                        value="{{ \App\Models\Setting::get('arrival_time', '15 - 25 دقيقة') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-purple-400 focus:outline-none text-center">
                </div>

                <div class="space-y-1.5">
                    <label for="happy_clients" class="block text-xs font-bold text-slate-300">العملاء المخدومين</label>
                    <input type="text" id="happy_clients" name="happy_clients"
                        value="{{ \App\Models\Setting::get('happy_clients', '18,500+') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-purple-400 focus:outline-none text-center">
                </div>

                <div class="space-y-1.5">
                    <label for="team_size" class="block text-xs font-bold text-slate-300">عدد الفنيين</label>
                    <input type="text" id="team_size" name="team_size"
                        value="{{ \App\Models\Setting::get('team_size', '12 فني') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-purple-400 focus:outline-none text-center">
                </div>
            </div>

            <!-- Google Reviews & Testimonials Settings -->
            <div class="border-t border-slate-800 pt-6 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    <h4 class="text-sm font-bold text-white">إعدادات تقييمات Google وبطاقة التقييم العام (Google
                        Reviews)</h4>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label for="google_review_rating" class="block text-xs font-bold text-slate-300">التقييم العام
                            في قوقل (من 5)</label>
                        <input type="text" id="google_review_rating" name="google_review_rating"
                            value="{{ \App\Models\Setting::get('google_review_rating', '4.9') }}"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center font-bold">
                    </div>

                    <div class="space-y-1.5">
                        <label for="google_reviews_count" class="block text-xs font-bold text-slate-300">إجمالي
                            التقييمات / العملاء</label>
                        <input type="text" id="google_reviews_count" name="google_reviews_count"
                            value="{{ \App\Models\Setting::get('google_reviews_count', '185+') }}"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none text-center">
                    </div>

                    <div class="space-y-1.5">
                        <label for="google_reviews_url" class="block text-xs font-bold text-slate-300">رابط التقييمات
                            على خرائط Google</label>
                        <input type="url" id="google_reviews_url" name="google_reviews_url"
                            value="{{ \App\Models\Setting::get('google_reviews_url', 'https://maps.app.goo.gl/5Z8Yifuj6SPKphLK8') }}"
                            dir="ltr"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-xs font-mono focus:border-amber-400 focus:outline-none text-right">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-1.5">
                        <label for="reviews_title" class="block text-xs font-bold text-slate-300">عنوان قسم
                            التقييمات</label>
                        <input type="text" id="reviews_title" name="reviews_title"
                            value="{{ \App\Models\Setting::get('reviews_title', 'ثقة عملائنا هي وسام نعتز به') }}"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label for="reviews_description" class="block text-xs font-bold text-slate-300">وصف قسم
                            التقييمات</label>
                        <input type="text" id="reviews_description" name="reviews_description"
                            value="{{ \App\Models\Setting::get('reviews_description', 'سعداء بتقييمات عملائنا الكرام على Google، والتي تعكس جودة خدمتنا والتزامنا بالدقة والأمان في كل زيارة.') }}"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-white text-sm focus:border-amber-400 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button for Stats -->
        <div class="flex items-center justify-between p-4 bg-slate-900/60 border border-slate-800 rounded-2xl">
            <span class="text-xs text-slate-400">تحديث فوري لأرقام الإحصائيات وبطاقات الثقة بالواجهة.</span>
            <button type="submit"
                class="px-8 py-3 rounded-xl bg-purple-500 hover:bg-purple-400 text-white font-black text-sm transition-all shadow-lg shadow-purple-500/20 active:scale-95 inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                حفظ إحصائيات وأرقام الثقة
            </button>
        </div>
    </form>
</div>