@props([
    'icon',
    'color' => 'indigo',
    'title',
    'href',
    'count' => null,
    'countData' => null,
])

@php
    $count = $count ?? $countData ?? 0;

    $colorMaps = [
        'indigo' => [
            'bg' => 'bg-indigo-50 dark:bg-indigo-950/50',
            'text' => 'text-indigo-600 dark:text-indigo-400',
        ],
        'emerald' => [
            'bg' => 'bg-emerald-50 dark:bg-emerald-950/50',
            'text' => 'text-emerald-600 dark:text-emerald-400',
        ],
        'pink' => [
            'bg' => 'bg-pink-50 dark:bg-pink-950/50',
            'text' => 'text-pink-600 dark:text-pink-400',
        ],
        'amber' => [
            'bg' => 'bg-amber-50 dark:bg-amber-950/50',
            'text' => 'text-amber-600 dark:text-amber-400',
        ],
        'blue' => [
            'bg' => 'bg-blue-50 dark:bg-blue-950/50',
            'text' => 'text-blue-600 dark:text-blue-400',
        ],
        'red' => [
            'bg' => 'bg-red-50 dark:bg-red-950/50',
            'text' => 'text-red-600 dark:text-red-400',
        ],
        'green' => [
            'bg' => 'bg-green-50 dark:bg-green-950/50',
            'text' => 'text-green-600 dark:text-green-400',
        ],
        'yellow' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-950/50',
            'text' => 'text-yellow-600 dark:text-yellow-400',
        ],
        'purple' => [
            'bg' => 'bg-purple-50 dark:bg-purple-950/50',
            'text' => 'text-purple-600 dark:text-purple-400',
        ],
        'violet' => [
            'bg' => 'bg-violet-50 dark:bg-violet-950/50',
            'text' => 'text-violet-600 dark:text-violet-400',
        ],
        'fuchsia' => [
            'bg' => 'bg-fuchsia-50 dark:bg-fuchsia-950/50',
            'text' => 'text-fuchsia-600 dark:text-fuchsia-400',
        ],
        'rose' => [
            'bg' => 'bg-rose-50 dark:bg-rose-950/50',
            'text' => 'text-rose-600 dark:text-rose-400',
        ],
        'cyan' => [
            'bg' => 'bg-cyan-50 dark:bg-cyan-950/50',
            'text' => 'text-cyan-600 dark:text-cyan-400',
        ],
        'sky' => [
            'bg' => 'bg-sky-50 dark:bg-sky-950/50',
            'text' => 'text-sky-600 dark:text-sky-400',
        ],
        'teal' => [
            'bg' => 'bg-teal-50 dark:bg-teal-950/50',
            'text' => 'text-teal-600 dark:text-teal-400',
        ],
        'orange' => [
            'bg' => 'bg-orange-50 dark:bg-orange-950/50',
            'text' => 'text-orange-600 dark:text-orange-400',
        ],
    ];

    $colors = $colorMaps[$color] ?? $colorMaps['indigo'];
@endphp

<a href="{{ $href }}" wire:navigate {{ $attributes->merge(['class' => 'group block relative overflow-hidden bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1']) }}>
    <div class="absolute top-0 right-0 p-2 opacity-5 group-hover:opacity-10 transition-opacity">
        <flux:icon name="{{ $icon }}" class="size-28 text-slate-900 dark:text-white" />
    </div>
    <div class="flex items-center gap-4">
        <div class="p-3 {{ $colors['bg'] }} rounded-xl {{ $colors['text'] }} group-hover:scale-110 transition-transform duration-300">
            <flux:icon name="{{ $icon }}" class="size-8" />
        </div>
        <div>
            <span class="block text-sm font-semibold text-slate-500 dark:text-zinc-400">{{ $title }}</span>
            <span class="block text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $count }}</span>
        </div>
    </div>
    <div class="mt-2 flex items-center gap-1.5 text-xs font-bold {{ $colors['text'] }} opacity-0 group-hover:opacity-100 transition-opacity">
        <span>Lihat Detail {{ $title }}</span>
        <flux:icon name="arrow-right" class="size-3.5" />
    </div>
</a>
