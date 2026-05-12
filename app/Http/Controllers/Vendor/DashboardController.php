<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor_id = Auth::id();
        $vendor = Auth::user();

        $stats = [
            'total_products' => VendorProduct::where('vendor_id', $vendor_id)->count(),
            'active_products' => VendorProduct::where('vendor_id', $vendor_id)->where('status', 'active')->count(),
            'total_orders' => Order::where('vendor_id', $vendor_id)->count(),
            'total_sales' => Order::where('vendor_id', $vendor_id)
                                  ->where('payment_status', 'paid')
                                  ->sum('total_amount'),
        ];

        // Get the vendor's imported products via the pivot, eager-load the master product
        $recent_products = $vendor->dropshipProducts()->latest('vendor_products.created_at')->take(5)->get();

        return view('vendor.dashboard', compact('stats', 'recent_products'));
    }
}
