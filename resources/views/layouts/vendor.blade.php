@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transition-transform duration-300 transform md:relative md:translate-x-0 -translate-x-full">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-center h-16 border-b border-slate-800">
                <span class="text-xl font-bold text-emerald-400 tracking-tight">Seller Central</span>
            </div>
            
            <nav class="flex-grow py-6 px-4 space-y-1 overflow-y-auto">
                <x-ui.nav-link href="{{ route('vendor.dashboard') }}" :active="request()->routeIs('vendor.dashboard')" icon="dashboard" class="text-slate-300 hover:text-white hover:bg-slate-800">
                    Dashboard
                </x-ui.nav-link>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider px-3">
                    Inventory
                </div>
                
                <x-ui.nav-link href="{{ route('vendor.products.index') }}" :active="request()->routeIs('vendor.products.*')" icon="package" class="text-slate-300 hover:text-white hover:bg-slate-800">
                    My Products
                </x-ui.nav-link>
                <x-ui.nav-link href="{{ route('vendor.orders.index') }}" :active="request()->routeIs('vendor.orders.*')" icon="shopping-cart" class="text-slate-300 hover:text-white hover:bg-slate-800">Orders</x-ui.nav-link>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider px-3">
                    Finance
                </div>
                
                <x-ui.nav-link href="{{ route('vendor.dashboard') }}" icon="percent" class="text-slate-300 hover:text-white hover:bg-slate-800">Payouts</x-ui.nav-link>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider px-3">
                    Store
                </div>
                
                <x-ui.nav-link href="{{ route('vendor.settings.index') }}" :active="request()->routeIs('vendor.settings.*')" icon="settings" class="text-slate-300 hover:text-white hover:bg-slate-800">Settings</x-ui.nav-link>
            </nav>
            
            <div class="p-4 border-t border-slate-800 bg-slate-950">
                <div class="flex items-center space-x-3 p-2 rounded-lg">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name ?? 'V', 0, 1) }}
                    </div>
                    <div class="flex-grow overflow-hidden">
                        <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Vendor User' }}</p>
                        <p class="text-xs text-slate-400 truncate">Vendor Partner</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col overflow-hidden">
        <!-- Top Header -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-8">
            <button id="sidebar-toggle" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            
            <div class="flex-grow">
                <h1 class="text-lg font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-gray-600 hover:text-emerald-600">Logout</button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow p-4 md:p-8 overflow-y-auto bg-slate-50">
            @yield('vendor_content')
        </main>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
@endpush
@endsection
