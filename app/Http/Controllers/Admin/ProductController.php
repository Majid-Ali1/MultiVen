<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Notifications\StatusUpdate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['vendor', 'category'])->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function approve(Product $product)
    {
        $product->update(['status' => 'active']);
        $product->vendor->notify(new StatusUpdate(
            'Product Approved',
            "Your product '{$product->name}' has been approved and is now live on the storefront.",
            route('products.show', $product->slug)
        ));
        return redirect()->back()->with('success', 'Product approved successfully.');
    }

    public function reject(Product $product)
    {
        $product->update(['status' => 'inactive']);
        $product->vendor->notify(new StatusUpdate(
            'Product Rejected',
            "Your product '{$product->name}' has been rejected by the administrator.",
            route('vendor.products.index')
        ));
        return redirect()->back()->with('success', 'Product rejected.');
    }
}
