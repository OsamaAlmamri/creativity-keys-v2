@props([
    'href' => '#',
    'active' => false,
    'variant' => 'desktop', // desktop, mobile, footer
    'highlight' => false,
])

@php
    $baseClasses = match($variant) {
        'mobile' => 'block px-3.5 py-2.5 rounded-xl text-sm font-bold transition-all ' . (
            $active
                ? 'bg-amber-500/15 text-amber-400 border border-amber-500/30 font-black'
                : ($highlight ? 'text-amber-400 hover:bg-slate-800/80 hover:text-amber-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white')
        ),
        'footer' => 'text-sm text-slate-400 hover:text-amber-400 transition-colors inline-block',
        default => 'text-sm font-semibold transition-colors duration-200 ' . (
            $active
                ? 'text-amber-500 dark:text-amber-400 font-bold'
                : ($highlight ? 'text-amber-500 dark:text-amber-400 font-bold' : 'text-slate-700 dark:text-slate-200 hover:text-amber-500 dark:hover:text-amber-400')
        ),
    };
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
    {{ $slot }}
</a>
