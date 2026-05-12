@props(['variant' => 'indigo'])

@php
$variants = [
    'indigo' => 'bg-indigo-50 text-indigo-700 ring-indigo-700/10',
    'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10',
    'rose' => 'bg-rose-50 text-rose-700 ring-rose-600/10',
    'amber' => 'bg-amber-50 text-amber-800 ring-amber-600/20',
    'gray' => 'bg-gray-50 text-gray-600 ring-gray-500/10',
    'blue' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
];

$classes = "inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset " . ($variants[$variant] ?? $variants['indigo']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
