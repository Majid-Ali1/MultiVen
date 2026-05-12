@extends('layouts.storefront')

@section('title', 'Order Confirmed - MultiVen')

@section('storefront_content')
<div class="min-h-screen py-12 px-4 bg-gray-50">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-emerald-600 p-8 text-center text-white">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-3xl font-black tracking-tight">Order Confirmed!</h1>
                <p class="text-emerald-100 mt-2 font-medium">Thank you for your purchase. Your order is now being processed.</p>
            </div>

            <div class="p-8 space-y-8">
                <div class="flex justify-between items-center border-b border-gray-50 pb-6">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Order Number</p>
                        <p class="text-lg font-black text-gray-900">#{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Date</p>
                        <p class="text-lg font-black text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-black text-gray-900">Order Summary</h3>
                    <div class="bg-gray-50 rounded-2xl p-4 space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $item->product->name }} <span class="text-xs font-bold text-gray-400">x{{ $item->quantity }}</span></span>
                                <span class="font-bold text-gray-900">${{ number_format($item->total, 2) }}</span>
                            </div>
                        @endforeach
                        <div class="pt-3 border-t border-gray-200 flex justify-between items-center">
                            <span class="font-black text-gray-900">Total Paid</span>
                            <span class="text-xl font-black text-indigo-600">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-black text-gray-900 mb-2">Shipping To</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ auth()->user()->name }}<br>
                            {{ $order->shipping_address }}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-black text-gray-900 mb-2">Payment Method</h3>
                        <p class="text-sm text-gray-600">
                            {{ ucfirst($order->payment_method) }}<br>
                            <span class="text-xs font-bold text-emerald-600 uppercase">Paid Successfully</span>
                        </p>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-50 flex gap-4">
                    <a href="{{ route('customer.dashboard') }}" class="flex-grow bg-indigo-600 text-white text-center py-4 rounded-2xl font-black hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100">
                        View Order Status
                    </a>
                    <a href="{{ route('home') }}" class="px-8 bg-gray-100 text-gray-600 text-center py-4 rounded-2xl font-black hover:bg-gray-200 transition-colors">
                        Back to Shop
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
