@extends('layouts.admin')

@section('title', 'Admin Dashboard - MultiVen')

@section('admin_content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Dashboard Overview</h1>
        <p class="text-gray-500 mt-1">Welcome back, Admin. Here's what's happening today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-ui.card class="bg-indigo-600 text-white border-none shadow-indigo-100">
            <p class="text-indigo-100 text-sm font-bold uppercase tracking-wider">Total Revenue</p>
            <h3 class="text-3xl font-black mt-2">${{ number_format($stats['total_sales'], 2) }}</h3>
            <p class="text-indigo-200 text-xs mt-4 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                +12.5% from last month
            </p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Orders</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['total_orders'] }}</h3>
            <p class="text-emerald-600 text-xs mt-4 font-bold">{{ $stats['pending_orders'] }} Pending Approval</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Active Products</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['total_products'] }}</h3>
            <p class="text-gray-400 text-xs mt-4">{{ $stats['total_categories'] }} Categories</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Customers</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">{{ $stats['total_users'] }}</h3>
            <p class="text-indigo-600 text-xs mt-4 font-bold">8 New this week</p>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Orders -->
        <x-ui.card title="Recent Orders">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                            <th class="pb-3 font-bold">Order ID</th>
                            <th class="pb-3 font-bold">Customer</th>
                            <th class="pb-3 font-bold">Amount</th>
                            <th class="pb-3 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recent_orders as $order)
                            <tr class="text-sm">
                                <td class="py-4 font-bold text-gray-900">#{{ $order->order_number }}</td>
                                <td class="py-4 text-gray-600">{{ $order->user->name }}</td>
                                <td class="py-4 font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                    View all orders
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </x-ui.card>

        <!-- Recent Products -->
        <x-ui.card title="New Product Submissions">
            <div class="space-y-4">
                @foreach($recent_products as $product)
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center font-black text-indigo-600">
                                {{ substr($product->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-900">{{ $product->name }}</h4>
                                <p class="text-xs text-gray-500">by {{ $product->vendor->name }} • {{ $product->category->name }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                            <button class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                    View all submissions
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
