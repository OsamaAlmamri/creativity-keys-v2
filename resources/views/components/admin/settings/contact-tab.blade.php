@props([
    'active' => false,
])

<div id="tab-panel-contact" class="tab-panel {{ $active ? '' : 'hidden' }}">
    <form action="{{ route('admin.settings.update-tab', ['tab' => 'contact']) }}" method="POST" class="space-y-8">
        @csrf

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                    <h3 class="text-base font-bold text-white">أرقام الاتصال وخطوط الطوارئ السريعة (24/7)</h3>
                </div>
                <span class="text-xs text-red-400 font-medium">تظهر في الأزرار العائمة وشريط الهيدر والفوتر</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label for="emergency_phone" class="block text-xs font-bold text-red-400">
                        رقم خط الطوارئ السريع (24 ساعة) <span class="text-red-400">*</span>
                    </label>
                    <input type="text" id="emergency_phone" name="emergency_phone" required
                        value="{{ \App\Models\Setting::get('emergency_phone', '0559998877') }}" dir="ltr"
                        class="w-full bg-slate-950 border border-red-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-red-400 focus:outline-none text-right font-mono">
                    <p class="text-[11px] text-slate-500">الرقم المخصص للحالات الطارئة وفتح الأبواب الفوري.</p>
                </div>

                <div class="space-y-1.5">
                    <label for="phone" class="block text-xs font-bold text-slate-300">رقم الهاتف الأرضي أو الثابت</label>
                    <input type="text" id="phone" name="phone"
                        value="{{ \App\Models\Setting::get('phone', '0551234567') }}" dir="ltr"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-right font-mono">
                    <p class="text-[11px] text-slate-500">رقم الاتصال المباشر بالمعرض الرئيسي للاستفسارات العامة.</p>
                </div>

                <div class="space-y-1.5">
                    <label for="whatsapp" class="block text-xs font-bold text-emerald-400">رقم الواتساب (مع الرمز الدولي بدون +)</label>
                    <input type="text" id="whatsapp" name="whatsapp"
                        value="{{ \App\Models\Setting::get('whatsapp', '966551234567') }}" dir="ltr"
                        class="w-full bg-slate-950 border border-emerald-500/30 rounded-xl px-4 py-3 text-white text-sm focus:border-emerald-400 focus:outline-none text-right font-mono"
                        placeholder="966551234567">
                    <p class="text-[11px] text-slate-500">يستخدم لزر المحادثة الفورية وتطبيق واتساب.</p>
                </div>

                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-slate-300">البريد الإلكتروني الرسمي</label>
                    <input type="email" id="email" name="email"
                        value="{{ \App\Models\Setting::get('email', 'info@keyshop.com') }}" dir="ltr"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white text-sm focus:border-amber-400 focus:outline-none text-right">
                    <p class="text-[11px] text-slate-500">يظهر في الفوتر ويُستخدم لاستقبال الإشعارات والمراسلات الرسمية.</p>
                </div>
            </div>
        </div>

        <!-- Submit Button for Contact -->
        <div class="flex items-center justify-between p-4 bg-slate-900/60 border border-slate-800 rounded-2xl">
            <span class="text-xs text-slate-400">تحديث فوري لأرقام الاتصال وأزرار الاتصال السريع بالموقع.</span>
            <button type="submit"
                class="px-8 py-3 rounded-xl bg-red-500 hover:bg-red-400 text-slate-950 font-black text-sm transition-all shadow-lg shadow-red-500/20 active:scale-95 inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                حفظ أرقام الاتصال والطوارئ
            </button>
        </div>
    </form>
</div>
