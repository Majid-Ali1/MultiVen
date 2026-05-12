<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index()
    {
        // Simple logic for MVP: Calculate commission as 10% of total sales
        $total_revenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $total_commission = $total_revenue * 0.10;
        
        $commissions = Order::with('user')
            ->where('payment_status', 'paid')
            ->latest()
            ->paginate(20);

        return view('admin.commissions.index', compact('commissions', 'total_revenue', 'total_commission'));
    }
}
