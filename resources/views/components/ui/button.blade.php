@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500',
    'secondary' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-indigo-500',
    'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus:ring-emerald-500',
    'danger' => 'bg-rose-600 text-white hover:bg-rose-700 focus:ring-rose-500',
    'ghost' => 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs rounded-md',
    'md' => 'px-4 py-2 text-sm rounded-lg',
    'lg' => 'px-6 py-3 text-base rounded-xl',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
