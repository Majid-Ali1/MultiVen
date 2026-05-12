@extends('layouts.vendor')

@section('page_title', 'My Store Products')

@section('vendor_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-900">My Store Products</h2>
            <p class="text-sm text-gray-500">Manage your retail prices for imported products.</p>
        </div>
        <x-ui.button variant="primary" onclick="window.location='{{ route('vendor.products.catalog') }}'">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Browse Master Catalog
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

    <x-ui.card class="p-0 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Wholesale Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Your Retail Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-gray-100 mr-3 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">SKU: {{ $product->sku }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-500">${{ number_format($product->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('vendor.products.updatePrice', $product) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <div class="relative rounded-md shadow-sm w-32">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="vendor_price" step="0.01" min="{{ $product->price }}" value="{{ old('vendor_price', $product->pivot->vendor_price ?? $product->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md py-1" required>
                                </div>
                                <button type="submit" class="text-xs bg-indigo-50 text-indigo-700 hover:bg-indigo-100 px-2 py-1 rounded font-medium border border-indigo-200">Save</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->quantity }} units</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold" onclick="return confirm('Remove this product from your store?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500 mb-4">You haven't imported any products yet.</div>
                            <x-ui.button variant="outline" onclick="window.location='{{ route('vendor.products.catalog') }}'">Browse Catalog</x-ui.button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-ui.card>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
