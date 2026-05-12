@extends('layouts.storefront')

@section('title', 'Checkout - MultiVen')

@section('storefront_content')
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-10">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                <!-- Checkout Form -->
                <div class="lg:col-span-8 space-y-8">
                    <x-ui.card title="Shipping Information">
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-ui.input label="First Name" name="first_name" required value="{{ explode(' ', auth()->user()->name)[0] }}" />
                                <x-ui.input label="Last Name" name="last_name" required value="{{ explode(' ', auth()->user()->name)[1] ?? '' }}" />
                            </div>
                            <x-ui.input label="Email Address" name="email" type="email" required value="{{ auth()->user()->email }}" />
                            <div class="space-y-1.5">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Full Shipping Address</label>
                                <textarea name="shipping_address" id="shipping_address" rows="4" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Street, City, Zip, Country" required></textarea>
                            </div>
                        </div>
                    </x-ui.card>

                    <x-ui.card title="Payment Method">
                        <div class="space-y-4">
                            <div class="flex items-center p-4 border-2 border-indigo-600 rounded-2xl bg-indigo-50/50">
                                <input type="radio" name="payment_method" value="stripe" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                <label class="ml-4 flex items-center gap-3">
                                    <span class="font-bold text-gray-900">Credit / Debit Card</span>
                                    <div class="flex gap-1">
                                        <div class="h-6 w-10 bg-gray-200 rounded"></div>
                                        <div class="h-6 w-10 bg-gray-200 rounded"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="flex items-center p-4 border-2 border-gray-100 rounded-2xl hover:border-gray-200 transition-colors">
                                <input type="radio" name="payment_method" value="cod" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                <label class="ml-4 font-bold text-gray-900">Cash on Delivery</label>
                            </div>
                        </div>
                    </x-ui.card>
                </div>

                <!-- Summary -->
                <div class="lg:col-span-4 mt-12 lg:mt-0">
                    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm sticky top-24">
                        <h2 class="text-xl font-black text-gray-900 mb-6">Review Order</h2>
                        <ul class="divide-y divide-gray-100 mb-6">
                            @foreach($cart as $details)
                                <li class="py-4 flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <div class="h-12 w-12 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                                            <img src="{{ $details['image'] }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 line-clamp-1">{{ $details['name'] }}</p>
                                            <p class="text-xs text-gray-500">Qty: {{ $details['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm font-black text-gray-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                </li>
                            @endforeach
                        </ul>

                        <div class="space-y-4 pt-6 border-t border-gray-100">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-bold text-gray-900">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="font-bold text-emerald-600">FREE</span>
                            </div>
                            <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-lg font-black text-gray-900">Total</span>
                                <span class="text-2xl font-black text-indigo-600">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <x-ui.button type="submit" class="w-full py-4 text-lg font-black shadow-lg shadow-indigo-100">
                                Place Order
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
