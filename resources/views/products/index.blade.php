@extends('layouts.storefront')

@section('title', 'Shop All Products - MultiVen')

@section('storefront_content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar: Filters -->
            <div class="w-full md:w-64 flex-shrink-0">
                <div class="sticky top-24 space-y-8">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Categories</h3>
                        <nav class="space-y-2">
                            <a href="{{ route('products.index') }}" class="block text-sm {{ !request('category') ? 'text-indigo-600 font-bold' : 'text-gray-600 hover:text-indigo-600' }}">All Categories</a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="block text-sm {{ request('category') == $category->slug ? 'text-indigo-600 font-bold' : 'text-gray-600 hover:text-indigo-600' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Price Range</h3>
                        <div class="space-y-4">
                            <input type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>$0</span>
                                <span>$10,000+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main: Product Grid -->
            <div class="flex-grow">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-black text-gray-900">
                        @if(request('category'))
                            {{ $categories->firstWhere('slug', request('category'))->name ?? 'Products' }}
                        @elseif(request('search'))
                            Search results for "{{ request('search') }}"
                        @else
                            All Products
                        @endif
                    </h1>
                    <div class="flex items-center text-sm text-gray-500">
                        <span>Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                            <div class="relative aspect-square bg-gray-100 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @if($product->sale_price)
                                    <div class="absolute top-4 left-4">
                                        <x-ui.badge variant="rose">Sale</x-ui.badge>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                    <x-ui.button variant="secondary" size="sm" class="bg-white border-none">Quick View</x-ui.button>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <x-ui.button type="submit" size="sm" class="bg-indigo-600">Add to Cart</x-ui.button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-6">
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">{{ $product->category->name }}</p>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-xl font-black text-gray-900">${{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                                        @if($product->sale_price)
                                            <span class="text-sm text-gray-400 line-through">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center text-amber-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="ml-1 text-xs font-bold text-gray-600">4.8</span>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center text-xs text-gray-400">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    Sold by <span class="ml-1 font-semibold text-gray-600">{{ $product->vendor->name }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">No products found</h3>
                            <p class="text-gray-500 mt-2">Try adjusting your filters or search terms.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
