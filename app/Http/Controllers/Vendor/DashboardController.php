<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor_id = Auth::id();
        
        $stats = [
            'total_products' => Product::where('vendor_id', $vendor_id)->count(),
            'active_products' => Product::where('vendor_id', $vendor_id)->where('status', 'active')->count(),
            'pending_products' => Product::where('vendor_id', $vendor_id)->where('status', 'pending')->count(),
            'total_sales' => OrderItem::whereHas('product', function($q) use ($vendor_id) {
                $q->where('vendor_id', $vendor_id);
            })->sum('total'),
        ];

        $recent_products = Product::where('vendor_id', $vendor_id)->latest()->take(5)->get();
        
        return view('vendor.dashboard', compact('stats', 'recent_products'));
    }
}
