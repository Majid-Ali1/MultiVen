<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VendorApiController extends Controller
{
    public function products()
    {
        $vendor = Auth::user();
        
        $products = $vendor->dropshipProducts()
                           ->wherePivot('status', 'active')
                           ->get()
                           ->map(function ($product) {
                               return [
                                   'id' => $product->id,
                                   'name' => $product->name,
                                   'description' => $product->description,
                                   'wholesale_price' => (float)$product->price,
                                   'retail_price' => (float)$product->pivot->vendor_price,
                                   'sku' => $product->sku,
                                   'quantity_available' => $product->quantity,
                               ];
                           });
                           
        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|unique:orders,order_number',
            'shipping_address' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $vendor = Auth::user();
        $totalWholesaleAmount = 0;

        try {
            DB::beginTransaction();

            $order = Order::create([
                'vendor_id' => $vendor->id,
                'user_id' => null, // Dropshipping end-customer
                'order_number' => $request->order_number,
                'status' => 'pending',
                'total_amount' => 0, 
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->shipping_address,
            ]);

            foreach ($request->items as $item) {
                // Verify the vendor has this product in their catalog
                $vendorProduct = $vendor->dropshipProducts()
                                        ->where('product_id', $item['product_id'])
                                        ->wherePivot('status', 'active')
                                        ->first();

                if (!$vendorProduct) {
                    throw new \Exception("Product ID {$item['product_id']} is not in your active catalog.");
                }

                if ($vendorProduct->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient inventory for Product ID {$item['product_id']}. Available: {$vendorProduct->quantity}");
                }

                $itemTotal = $vendorProduct->price * $item['quantity'];
                $totalWholesaleAmount += $itemTotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $vendorProduct->id,
                    'quantity' => $item['quantity'],
                    'price' => $vendorProduct->price,
                    'total' => $itemTotal,
                ]);

                // Decrement inventory
                $vendorProduct->decrement('quantity', $item['quantity']);
            }

            $order->update(['total_amount' => $totalWholesaleAmount]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully.',
                'data' => [
                    'order_id' => $order->id,
                    'wholesale_total' => $totalWholesaleAmount
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
