@props([
    'variant' => 'slate', // emerald, amber, red, blue, purple, slate
    'size' => 'sm',       // xs, sm
    'dot' => false,
    'ping' => false,
])

@php
    $variantClasses = match($variant) {
        'emerald' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        'amber' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
        'red' => 'bg-red-500/10 text-red-400 border-red-500/20',
        'blue' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
        'purple' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
        default => 'bg-slate-800 text-slate-400 border-slate-700/60',
    };

    $dotColor = match($variant) {
        'emerald' => 'bg-emerald-500',
        'amber' => 'bg-amber-400',
        'red' => 'bg-red-500',
        'blue' => 'bg-blue-400',
        'purple' => 'bg-purple-400',
        default => 'bg-slate-400',
    };

    $sizeClasses = match($size) {
        'xs' => 'px-2 py-0.5 text-[10px]',
        default => 'px-2.5 py-1 text-xs',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full font-bold border {$sizeClasses} {$variantClasses}"]) }}>
    @if($dot || $ping)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }} {{ $ping ? 'animate-ping' : '' }}"></span>
    @endif
    {{ $slot }}
</span>
