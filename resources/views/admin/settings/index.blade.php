@extends('layouts.admin')

@section('page_title', 'System Settings')

@section('admin_content')
<div class="max-w-4xl space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-black text-gray-900">Platform Settings</h2>
            <p class="text-gray-500 mt-1">Configure global marketplace behavior and appearance.</p>
        </div>
        @if(session('success'))
            <div class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-xl text-sm font-bold border border-emerald-200">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="border-b border-gray-50 bg-gray-50/50 px-8 py-4">
            <nav class="flex gap-8">
                <a href="{{ route('admin.settings.index', ['tab' => 'general']) }}" class="text-sm {{ $activeTab === 'general' ? 'font-black text-indigo-600 border-b-2 border-indigo-600 pb-4 -mb-4.5' : 'font-bold text-gray-400 hover:text-gray-600 pb-4 transition-colors' }}">General</a>
                <a href="{{ route('admin.settings.index', ['tab' => 'appearance']) }}" class="text-sm {{ $activeTab === 'appearance' ? 'font-black text-indigo-600 border-b-2 border-indigo-600 pb-4 -mb-4.5' : 'font-bold text-gray-400 hover:text-gray-600 pb-4 transition-colors' }}">Appearance</a>
                <a href="{{ route('admin.settings.index', ['tab' => 'marketplace']) }}" class="text-sm {{ $activeTab === 'marketplace' ? 'font-black text-indigo-600 border-b-2 border-indigo-600 pb-4 -mb-4.5' : 'font-bold text-gray-400 hover:text-gray-600 pb-4 transition-colors' }}">Marketplace</a>
                <a href="{{ route('admin.settings.index', ['tab' => 'security']) }}" class="text-sm {{ $activeTab === 'security' ? 'font-black text-indigo-600 border-b-2 border-indigo-600 pb-4 -mb-4.5' : 'font-bold text-gray-400 hover:text-gray-600 pb-4 transition-colors' }}">Security</a>
            </nav>
        </div>

        <form action="{{ route('admin.settings.update', ['tab' => $activeTab]) }}" method="POST" class="p-8 space-y-8">
            @csrf

            @if($activeTab === 'general')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-ui.input label="Marketplace Name" name="site_name" :value="$settings['site_name']" required />
                    <x-ui.input label="Support Email" name="support_email" type="email" :value="$settings['support_email']" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-gray-700">Default Currency</label>
                        <select name="currency" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="USD" {{ $settings['currency'] == 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ $settings['currency'] == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ $settings['currency'] == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                        </select>
                    </div>
                </div>

            @elseif($activeTab === 'appearance')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-gray-700">Primary Theme Color</label>
                        <div class="flex items-center gap-4">
                            <input type="color" name="theme_color" value="{{ $settings['theme_color'] }}" class="h-10 w-10 border-none rounded cursor-pointer">
                            <x-ui.input name="theme_color_text" :value="$settings['theme_color']" disabled class="flex-grow" />
                        </div>
                    </div>
                </div>

            @elseif($activeTab === 'marketplace')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <x-ui.input label="Commission Percentage (%)" name="commission_rate" type="number" :value="$settings['commission_rate']" required />
                    <x-ui.input label="Minimum Payout ($)" name="min_payout" type="number" :value="$settings['min_payout']" required />
                </div>

                <div class="space-y-4">
                    <label class="flex items-center gap-3 p-4 border border-gray-100 rounded-2xl hover:bg-gray-50 transition-colors cursor-pointer">
                        <input type="checkbox" name="maintenance_mode" class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ $settings['maintenance_mode'] ? 'checked' : '' }}>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Maintenance Mode</p>
                            <p class="text-xs text-gray-500">Temporarily disable the storefront for maintenance.</p>
                        </div>
                    </label>
                </div>

            @elseif($activeTab === 'security')
                <div class="space-y-4">
                    <label class="flex items-center gap-3 p-4 border border-gray-100 rounded-2xl hover:bg-gray-50 transition-colors cursor-pointer">
                        <input type="checkbox" name="require_vendor_approval" class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ $settings['require_vendor_approval'] ? 'checked' : '' }}>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Manual Vendor Approval</p>
                            <p class="text-xs text-gray-500">New vendors must be approved by an administrator before they can list products.</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-4 border border-gray-100 rounded-2xl hover:bg-gray-50 transition-colors cursor-pointer">
                        <input type="checkbox" name="registration_enabled" class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ $settings['registration_enabled'] ? 'checked' : '' }}>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Public Registration</p>
                            <p class="text-xs text-gray-500">Allow new users and vendors to register on the platform.</p>
                        </div>
                    </label>
                </div>
            @endif

            <div class="pt-8 border-t border-gray-50 flex justify-end">
                <x-ui.button type="submit" class="px-8 py-3 shadow-lg shadow-indigo-100 font-black">Save {{ ucfirst($activeTab) }} Settings</x-ui.button>
            </div>
        </form>
    </div>
</div>
@endsection
