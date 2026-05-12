@extends('layouts.admin')

@section('page_title', 'Product Management')

@section('admin_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-gray-900">All Marketplace Products</h2>
        <div class="flex gap-2">
            <x-ui.button variant="secondary">Filter</x-ui.button>
            <x-ui.button tag="a" href="{{ route('admin.products.create') }}">Add Product</x-ui.button>
        </div>
    </div>

    <x-ui.card>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                        <th class="pb-3 px-4 font-bold">Product</th>
                        <th class="pb-3 px-4 font-bold">Vendor</th>
                        <th class="pb-3 px-4 font-bold">Category</th>
                        <th class="pb-3 px-4 font-bold">Price</th>
                        <th class="pb-3 px-4 font-bold">Stock</th>
                        <th class="pb-3 px-4 font-bold">Status</th>
                        <th class="pb-3 px-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($products as $product)
                        <tr class="text-sm hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center font-black text-indigo-600 overflow-hidden">
                                        @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($product->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 line-clamp-1">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500 font-mono">{{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-600">Master Catalog</td>
                            <td class="py-4 px-4 text-gray-600">{{ $product->category->name }}</td>
                            <td class="py-4 px-4 font-black text-gray-900">${{ number_format($product->price, 2) }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $product->quantity }}</td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $product->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg" title="Edit Product">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg" title="Delete Product">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </x-ui.card>
</div>
@endsection
