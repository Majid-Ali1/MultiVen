@extends('layouts.storefront')

@section('title', $product->name . ' - MultiVen')

@section('storefront_content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm font-medium text-gray-500">
            <a href="/" class="hover:text-indigo-600">Home</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left: Product Images -->
            <div class="space-y-4">
                <div class="aspect-square rounded-3xl bg-gray-100 overflow-hidden border border-gray-100">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="grid grid-cols-4 gap-4">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="aspect-square rounded-xl bg-gray-100 overflow-hidden border border-gray-100 cursor-pointer hover:border-indigo-400 transition-colors">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="" class="w-full h-full object-cover">
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="space-y-8">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <x-ui.badge variant="indigo">{{ $product->category->name }}</x-ui.badge>
                        @if($product->brand)
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">{{ $product->brand->name }}</span>
                        @endif
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 leading-tight">{{ $product->name }}</h1>
                    <div class="mt-4 flex items-center gap-4">
                        <div class="flex items-center text-amber-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-gray-500">128 Reviews</span>
                        <span class="text-gray-300">|</span>
                        <span class="text-sm font-bold text-emerald-600">In Stock</span>
                    </div>
                </div>

                <div class="flex items-baseline gap-4">
                    <span class="text-5xl font-black text-gray-900">${{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                    @if($product->sale_price)
                        <span class="text-2xl text-gray-400 line-through">${{ number_format($product->price, 2) }}</span>
                        <span class="text-sm font-bold bg-rose-100 text-rose-600 px-3 py-1 rounded-full">Save {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                    @endif
                </div>

                <p class="text-gray-600 leading-relaxed text-lg">
                    {{ $product->short_description ?? Str::limit($product->description, 200) }}
                </p>

                <!-- Variants (Placeholder for now) -->
                @if($product->variants->count() > 0)
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-gray-900 uppercase">Select Options</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($product->variants as $variant)
                                <button class="px-6 py-3 rounded-xl border-2 border-gray-100 hover:border-indigo-600 font-bold text-gray-900 transition-all">
                                    {{ $variant->sku }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        <div class="flex items-center border-2 border-gray-100 rounded-2xl px-4 py-2">
                            <button type="button" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            <input type="number" name="quantity" value="1" min="1" class="w-12 text-center border-none focus:ring-0 font-black text-xl">
                            <button type="button" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-indigo-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        <x-ui.button type="submit" size="lg" class="flex-grow h-auto py-5 text-lg font-black shadow-xl shadow-indigo-200">
                            Add to Cart
                        </x-ui.button>
                    </div>
                </form>

                <!-- Vendor Info Card -->
                <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100 flex items-center gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl font-black">
                        M
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Sold By</p>
                        <h4 class="text-xl font-bold text-gray-900">MultiVen Direct</h4>
                        <a href="{{ route('home') }}" class="text-sm font-bold text-indigo-600 hover:underline mt-1 inline-block">Visit Store Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description Tabs -->
        <div class="mt-20">
            <div class="border-b border-gray-100 flex gap-8">
                <button class="pb-4 text-lg font-black text-indigo-600 border-b-4 border-indigo-600">Description</button>
                <button class="pb-4 text-lg font-bold text-gray-400 hover:text-gray-600">Specifications</button>
                <button class="pb-4 text-lg font-bold text-gray-400 hover:text-gray-600">Reviews (128)</button>
            </div>
            <div class="py-12 prose prose-lg max-w-none text-gray-600">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
