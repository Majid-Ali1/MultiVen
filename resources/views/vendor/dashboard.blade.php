@extends('layouts.vendor')

@section('title', 'Vendor Dashboard - MultiVen')

@section('vendor_content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Seller Central</h1>
            <p class="text-gray-500 mt-1">Manage your shop and listings.</p>
        </div>
        <x-ui.button onclick="window.location='{{ route('vendor.products.create') }}'" class="shadow-lg shadow-indigo-100">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Product
        </x-ui.button>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-ui.card class="bg-indigo-600 text-white border-none shadow-indigo-100">
            <p class="text-indigo-100 text-sm font-bold uppercase tracking-wider">Store Revenue</p>
            <h3 class="text-3xl font-black mt-2">${{ number_format($stats['total_sales'], 2) }}</h3>
            <p class="text-indigo-200 text-xs mt-4 flex items-center gap-1">
                Lifetime earnings
            </p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Products</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['total_products'] }}</h3>
            <p class="text-emerald-600 text-xs mt-4 font-bold">{{ $stats['active_products'] }} Active Listings</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Pending Approval</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['pending_products'] }}</h3>
            <p class="text-gray-400 text-xs mt-4">Awaiting admin review</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Customer Reach</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">0</h3>
            <p class="text-indigo-600 text-xs mt-4 font-bold">New followers this week</p>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Recent Products -->
        <x-ui.card title="Your Recent Listings">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                            <th class="pb-3 font-bold">Product</th>
                            <th class="pb-3 font-bold">SKU</th>
                            <th class="pb-3 font-bold">Price</th>
                            <th class="pb-3 font-bold">Stock</th>
                            <th class="pb-3 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recent_products as $product)
                            <tr class="text-sm">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center font-bold text-gray-400">
                                            {{ substr($product->name, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-gray-900">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-600 font-mono text-xs">{{ $product->sku }}</td>
                                <td class="py-4 font-black text-gray-900">${{ number_format($product->price, 2) }}</td>
                                <td class="py-4 text-gray-600">{{ $product->quantity }}</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $product->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                        {{ $product->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <a href="{{ route('vendor.products.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                    View all products
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
