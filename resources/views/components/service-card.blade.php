@props([
    'service',
    'settings' => [],
])

<div {{ $attributes->merge(['class' => 'relative rounded-3xl bg-slate-900 border border-slate-800 p-8 flex flex-col justify-between hover:border-amber-500/50 hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 group hover-brand-card']) }}>
    <div>
        <!-- Top Row: Icon & Emergency Badge -->
        <div class="flex items-start justify-between mb-6">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 flex items-center justify-center font-black shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform">
                @if($service->icon === 'car-key')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                @elseif($service->icon === 'lock-open')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                @elseif($service->icon === 'cpu-chip')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                @elseif($service->icon === 'shield-check')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                @elseif($service->icon === 'truck')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                @else
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                @endif
            </div>

            @if($service->is_emergency)
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                    طوارئ 24/7
                </span>
            @endif
        </div>

        <!-- Service Details -->
        <div class="space-y-3 mb-6">
            @if($service->category)
                <div>
                    <span class="inline-block px-3 py-1 rounded-full bg-slate-800 text-amber-400 text-xs font-bold border border-slate-750">
                        {{ $service->category->name }}
                    </span>
                </div>
            @endif
            <h3 class="text-xl font-bold text-white group-hover:text-amber-400 transition-colors">
                {{ $service->title }}
            </h3>
            <p class="text-sm text-slate-400 leading-relaxed">
                {{ $service->short_description }}
            </p>

            <!-- Features List -->
            @if(!empty($service->features))
                <ul class="space-y-2 pt-2 border-t border-slate-800 text-xs text-slate-300">
                    @foreach($service->features as $feature)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Pricing & Order Button -->
    <div class="pt-4 border-t border-slate-800 flex items-center justify-between gap-3">
        <div>
            @if($service->price_starting_at)
                <span class="text-xs text-slate-400 block">السعر التقديري:</span>
                <span class="text-sm font-black text-amber-400">{{ $service->price_starting_at }}</span>
            @else
                <span class="text-xs text-slate-400">حسب نوع القفل والموديل</span>
            @endif
        </div>

        <a href="https://wa.me/{{ $settings['whatsapp'] ?? '966551234567' }}?text={{ urlencode('مرحباً، أود الاستفسار وطلب خدمة: ' . $service->title) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-800 hover:bg-amber-500 text-slate-200 hover:text-slate-950 font-bold text-xs transition-colors">
            <span>طلب الخدمة</span>
            <svg class="w-3.5 h-3.5 -rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </a>
    </div>
</div>
