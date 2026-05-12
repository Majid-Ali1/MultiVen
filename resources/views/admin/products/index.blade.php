@extends('layouts.admin')

@section('page_title', 'Product Management')

@section('admin_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-gray-900">All Marketplace Products</h2>
        <div class="flex gap-2">
            <x-ui.button variant="secondary">Filter</x-ui.button>
            <x-ui.button>Export List</x-ui.button>
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
                            <td class="py-4 px-4 text-gray-600">{{ $product->vendor->name }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $product->category->name }}</td>
                            <td class="py-4 px-4 font-black text-gray-900">${{ number_format($product->price, 2) }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $product->quantity }}</td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $product->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                                <div class="flex justify-end gap-2">
                                    @if($product->status === 'pending')
                                        <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg" title="Approve">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.products.reject', $product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg" title="Reject">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                    <button class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </div>
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
