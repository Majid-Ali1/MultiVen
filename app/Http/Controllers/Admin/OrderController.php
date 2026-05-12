<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'vendor']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%'.$request->search.'%')
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', '%'.$request->search.'%'));
        }

        $orders = $query->latest()->paginate(20)->withQueryString();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $pendingCount = Order::where('status', 'pending')->count();

        return view('admin.orders.index', compact('orders', 'totalRevenue', 'pendingCount'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);
        return back()->with('success', "Order #{$order->order_number} status updated to {$request->status}.");
    }
}
