@props([
    'active' => false,
])

<div id="tab-panel-coverage" class="tab-panel {{ $active ? '' : 'hidden' }}">
    <form action="{{ route('admin.settings.update-tab', ['tab' => 'coverage']) }}" method="POST" class="space-y-8">
        @csrf

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    <h3 class="text-base font-bold text-white">نطاق التغطية والخدمات الميدانية (Coverage Scope)</h3>
                </div>
                <span class="text-xs text-amber-400 font-medium">تظهر في كرت الطوارئ بالهيرو وشريط التنبيهات</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label for="coverage_areas" class="block text-xs font-bold text-slate-300">أحياء ونطاق التغطية
                        الفورية</label>
                    <textarea id="coverage_areas" name="coverage_areas" rows="3"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none"
                        placeholder="مثال: الروضة • السلامة • الزهراء • الشاطئ • الحمراء • المروة • الصفا • أبحر">{{ \App\Models\Setting::get('coverage_areas', 'الروضة • السلامة • الزهراء • الشاطئ • الحمراء • المروة • الصفا • أبحر') }}</textarea>
                    <p class="text-[11px] text-slate-400">افصل بين الأحياء بنقطة أو فاصلة لتظهر بشكل متناسق في شريط
                        التغطية الحي.</p>
                </div>

                <div class="space-y-1.5">
                    <label for="coverage_note" class="block text-xs font-bold text-slate-300">ملاحظة تغطية شريط الطوارئ
                        العلوي</label>
                    <input type="text" id="coverage_note" name="coverage_note"
                        value="{{ \App\Models\Setting::get('coverage_note', 'ورش متنقلة وفنيون مرخصون لجميع الأحياء والمناطق') }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none">
                    <p class="text-[11px] text-slate-400">تظهر في الشريط البرتقالي بأعلى الصفحة لجذب انتباه العميل
                        للخدمة السريعة.</p>
                </div>
            </div>
        </div>

        <!-- Submit Button for Coverage -->
        <div class="flex items-center justify-between p-4 bg-slate-900/60 border border-slate-800 rounded-2xl">
            <span class="text-xs text-slate-400">تحديث فوري لبيانات التغطية في الصفحة الرئيسية وشريط التنبيهات.</span>
            <button type="submit"
                class="px-8 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-white font-black text-sm transition-all shadow-lg shadow-amber-500/20 active:scale-95 inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                حفظ نطاق التغطية
            </button>
        </div>
    </form>
</div>