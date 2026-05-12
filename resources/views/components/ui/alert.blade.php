@props(['type' => 'info', 'title' => null])

@php
$variants = [
    'info' => [
        'bg' => 'bg-blue-50',
        'border' => 'border-blue-200',
        'text' => 'text-blue-800',
        'icon_color' => 'text-blue-400',
        'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
    ],
    'success' => [
        'bg' => 'bg-emerald-50',
        'border' => 'border-emerald-200',
        'text' => 'text-emerald-800',
        'icon_color' => 'text-emerald-400',
        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
    ],
    'warning' => [
        'bg' => 'bg-amber-50',
        'border' => 'border-amber-200',
        'text' => 'text-amber-800',
        'icon_color' => 'text-amber-400',
        'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
    ],
    'error' => [
        'bg' => 'bg-rose-50',
        'border' => 'border-rose-200',
        'text' => 'text-rose-800',
        'icon_color' => 'text-rose-400',
        'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'
    ],
];

$variant = $variants[$type] ?? $variants['info'];
@endphp

<div {{ $attributes->merge(['class' => "{$variant['bg']} border {$variant['border']} rounded-xl p-4 transition-all duration-300"]) }} role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 {{ $variant['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $variant['icon'] }}"></path>
            </svg>
        </div>
        <div class="ml-3">
            @if($title)
                <h3 class="text-sm font-bold {{ $variant['text'] }}">
                    {{ $title }}
                </h3>
            @endif
            <div class="text-sm {{ $variant['text'] }} {{ $title ? 'mt-1' : '' }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
