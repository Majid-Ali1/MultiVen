<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Get orders that contain this vendor's products
        $vendorId = Auth::id();
        $orderIds = OrderItem::whereHas('product', fn($q) => $q->where('vendor_id', $vendorId))
            ->pluck('order_id')
            ->unique();

        $orders = Order::with('user')
            ->whereIn('id', $orderIds)
            ->latest()
            ->paginate(20);

        $totalRevenue = Order::whereIn('id', $orderIds)
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        return view('vendor.orders.index', compact('orders', 'totalRevenue'));
    }

    public function show(Order $order)
    {
        $vendorId = Auth::id();
        $items = OrderItem::with('product')
            ->where('order_id', $order->id)
            ->whereHas('product', fn($q) => $q->where('vendor_id', $vendorId))
            ->get();

        return view('vendor.orders.show', compact('order', 'items'));
    }
}
