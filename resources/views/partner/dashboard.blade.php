@extends('layouts.partner')

@section('page_title', 'Partner Dashboard')

@section('partner_content')
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-ui.card class="bg-indigo-600 text-white border-none">
            <p class="text-indigo-100 text-sm font-bold uppercase tracking-wider">Total Referrals</p>
            <h3 class="text-3xl font-black mt-2">0</h3>
        </x-ui.card>
        
        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Active API Keys</p>
            <h3 class="text-3xl font-black text-gray-900 mt-2">0</h3>
        </x-ui.card>

        <x-ui.card>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Wholesale Credit</p>
            <h3 class="text-3xl font-black text-emerald-600 mt-2">$0.00</h3>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <x-ui.card title="API Access">
            <p class="text-sm text-gray-500 mb-6">Integrate our catalog into your own platform using your partner API keys.</p>
            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                <p class="text-sm font-bold text-gray-400">No API keys generated yet.</p>
                <x-ui.button variant="secondary" class="mt-4">Generate First Key</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card title="Wholesale Program">
            <p class="text-sm text-gray-500 mb-6">Partners get exclusive access to bulk pricing and inventory reserved for B2B.</p>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer border border-transparent hover:border-gray-100">
                    <span class="text-sm font-bold text-gray-700">Electronics Wholesale</span>
                    <span class="text-xs font-black text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">UP TO 25% OFF</span>
                </div>
                <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer border border-transparent hover:border-gray-100">
                    <span class="text-sm font-bold text-gray-700">Apparel Bulk Packs</span>
                    <span class="text-xs font-black text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">UP TO 40% OFF</span>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
