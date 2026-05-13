@extends('layouts.storefront')

@section('title', 'Your Shopping Cart - MultiVen')

@section('storefront_content')
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-10">Shopping Cart</h1>

        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
            <!-- Cart Items -->
            <div class="lg:col-span-8">
                @if(count($cart) > 0)
                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
                        <ul class="divide-y divide-gray-100">
                            @foreach($cart as $id => $details)
                                <li class="p-8 flex items-center gap-6">
                                    <div class="h-24 w-24 rounded-2xl bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-100">
                                        @php $imgSrc = str_replace('via.placeholder.com/150', 'placehold.co/150x150', $details['image']); @endphp
                                        <img src="{{ str_starts_with($imgSrc, 'http') ? $imgSrc : asset('storage/' . $imgSrc) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-bold text-gray-900">{{ $details['name'] }}</h3>
                                        <p class="text-sm font-medium text-gray-500 mt-1">Unit Price: ${{ number_format($details['price'], 2) }}</p>
                                        <div class="mt-4 flex items-center justify-between">
                                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                                <button class="px-3 py-1 bg-gray-50 text-gray-600 hover:bg-gray-100">-</button>
                                                <span class="px-4 py-1 text-sm font-bold text-gray-900">{{ $details['quantity'] }}</span>
                                                <button class="px-3 py-1 bg-gray-50 text-gray-600 hover:bg-gray-100">+</button>
                                            </div>
                                            <button class="text-sm font-bold text-rose-600 hover:text-rose-700">Remove</button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xl font-black text-gray-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="bg-white rounded-3xl border border-gray-100 p-16 text-center shadow-sm">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900">Your cart is empty</h2>
                        <p class="text-gray-500 mt-2 mb-8">Looks like you haven't added anything to your cart yet.</p>
                        <x-ui.button onclick="window.location='{{ route('products.index') }}'" size="lg">Start Shopping</x-ui.button>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-4 mt-12 lg:mt-0">
                <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm sticky top-24">
                    <h2 class="text-xl font-black text-gray-900 mb-6">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-emerald-600 font-bold">Calculated at next step</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="text-emerald-600 font-bold">Calculated at next step</span>
                        </div>
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-lg font-black text-gray-900">Total</span>
                            <span class="text-2xl font-black text-indigo-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <div class="mt-8">
                        <x-ui.button onclick="window.location='{{ route('checkout.index') }}'" class="w-full py-4 text-lg font-black shadow-lg shadow-indigo-100" :disabled="count($cart) == 0">
                            Checkout Now
                        </x-ui.button>
                        <p class="text-center text-xs text-gray-400 mt-4">
                            Secure encrypted checkout by Stripe
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
