@props([
    'name',
    'id' => null,
    'value' => '1',
    'checked' => false,
    'label',
    'subtitle' => null,
    'color' => 'amber', // amber, emerald, red
    'activeBadge' => null,
    'inactiveBadge' => null,
])

@php
    $inputId = $id ?? $name;

    $colorStyles = match($color) {
        'emerald' => [
            'container' => 'has-[:checked]:border-emerald-500/40 has-[:checked]:bg-emerald-500/[0.03]',
            'switch' => 'modern-switch modern-switch-emerald',
            'badge' => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
        ],
        'red' => [
            'container' => 'has-[:checked]:border-red-500/40 has-[:checked]:bg-red-500/[0.03]',
            'switch' => 'modern-switch modern-switch-red',
            'badge' => 'bg-red-500/15 text-red-400 border-red-500/30',
        ],
        default => [
            'container' => 'has-[:checked]:border-amber-500/40 has-[:checked]:bg-amber-500/[0.03]',
            'switch' => 'modern-switch',
            'badge' => 'bg-amber-500/15 text-amber-500 dark:text-amber-400 border-amber-500/30',
        ],
    };
@endphp

<label for="{{ $inputId }}" {{ $attributes->merge(['class' => 'group p-4 sm:p-5 rounded-2xl bg-slate-950 border border-slate-800 hover:border-slate-700 transition-all flex items-center justify-between gap-4 cursor-pointer select-none ' . $colorStyles['container']]) }}>
    <div class="space-y-1 flex-1">
        <div class="flex items-center gap-2">
            <span class="text-xs sm:text-sm font-bold text-white block">{{ $label }}</span>
            @if($activeBadge)
                <span class="hidden group-has-[:checked]:inline-flex text-[10px] font-black px-2 py-0.5 rounded-full {{ $colorStyles['badge'] }} border">
                    {{ $activeBadge }}
                </span>
            @endif
            @if($inactiveBadge)
                <span class="inline-flex group-has-[:checked]:hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700/60">
                    {{ $inactiveBadge }}
                </span>
            @endif
        </div>
        @if($subtitle)
            <span class="text-[11px] text-slate-400 block">{{ $subtitle }}</span>
        @endif
    </div>
    <div class="{{ $colorStyles['switch'] }} shrink-0">
        <input type="checkbox" id="{{ $inputId }}" name="{{ $name }}" value="{{ $value }}" class="modern-switch-input" {{ $checked ? 'checked' : '' }}>
        <span class="modern-switch-track">
            <span class="modern-switch-thumb"></span>
        </span>
    </div>
</label>
