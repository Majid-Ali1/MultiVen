<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['category_id', 'brand_id', 'name', 'slug', 'description', 'short_description', 'price', 'sale_price', 'sku', 'quantity', 'status', 'is_featured'])]
class Product extends Model
{
    public function vendors()
    {
        return $this->belongsToMany(User::class, 'vendor_products', 'product_id', 'vendor_id')
                    ->withPivot('vendor_price', 'status')
                    ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
