@extends('layouts.app')

@section('title', 'Create Account - MultiVen')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-50 via-white to-emerald-50">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <a href="/" class="inline-block">
                <span class="text-4xl font-black text-indigo-600 tracking-tighter">MultiVen</span>
            </a>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">
                Create your account
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                    Sign in here
                </a>
            </p>
        </div>

        <x-ui.card class="mt-8">
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-4 p-1 bg-gray-100 rounded-xl mb-6">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="customer" class="peer hidden" checked>
                        <div class="text-center py-2 px-4 rounded-lg peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm text-sm font-medium text-gray-500 transition-all">
                            Customer
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="vendor" class="peer hidden">
                        <div class="text-center py-2 px-4 rounded-lg peer-checked:bg-white peer-checked:text-emerald-600 peer-checked:shadow-sm text-sm font-medium text-gray-500 transition-all">
                            Seller
                        </div>
                    </label>
                </div>

                <x-ui.input 
                    label="Full Name" 
                    name="name" 
                    type="text" 
                    icon="user"
                    placeholder="John Doe"
                    required 
                    autofocus
                    :error="$errors->first('name')"
                />

                <x-ui.input 
                    label="Email address" 
                    name="email" 
                    type="email" 
                    icon="email"
                    placeholder="you@example.com"
                    required 
                    :error="$errors->first('email')"
                />

                <x-ui.input 
                    label="Password" 
                    name="password" 
                    type="password" 
                    icon="lock"
                    placeholder="••••••••"
                    required 
                    :error="$errors->first('password')"
                />

                <x-ui.input 
                    label="Confirm Password" 
                    name="password_confirmation" 
                    type="password" 
                    icon="lock"
                    placeholder="••••••••"
                    required 
                />

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-xs text-gray-600">
                        I agree to the <a href="{{ route('home') }}" class="text-indigo-600 underline">Terms of Service</a> and <a href="{{ route('home') }}" class="text-indigo-600 underline">Privacy Policy</a>.
                    </label>
                </div>

                <div>
                    <x-ui.button type="submit" class="w-full" variant="primary" size="lg">
                        Create Account
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</div>
@endsection
