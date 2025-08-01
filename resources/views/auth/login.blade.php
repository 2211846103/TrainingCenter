@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-center text-[#48465b] mb-6">Sign In to Your Account</h2>

    <form method="POST" action="/login">
        @csrf
        
        @error('email')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" id="email" name="email" required autofocus
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
        </div>

        @error('password')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
        </div>

        @error('remember')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="flex items-center justify-between mb-6 text-sm">
            <label for="remember_me" class="flex items-center">
                <input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 rounded border-gray-300 text-[#5867dd] focus:ring-[#5867dd]">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="font-medium text-[#5867dd] hover:underline">Forgot password?</a>
        </div>

        <div>
            <button type="submit" class="w-full btn-brand font-bold py-3 px-4 rounded-md transition duration-300">
                Sign In
            </button>
        </div>
    </form>
    
    <p class="text-sm text-center text-gray-600 mt-6">
        Not a member yet? <a href="{{ route('auth.register') }}" class="font-medium text-[#5867dd] hover:underline">Sign Up</a>
    </p>
</div>
@endsection