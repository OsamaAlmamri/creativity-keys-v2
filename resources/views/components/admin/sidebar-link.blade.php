@props([
    'href' => '#',
    'active' => false,
    'title' => '',
    'badge' => null,
])

<a href="{{ $href }}" title="{{ $title ?: strip_tags($slot) }}" {{ $attributes->merge([
    'class' => 'group flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all relative ' . (
        $active
        ? 'bg-amber-500 text-white font-black shadow-md shadow-amber-500/20'
        : 'text-slate-300 hover:bg-slate-800 hover:text-white'
    )
]) }}>
    <div
        class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 transition-colors {{ $active ? 'bg-slate-950/15 text-white' : 'bg-slate-800/60 text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-400/10' }}">
        {{ $icon }}
    </div>

    <span class="sidebar-text truncate">{{ $slot }}</span>

    @if(!is_null($badge) && $badge > 0)
        <span
            class="sidebar-badge mr-auto px-2 py-0.5 rounded-full text-[10px] font-black {{ $active ? 'bg-slate-950 text-white' : 'bg-red-500 text-white animate-pulse' }}">
            {{ $badge }}
        </span>
    @endif
</a>