@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-center text-[#48465b] mb-2">Forgot Your Password?</h2>
    <p class="text-sm text-center text-gray-500 mb-6">No problem. Just let us know your email address and we will email you a password reset link.</p>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-md">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" id="email" name="email" required autofocus
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="w-full btn-brand font-bold py-3 px-4 rounded-md transition duration-300">
                Email Password Reset Link
            </button>
        </div>
    </form>
    
    <p class="text-sm text-center text-gray-600 mt-6">
        Remembered your password? <a href="{{ route('auth.login') }}" class="font-medium text-[#5867dd] hover:underline">Back to Sign In</a>
    </p>
</div>
@endsection