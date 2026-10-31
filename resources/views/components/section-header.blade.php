@props([
    'badge' => null,
    'title' => '',
    'description' => null,
    'centered' => true,
])

<div {{ $attributes->merge(['class' => ($centered ? 'text-center max-w-3xl mx-auto' : 'max-w-3xl') . ' space-y-4 mb-16']) }}>
    @if($badge)
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold shadow-xs">
            {{ $icon ?? '' }}
            <span>{{ $badge }}</span>
        </div>
    @endif

    <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
        {{ $title }}
    </h2>

    @if($description)
        <p class="text-slate-400 text-base leading-relaxed">
            {{ $description }}
        </p>
    @endif

    {{ $slot }}
</div>
