@extends('layouts.vendor')

@section('page_title', 'My Orders')

@section('vendor_content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-gray-900">My Dropship Orders</h2>
        <div class="bg-white border border-gray-100 rounded-2xl px-4 py-2 shadow-sm">
            <span class="text-sm text-gray-500">Total Wholesale Cost: </span>
            <span class="text-sm font-black text-indigo-600">${{ number_format($totalRevenue, 2) }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50 bg-gray-50/50">
                        <th class="pb-3 pt-4 px-6 font-bold">Order ID</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Customer</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Order Total</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Payment</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Status</th>
                        <th class="pb-3 pt-4 px-6 font-bold">Date</th>
                        <th class="pb-3 pt-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                        <tr class="text-sm hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-900">#{{ $order->order_number }}</td>
                            <td class="py-4 px-6">
                                <div>
                                    @if($order->user)
                                        <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $order->user->email }}</p>
                                    @else
                                        <p class="font-semibold text-gray-900">Dropship Customer</p>
                                        <p class="text-xs text-gray-400">API Order</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6 font-black text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-500 text-xs">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('vendor.orders.show', $order) }}" class="text-emerald-600 hover:text-emerald-800 font-bold text-xs">View Details →</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-16 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <p class="font-semibold">No orders yet</p>
                                <p class="text-sm mt-1">Orders containing your products will appear here.</p>
                            </td>
                        </tr>
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
