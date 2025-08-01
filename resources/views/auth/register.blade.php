@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-center text-[#48465b] mb-6">Create a New Account</h2>

    <form method="POST" action="/register">
        @csrf
        
        @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
            <input type="text" id="name" name="name" required autofocus
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
        </div>

        @error('email')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
            <input type="email" id="email" name="email" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
        </div>

        @error('password')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('password_confirmation')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
            </div>
        </div>

        @error('phone')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        <div class="mb-6">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" id="phone" name="phone"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
        </div>

        <div>
            <button type="submit" class="w-full btn-brand font-bold py-3 px-4 rounded-md transition duration-300">
                Register
            </button>
        </div>
    </form>
    
    <p class="text-sm text-center text-gray-600 mt-6">
        Already have an account? <a href="{{ route('login') }}" class="font-medium text-[#5867dd] hover:underline">Sign In</a>
    </p>
</div>
@endsection