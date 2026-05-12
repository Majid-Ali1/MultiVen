@extends('layouts.app')

@section('title', 'Login - MultiVen')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-50 via-white to-blue-50">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <a href="/" class="inline-block">
                <span class="text-4xl font-black text-indigo-600 tracking-tighter">MultiVen</span>
            </a>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">
                Welcome back
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Or
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                    create a new account
                </a>
            </p>
        </div>

        <x-ui.card class="mt-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <x-ui.input 
                    label="Email address" 
                    name="email" 
                    type="email" 
                    icon="email"
                    placeholder="you@example.com"
                    required 
                    autofocus
                    :error="$errors->first('email')"
                />

                <div class="space-y-1">
                    <x-ui.input 
                        label="Password" 
                        name="password" 
                        type="password" 
                        icon="lock"
                        placeholder="••••••••"
                        required 
                        :error="$errors->first('password')"
                    />
                    <div class="flex items-center justify-end">
                        <a href="{{ route('home') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>

                <div>
                    <x-ui.button type="submit" class="w-full" size="lg">
                        Sign in
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
        
        <p class="text-center text-xs text-gray-400 mt-8">
            &copy; {{ date('Y') }} MultiVen Platform. Secure encrypted login.
        </p>
    </div>
</div>
@endsection
