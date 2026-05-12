@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-300 transform md:relative md:translate-x-0 -translate-x-full">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-center h-16 border-b border-gray-100">
                <span class="text-xl font-bold text-indigo-600 tracking-tight">MultiVen Admin</span>
            </div>
            
            <nav class="flex-grow py-6 px-4 space-y-1 overflow-y-auto">
                <x-ui.nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" icon="dashboard">
                    Dashboard
                </x-ui.nav-link>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider px-3">
                    Management
                </div>
                
                <x-ui.nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')" icon="users">Users</x-ui.nav-link>
                <x-ui.nav-link href="{{ route('admin.vendors.index') }}" :active="request()->routeIs('admin.vendors.*')" icon="users">Vendors</x-ui.nav-link>
                <x-ui.nav-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')" icon="package">
                    Categories
                </x-ui.nav-link>
                <x-ui.nav-link href="{{ route('admin.products.index') }}" :active="request()->routeIs('admin.products.*')" icon="package">Products</x-ui.nav-link>
                <x-ui.nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.*')" icon="shopping-cart">Orders</x-ui.nav-link>
                <x-ui.nav-link href="{{ route('admin.commissions.index') }}" :active="request()->routeIs('admin.commissions.*')" icon="percent">Commissions</x-ui.nav-link>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider px-3">
                    System
                </div>
                
                <x-ui.nav-link href="{{ route('admin.settings.index') }}" :active="request()->routeIs('admin.settings.*')" icon="settings">Settings</x-ui.nav-link>
            </nav>
            
            <div class="p-4 border-t border-gray-100">
                <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-grow">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name ?? 'Admin User' }}</p>
                        <p class="text-xs text-gray-500 truncate">Administrator</p>
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
            
            <div class="flex-grow hidden md:block">
                <h1 class="text-lg font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Logout</button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow p-4 md:p-8 overflow-y-auto">
            @yield('admin_content')
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
