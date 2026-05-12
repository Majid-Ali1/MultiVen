@extends('layouts.customer')

@section('customer_content')
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Track your orders and manage your account preferences.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <x-ui.card title="Recent Orders">
            @if($orders->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-400 text-sm italic">You haven't placed any orders yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 text-indigo-600 font-bold hover:underline">Start Shopping</a>
                </div>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($orders as $order)
                        <div class="py-4 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-black text-gray-900">Order #{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                                <span class="text-[10px] font-black uppercase px-2 py-1 rounded-full {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-ui.card>

        <x-ui.card title="Account Summary">
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-black">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                
                <div class="pt-6 border-t border-gray-50 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 font-medium">Default Address</span>
                        <span class="text-xs text-indigo-600 font-bold cursor-pointer hover:underline">Add New</span>
                    </div>
                    <p class="text-xs text-gray-400 italic">No shipping address saved yet.</p>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
