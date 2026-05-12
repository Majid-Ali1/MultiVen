@extends('layouts.vendor')

@section('page_title', 'Add New Product')

@section('vendor_content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('vendor.products.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-500 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to products
        </a>
    </div>

    <form action="{{ route('vendor.products.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Primary Details -->
            <div class="lg:col-span-2 space-y-6">
                <x-ui.card title="Basic Information">
                    <div class="space-y-4">
                        <x-ui.input 
                            label="Product Name" 
                            name="name" 
                            placeholder="e.g. Premium Wireless Headphones"
                            required 
                            autofocus
                            :error="$errors->first('name')"
                        />

                        <div class="space-y-1.5">
                            <label for="description" class="block text-sm font-medium text-gray-700">Full Description</label>
                            <textarea name="description" id="description" rows="8" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Describe your product in detail..." required></textarea>
                            @error('description')
                                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </x-ui.card>

                <x-ui.card title="Pricing & Inventory">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-ui.input 
                            label="Base Price ($)" 
                            name="price" 
                            type="number" 
                            step="0.01"
                            placeholder="0.00"
                            required 
                            :error="$errors->first('price')"
                        />
                        <x-ui.input 
                            label="Sale Price ($)" 
                            name="sale_price" 
                            type="number" 
                            step="0.01"
                            placeholder="Optional"
                            :error="$errors->first('sale_price')"
                        />
                        <x-ui.input 
                            label="SKU" 
                            name="sku" 
                            placeholder="Unique identifier"
                            required 
                            :error="$errors->first('sku')"
                        />
                        <x-ui.input 
                            label="Stock Quantity" 
                            name="quantity" 
                            type="number" 
                            placeholder="0"
                            required 
                            :error="$errors->first('quantity')"
                        />
                    </div>
                </x-ui.card>
            </div>

            <!-- Right Column: Categorization -->
            <div class="space-y-6">
                <x-ui.card title="Organization">
                    <div class="space-y-4">
                        <div class="space-y-1.5">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand (Optional)</label>
                            <select name="brand_id" id="brand_id" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                <option value="">No Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </x-ui.card>

                <div class="sticky top-24">
                    <x-ui.card class="bg-gray-50 border-gray-200">
                        <div class="space-y-4">
                            <p class="text-xs text-gray-500">
                                Your product will be submitted for review. Once approved, it will be visible to all customers.
                            </p>
                            <x-ui.button type="submit" class="w-full" size="lg">Submit Product</x-ui.button>
                            <x-ui.button variant="secondary" type="button" class="w-full" onclick="history.back()">Cancel</x-ui.button>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
