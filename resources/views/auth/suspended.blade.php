@extends('layouts.storefront')

@section('title', 'Account Suspended')

@section('storefront_content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gray-50">
    <div class="max-w-md w-full text-center space-y-8">
        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-rose-100 rounded-full flex items-center justify-center text-rose-600 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Account Suspended</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">
                Your account has been suspended due to a violation of our terms of service or suspicious activity.
            </p>
            <p class="mt-2 text-gray-500 text-sm">
                If you believe this is a mistake, please contact our support team at <strong>{{ \App\Models\Setting::get('support_email', 'support@multiven.com') }}</strong>.
            </p>
        </div>

        <div class="pt-6 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-indigo-600 font-bold hover:text-indigo-500 transition-colors">
                    Log out and return home
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
