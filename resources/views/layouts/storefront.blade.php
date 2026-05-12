<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MultiVen - The Premium Marketplace')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-white text-slate-900 selection:bg-indigo-100 selection:text-indigo-700">
    <!-- Announcement Bar -->
    <div class="relative bg-slate-900 px-4 py-2 text-center overflow-hidden">
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
            <span class="text-white">Summer Sale 2026:</span> Up to 50% off select vendors • 
            <a href="{{ route('products.index') }}" class="text-indigo-400 hover:text-white transition-colors underline decoration-indigo-400/30 underline-offset-4">Explore Collection</a>
        </p>
    </div>

    <!-- Navigation -->
    <header class="sticky top-0 z-[100] w-full glass border-b border-slate-100">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between gap-8">
                <!-- Brand -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform">
                            M
                        </div>
                        <span class="text-2xl font-black tracking-tighter text-slate-900">MultiVen</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex lg:items-center lg:gap-1">
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Products</a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Categories</a>
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Vendors</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Partners</a>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <!-- Search -->
                    <button class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="group relative p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 118 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @if(count(session('cart', [])) > 0)
                            <span class="absolute top-1.5 right-1.5 flex h-4 w-4">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-indigo-600 text-[10px] font-black text-white items-center justify-center">
                                    {{ count(session('cart', [])) }}
                                </span>
                            </span>
                        @endif
                    </a>

                    <div class="h-6 w-[1px] bg-slate-100 mx-1"></div>

                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 p-1.5 rounded-2xl border border-slate-100 hover:border-indigo-100 hover:bg-indigo-50/50 transition-all">
                                <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-black shadow-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="text-xs font-black text-slate-700 pr-1 hidden sm:block">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-3 w-56 origin-top-right rounded-3xl bg-white p-2 shadow-2xl ring-1 ring-slate-100 hidden group-hover:block animate-in fade-in zoom-in duration-200">
                                <div class="px-4 py-3 mb-2 border-b border-slate-50">
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Account</p>
                                    <p class="text-sm font-black text-slate-900 truncate">{{ auth()->user()->name }}</p>
                                </div>
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Admin Dashboard</a>
                                @elseif(auth()->user()->hasRole('vendor'))
                                    <a href="{{ route('vendor.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Vendor Dashboard</a>
                                @elseif(auth()->user()->hasRole('partner'))
                                    <a href="{{ route('partner.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Partner Dashboard</a>
                                @else
                                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">My Account</a>
                                @endif
                                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">Settings</a>
                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-all text-left">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-black text-slate-900 hover:text-indigo-600 transition-all">Sign In</a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-indigo-600 text-white rounded-2xl text-sm font-black hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Join Free</a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Trigger -->
                    <button class="lg:hidden p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="relative z-10">
        @yield('storefront_content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-100 pt-24 pb-12 overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
                <div class="lg:col-span-2">
                    <a href="/" class="flex items-center gap-2 mb-8">
                        <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-200">
                            M
                        </div>
                        <span class="text-3xl font-black tracking-tighter text-slate-900">MultiVen</span>
                    </a>
                    <p class="text-lg text-slate-500 max-w-sm leading-relaxed mb-8">
                        Empowering global commerce through a curated multi-vendor ecosystem. High quality, verified sellers, premium support.
                    </p>
                    <div class="flex gap-4">
                        <!-- Socials -->
                        @for($i=0; $i<4; $i++)
                            <a href="{{ route('home') }}" class="h-12 w-12 bg-white rounded-2xl border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 hover:shadow-lg transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10z"></path></svg>
                            </a>
                        @endfor
                    </div>
                </div>
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-8">Platform</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('products.index') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Shop All</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Flash Deals</a></li>
                        <li><a href="{{ route('home') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Top Vendors</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-8">Resources</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('register') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Become a Vendor</a></li>
                        <li><a href="{{ route('register') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Partner Program</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Help Center</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-200 pt-10 flex flex-col sm:flex-row justify-between items-center gap-6">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                    &copy; 2026 MultiVen Marketplace Inc. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <span class="text-xs font-black text-slate-300">SECURE PAYMENTS</span>
                    <div class="flex gap-2">
                        <div class="h-6 w-10 bg-slate-200 rounded"></div>
                        <div class="h-6 w-10 bg-slate-200 rounded"></div>
                        <div class="h-6 w-10 bg-slate-200 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
