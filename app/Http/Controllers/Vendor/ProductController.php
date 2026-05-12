<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // View the vendor's selected/imported products
    public function index()
    {
        $vendor = Auth::user();
        $products = $vendor->dropshipProducts()->paginate(10);
        
        return view('vendor.products.index', compact('products'));
    }

    // View the master catalog
    public function catalog()
    {
        // Only show active master products
        $products = Product::where('status', 'active')
            ->whereDoesntHave('vendors', function($q) {
                $q->where('users.id', Auth::id());
            })
            ->latest()
            ->paginate(12);

        return view('vendor.products.catalog', compact('products'));
    }

    // Import a product to the vendor's store
    public function import(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'vendor_price' => 'required|numeric|min:0',
        ]);

        $product = Product::where('status', 'active')->findOrFail($request->product_id);

        if ($request->vendor_price < $product->price) {
            return back()->with('error', 'Retail price cannot be lower than the wholesale price ($' . number_format($product->price, 2) . ').');
        }

        VendorProduct::firstOrCreate(
            [
                'vendor_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'vendor_price' => $request->vendor_price,
                'status' => 'active',
            ]
        );

        return redirect()->route('vendor.products.index')->with('success', 'Product added to your store.');
    }

    // Update the retail price of an imported product
    public function updatePrice(Request $request, Product $product)
    {
        $request->validate([
            'vendor_price' => 'required|numeric|min:' . $product->price,
        ]);

        $vendorProduct = VendorProduct::where('vendor_id', Auth::id())
                                      ->where('product_id', $product->id)
                                      ->firstOrFail();

        $vendorProduct->update([
            'vendor_price' => $request->vendor_price
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Retail price updated successfully.');
    }

    // Remove a product from the vendor's store
    public function destroy(Product $product)
    {
        $vendorProduct = VendorProduct::where('vendor_id', Auth::id())
                                      ->where('product_id', $product->id)
                                      ->firstOrFail();

        $vendorProduct->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product removed from your store.');
    }
}
