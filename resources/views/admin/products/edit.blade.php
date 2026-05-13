@extends('layouts.admin')

@section('page_title', 'Edit Master Product')

@section('admin_content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-gray-900">Edit Master Product: {{ $product->name }}</h2>
        <x-ui.button tag="a" href="{{ route('admin.products.index') }}" variant="secondary">Back to Products</x-ui.button>
    </div>

    <x-ui.card>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Details -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="sku" class="block text-sm font-bold text-gray-700 mb-1">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('sku') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-bold text-gray-700 mb-1">Category</label>
                        <select name="category_id" id="category_id" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="brand_id" class="block text-sm font-bold text-gray-700 mb-1">Brand (Optional)</label>
                        <select name="brand_id" id="brand_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Pricing & Inventory -->
                <div class="space-y-4">
                    <div>
                        <label for="price" class="block text-sm font-bold text-gray-700 mb-1">Price ($)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('price') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="quantity" class="block text-sm font-bold text-gray-700 mb-1">Stock Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('quantity') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                @error('description') <span class="text-xs text-rose-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <x-ui.button type="submit">Update Master Product</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
