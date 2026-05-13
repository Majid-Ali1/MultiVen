@extends('layouts.vendor')

@section('page_title', 'Master Catalog')

@section('vendor_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Master Catalog</h2>
            <p class="text-sm text-gray-500">Browse available products to import and sell in your store.</p>
        </div>
        <x-ui.button variant="outline" onclick="window.location='{{ route('vendor.products.index') }}'">
            View My Store
        </x-ui.button>
    </div>

    @if(session('success'))
        <x-ui.alert type="success">
            {{ session('success') }}
        </x-ui.alert>
    @endif
    
    @if(session('error'))
        <x-ui.alert type="error">
            {{ session('error') }}
        </x-ui.alert>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <x-ui.card class="flex flex-col h-full overflow-hidden hover:shadow-lg transition-shadow">
                <!-- Image Placeholder -->
                <div class="h-48 bg-gray-100 flex items-center justify-center relative">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    @if($product->sale_price)
                        <div class="absolute top-2 right-2 bg-rose-500 text-white text-xs font-bold px-2 py-1 rounded">Sale</div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="p-4 flex-grow flex flex-col">
                    <div class="text-xs text-indigo-600 font-semibold mb-1 uppercase tracking-wide">{{ $product->category->name ?? 'Category' }}</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight line-clamp-2">{{ $product->name }}</h3>
                    <div class="text-xs text-gray-500 mb-3">SKU: {{ $product->sku }}</div>
                    
                    <div class="mt-auto">
                        <div class="flex items-end justify-between mb-4">
                            <div>
                                <div class="text-xs text-gray-500 uppercase font-semibold">Wholesale</div>
                                <div class="text-xl font-black text-gray-900">${{ number_format($product->price, 2) }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500 uppercase font-semibold">Stock</div>
                                <div class="text-sm font-medium {{ $product->quantity > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $product->quantity }} available
                                </div>
                            </div>
                        </div>

                        <!-- Import Form -->
                        <form action="{{ route('vendor.products.import') }}" method="POST" class="pt-4 border-t border-gray-100">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="mb-3">
                                <label for="vendor_price_{{ $product->id }}" class="block text-xs font-medium text-gray-700 mb-1">Set Your Retail Price</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="vendor_price" id="vendor_price_{{ $product->id }}" step="0.01" min="{{ $product->price }}" value="{{ number_format($product->price * 1.3, 2, '.', '') }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md py-2" required>
                                </div>
                                <p class="mt-1 text-[10px] text-gray-500">Min: ${{ number_format($product->price, 2) }}</p>
                            </div>
                            
                            <x-ui.button type="submit" variant="primary" class="w-full justify-center" @disabled($product->quantity <= 0)>
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Import to Store
                            </x-ui.button>
                        </form>
                    </div>
                </div>
            </x-ui.card>
        @empty
            <div class="col-span-full">
                <x-ui.card class="p-12 text-center text-gray-500 italic">
                    No products available in the master catalog right now.
                </x-ui.card>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
