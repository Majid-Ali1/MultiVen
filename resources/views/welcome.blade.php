@extends('layouts.storefront')

@section('title', 'MultiVen - The Ultimate Multi-Vendor Marketplace')

@section('storefront_content')
<!-- Hero Section -->
<section class="relative bg-white pt-16 pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                <x-ui.badge variant="indigo" class="mb-4">New Season Arrival</x-ui.badge>
                <h1 class="text-5xl font-black text-gray-900 tracking-tight sm:text-6xl md:text-7xl leading-tight mb-6">
                    Everything you need, <span class="text-indigo-600">All in one place.</span>
                </h1>
                <p class="text-xl text-gray-500 leading-relaxed mb-10">
                    Discover thousands of unique products from verified vendors. Shop the latest trends in electronics, fashion, and more with confidence.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 sm:justify-center lg:justify-start">
                    <x-ui.button size="lg" onclick="window.location='{{ route('products.index') }}'" class="h-auto py-5 px-10 text-lg font-black shadow-xl shadow-indigo-200">
                        Start Shopping
                    </x-ui.button>
                    <x-ui.button variant="secondary" size="lg" class="h-auto py-5 px-10 text-lg font-bold">
                        Learn More
                    </x-ui.button>
                </div>
                
                <!-- Stats -->
                <div class="mt-12 grid grid-cols-3 gap-6 pt-12 border-t border-gray-100">
                    <div>
                        <p class="text-3xl font-black text-gray-900">50k+</p>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Products</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900">1.2k+</p>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Vendors</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-gray-900">99.9%</p>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Trust Rate</p>
                    </div>
                </div>
            </div>
            <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                <div class="relative mx-auto w-full rounded-3xl shadow-2xl overflow-hidden rotate-3 hover:rotate-0 transition-transform duration-700">
                    <img class="w-full" src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Marketplace Hero">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                        <div class="text-white">
                            <p class="text-sm font-bold uppercase tracking-widest mb-2">Summer Collection 2026</p>
                            <h3 class="text-3xl font-black">Up to 40% OFF</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Categories -->
<section class="bg-gray-50 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black text-gray-900">Popular Categories</h2>
                <p class="text-gray-500 mt-2">Explore our most sought-after collections.</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-indigo-600 font-bold hover:underline">View All Categories &rarr;</a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group block text-center">
                    <div class="aspect-square rounded-2xl bg-white shadow-sm border border-gray-100 flex items-center justify-center mb-4 group-hover:shadow-lg group-hover:-translate-y-1 transition-all duration-300">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" class="w-2/3 h-2/3 object-contain" alt="{{ $category->name }}">
                        @else
                            <div class="text-indigo-600">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $category->name }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black text-gray-900">Featured Products</h2>
                <p class="text-gray-500 mt-2">Hand-picked premium items just for you.</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-indigo-600 font-bold hover:underline">Shop All Products &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
                <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative aspect-square bg-gray-100 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @if($product->sale_price)
                            <div class="absolute top-4 left-4">
                                <x-ui.badge variant="rose">Sale</x-ui.badge>
                            </div>
                        @endif
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
                            <x-ui.button size="sm" variant="secondary" class="rounded-lg h-10 w-10 p-0 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 italic">No featured products yet. Stay tuned!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="bg-indigo-900 py-24 rounded-[3rem] mx-4 sm:mx-8 mb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100" stroke="white" fill="transparent" />
        </svg>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl font-black text-white mb-6">Join the MultiVen community</h2>
        <p class="text-xl text-indigo-100 mb-10">Get the latest product updates, exclusive offers, and vendor stories delivered to your inbox.</p>
        <form class="flex flex-col sm:flex-row gap-4">
            <input type="email" placeholder="Enter your email address" class="flex-grow px-8 py-5 rounded-2xl bg-white/10 border-2 border-white/20 text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-white/50 text-lg">
            <x-ui.button size="lg" class="bg-white text-indigo-900 hover:bg-indigo-50 h-auto py-5 px-10 text-lg font-black">
                Subscribe Now
            </x-ui.button>
        </form>
    </div>
</section>
@endsection
