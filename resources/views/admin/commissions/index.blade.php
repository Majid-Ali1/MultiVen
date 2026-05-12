@extends('layouts.admin')

@section('page_title', 'Commission Management')

@section('admin_content')
<div class="space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Commission Reports</h1>
            <p class="text-gray-500 mt-1">Monitor platform earnings and vendor payouts.</p>
        </div>
        <div class="flex gap-3">
            <x-ui.button variant="secondary">Settlement Rules</x-ui.button>
            <x-ui.button>Export Report</x-ui.button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-ui.card class="bg-indigo-600 text-white border-none shadow-indigo-100">
            <p class="text-indigo-100 text-sm font-bold uppercase tracking-wider">Total Platform Revenue</p>
            <h3 class="text-3xl font-black mt-2">${{ number_format($total_revenue, 2) }}</h3>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Commissions Earned</p>
            <h3 class="text-3xl font-black text-emerald-600 mt-2">${{ number_format($total_commission, 2) }}</h3>
            <p class="text-gray-400 text-xs mt-4">Calculated at 10% flat rate</p>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Pending Payouts</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">${{ number_format($total_revenue - $total_commission, 2) }}</h3>
            <p class="text-amber-600 text-xs mt-4 font-bold">Awaiting Vendor settlement</p>
        </x-ui.card>
    </div>

    <x-ui.card title="Recent Transactions">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                        <th class="pb-3 px-4 font-bold">Order</th>
                        <th class="pb-3 px-4 font-bold">Order Total</th>
                        <th class="pb-3 px-4 font-bold">Commission (10%)</th>
                        <th class="pb-3 px-4 font-bold">Vendor Payout</th>
                        <th class="pb-3 px-4 font-bold">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($commissions as $order)
                        <tr class="text-sm hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4 font-bold text-gray-900">#{{ $order->order_number }}</td>
                            <td class="py-4 px-4 text-gray-600">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="py-4 px-4 font-black text-emerald-600">${{ number_format($order->total_amount * 0.10, 2) }}</td>
                            <td class="py-4 px-4 text-gray-900 font-bold">${{ number_format($order->total_amount * 0.90, 2) }}</td>
                            <td class="py-4 px-4 text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $commissions->links() }}
        </div>
    </x-ui.card>
</div>
@endsection
