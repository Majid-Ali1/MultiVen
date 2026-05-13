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
        $vendorId = Auth::id();

        $orders = Order::with('user')
            ->where('vendor_id', $vendorId)
            ->latest()
            ->paginate(20);

        $totalRevenue = Order::where('vendor_id', $vendorId)
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        return view('vendor.orders.index', compact('orders', 'totalRevenue'));
    }

    public function show(Order $order)
    {
        if ($order->vendor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $items = OrderItem::with('product')
            ->where('order_id', $order->id)
            ->get();

        return view('vendor.orders.show', compact('order', 'items'));
    }
}
