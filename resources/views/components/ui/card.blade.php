@props(['title' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                {{ $title }}
            </h3>
            @if(isset($action))
                <div>{{ $action }}</div>
            @endif
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>
