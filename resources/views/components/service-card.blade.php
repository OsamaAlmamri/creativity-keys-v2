@props([
    'service',
    'settings' => [],
])

@php
    $whatsappNumber = $settings['whatsapp'] ?? '966568191921';
    $whatsappText = urlencode('مرحباً، أود الاستفسار وطلب خدمة: ' . $service->title);
    $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$whatsappText}";
@endphp

<article {{ $attributes->merge(['class' => 'group relative glass-panel rounded-[2rem] p-5 flex flex-col justify-between hover-brand-card min-w-0']) }}>
    <div>
        <!-- Top Image Card -->
        <a href="{{ route('services.show', $service->slug) }}" class="block mb-5 overflow-hidden rounded-[1.6rem] bg-slate-950 aspect-[4/3] relative">
            <img 
                src="{{ $service->image_url }}" 
                alt="{{ $service->title }}" 
                loading="lazy" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
            
            @if($service->is_emergency)
                <div class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600/95 backdrop-blur-sm text-white text-xs font-bold shadow-md">
                    <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                    <span>طوارئ 24/7</span>
                </div>
            @endif
        </a>

        <!-- Tag & Icon Row -->
        <div class="flex items-center justify-between gap-3 mb-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold tracking-wide">
                {{ $service->badge_text }}
            </span>

            <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-amber-400 flex items-center justify-center">
                @if($service->icon === 'car-key')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                @elseif($service->icon === 'lock-open')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                @elseif($service->icon === 'cpu-chip')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                @elseif($service->icon === 'shield-check')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                @endif
            </div>
        </div>

        <!-- Service Title & Description -->
        <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white leading-snug mb-2.5">
            <a href="{{ route('services.show', $service->slug) }}" class="hover:text-amber-400 transition-colors">
                {{ $service->title }}
            </a>
        </h3>
        
        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 mb-4">
            {{ $service->short_description }}
        </p>

        <!-- Features Bullets (if available) -->
        @if(!empty($service->features))
            <ul class="space-y-2 mb-6 pt-3 border-t border-slate-200/80 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-300">
                @foreach(array_slice($service->features, 0, 3) as $feature)
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="truncate">{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Footer: Price & Details Links -->
    <div class="pt-4 border-t border-slate-200/80 dark:border-slate-800 flex items-center justify-between gap-3 mt-2">
        <div class="min-w-0">
            @if($service->price_starting_at)
                <span class="text-[11px] text-slate-400 block leading-tight">السعر التقديري:</span>
                <span class="text-sm font-extrabold text-amber-600 dark:text-amber-300 text-brand-primary truncate block">{{ $service->price_starting_at }}</span>
            @else
                <span class="text-xs text-slate-400">حسب نوع الموديل</span>
            @endif
        </div>

        <div class="flex items-center gap-2">
            <a 
                href="{{ route('services.show', $service->slug) }}" 
                class="inline-flex items-center gap-1 px-3.5 py-2 rounded-full border border-slate-300/80 dark:border-slate-700 hover:border-amber-400 text-slate-700 dark:text-slate-200 hover:text-amber-400 font-semibold text-xs transition-all duration-300"
            >
                <span>التفاصيل</span>
                <svg class="w-3 h-3 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>

            <a 
                href="{{ $whatsappUrl }}" 
                target="_blank" 
                rel="noopener noreferrer" 
                class="inline-flex items-center gap-1 px-3.5 py-2 rounded-full bg-brand-primary hover:brightness-105 text-slate-950 font-bold text-xs shadow-brand transition-all duration-300"
            >
                <span>طلب</span>
            </a>
        </div>
    </div>
</article>
