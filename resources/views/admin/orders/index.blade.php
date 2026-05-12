@extends('layouts.admin')

@section('page_title', 'Order Management')

@section('admin_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-gray-900">All Orders</h2>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl font-semibold text-sm">✓ {{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-emerald-600 rounded-3xl p-6 text-white shadow-sm shadow-emerald-200">
            <h3 class="text-emerald-100 font-bold mb-1">Total Revenue</h3>
            <p class="text-4xl font-black">${{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-amber-500 rounded-3xl p-6 text-white shadow-sm shadow-amber-200">
            <h3 class="text-amber-100 font-bold mb-1">Pending Orders</h3>
            <p class="text-4xl font-black">{{ $pendingCount }}</p>
        </div>
    </div>

    <form method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex gap-3 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Order ID or Customer…"
            class="flex-grow border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
        <select name="status" class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-colors">Filter</button>
        <a href="{{ route('admin.orders.index') }}" class="px-5 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-200 transition-colors">Reset</a>
    </form>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50 bg-gray-50/50">
                        <th class="pb-3 pt-4 px-6 font-bold">Order ID</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Customer</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Total</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Payment</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Status</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Date</th>
                        <th class="pb-3 pt-4 px-6 font-bold text-right">Update Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                        <tr class="text-sm hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-900">#{{ $order->order_number }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $order->user->name }}</td>
                            <td class="py-4 px-6 font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase 
                                    {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : 
                                      ($order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-blue-100 text-blue-700') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-500 text-xs">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    <select name="status" class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="px-3 py-1.5 text-xs font-bold bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-12 text-center text-gray-400">No orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="p-6 border-t border-gray-50">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
@endsection
