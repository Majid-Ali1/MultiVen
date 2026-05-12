@extends('layouts.vendor')

@section('page_title', 'Order #' . $order->order_number)

@section('vendor_content')
<div class="space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('vendor.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-800 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Orders
        </a>
        <h2 class="text-2xl font-black text-gray-900">Order #{{ $order->order_number }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Order Info -->
        <div class="md:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm p-6 space-y-6">
            <h3 class="font-black text-gray-800">Your Items in This Order</h3>
            <div class="space-y-4">
                @foreach($items as $item)
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-black text-lg">
                        {{ substr($item->product->name, 0, 1) }}
                    </div>
                    <div class="flex-grow">
                        <p class="font-bold text-gray-900">{{ $item->product->name }}</p>
                        <p class="text-xs text-gray-500">SKU: {{ $item->product->sku }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-gray-900">${{ number_format($item->price, 2) }}</p>
                        <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Customer & Status -->
        <div class="space-y-4">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-black text-gray-800 mb-4">Customer</h3>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold">
                        {{ substr($order->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">{{ $order->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Order Date</span>
                        <span class="font-semibold">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Payment</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">{{ $order->payment_status }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Fulfillment</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-700">{{ $order->status }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-black text-gray-800 mb-3">Ship To</h3>
                <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                <p class="text-sm text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                <p class="text-sm text-gray-600">{{ $order->shipping_country }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
