@extends('layouts.vendor')

@section('page_title', 'Account Settings')

@section('vendor_content')
<div class="max-w-2xl space-y-8">
    <div>
        <h2 class="text-2xl font-black text-gray-900">Account Settings</h2>
        <p class="text-gray-500 mt-1">Manage your profile and security credentials.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl font-semibold text-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendor.settings.update') }}" method="POST" class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        @csrf
        <div class="p-8 space-y-6">
            <h3 class="font-black text-gray-800 text-lg border-b border-gray-50 pb-4">Profile Information</h3>

            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-2xl">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-bold text-gray-900">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">Vendor Account</p>
                </div>
            </div>

            <x-ui.input label="Full Name" name="name" :value="old('name', $user->name)" required />
            <x-ui.input label="Email Address" name="email" type="email" :value="old('email', $user->email)" required />
        </div>

        <div class="p-8 pt-0 space-y-6">
            <h3 class="font-black text-gray-800 text-lg border-b border-gray-50 pb-4">Change Password</h3>
            <p class="text-sm text-gray-500">Leave blank to keep your current password.</p>

            <x-ui.input label="Current Password" name="current_password" type="password" />
            <x-ui.input label="New Password" name="password" type="password" />
            <x-ui.input label="Confirm New Password" name="password_confirmation" type="password" />
        </div>

        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-xl transition-colors shadow-sm shadow-emerald-100">
                Save Changes
            </button>
        </div>
    </form>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 space-y-6">
            <h3 class="font-black text-gray-800 text-lg border-b border-gray-50 pb-4">API Settings</h3>
            <p class="text-sm text-gray-500">Use this token to authenticate your dropshipping storefront with the MultiVen API.</p>

            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 flex items-center justify-between">
                <div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Your API Token</div>
                    <code class="text-sm font-mono text-slate-900 break-all select-all">{{ $user->api_token ?? 'No token generated yet.' }}</code>
                </div>
            </div>

            <form action="{{ route('vendor.settings.token') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="text-sm px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-lg transition-colors" onclick="return confirm('Are you sure? Generating a new token will invalidate any existing integrations using the old token.')">
                    {{ $user->api_token ? 'Regenerate API Token' : 'Generate API Token' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
