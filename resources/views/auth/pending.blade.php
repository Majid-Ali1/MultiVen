@extends('layouts.storefront')

@section('title', 'Account Pending Approval')

@section('storefront_content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gray-50">
    <div class="max-w-md w-full text-center space-y-8">
        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Account Pending</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">
                Thank you for joining <strong>MultiVen</strong>! Your account application is currently being reviewed by our team.
            </p>
            <p class="mt-2 text-gray-500 text-sm">
                This process usually takes 24-48 hours. You will receive an email once your account is active.
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
