<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendorRole = Role::where('slug', 'vendor')->first();

        // Create a Vendor
        $vendor = User::create([
            'name' => 'Tech Gadgets Inc',
            'email' => 'vendor@multiven.com',
            'password' => bcrypt('password'),
            'role_id' => $vendorRole->id,
            'status' => 'active',
        ]);

        // Create Categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'is_active' => true,
        ]);

        $fashion = Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
            'is_active' => true,
        ]);

        // Create a Brand
        $brand = Brand::create([
            'name' => 'Apple',
            'slug' => 'apple',
            'is_active' => true,
        ]);

        // Create Master Products
        $product1 = Product::create([
            'category_id' => $electronics->id,
            'brand_id' => $brand->id,
            'name' => 'iPhone 15 Pro',
            'slug' => 'iphone-15-pro',
            'description' => 'Titanium design. A17 Pro chip. Pro camera system.',
            'price' => 999.99, // Wholesale price
            'sku' => 'IPH15P-128-BLK',
            'quantity' => 50,
            'status' => 'active',
            'is_featured' => true,
        ]);

        $product2 = Product::create([
            'category_id' => $electronics->id,
            'brand_id' => $brand->id,
            'name' => 'AirPods Pro 2',
            'slug' => 'airpods-pro-2',
            'description' => 'Magic on another level.',
            'price' => 200.00, // Wholesale price
            'sale_price' => 180.00,
            'sku' => 'APRO2-WHT',
            'quantity' => 100,
            'status' => 'active',
            'is_featured' => true,
        ]);

        // Vendor imports products to their store
        \App\Models\VendorProduct::create([
            'vendor_id' => $vendor->id,
            'product_id' => $product1->id,
            'vendor_price' => 1099.99, // Retail price
            'status' => 'active',
        ]);

        \App\Models\VendorProduct::create([
            'vendor_id' => $vendor->id,
            'product_id' => $product2->id,
            'vendor_price' => 249.99, // Retail price
            'status' => 'active',
        ]);
    }
}
