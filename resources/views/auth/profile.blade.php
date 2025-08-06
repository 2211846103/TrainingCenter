@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">My Profile</span>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div id="profile" class="col-span-1 bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">Profile Information</h2>
        </div>
        
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-8 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <div class="mt-2 flex items-center space-x-4">
                        @error('profile_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <img class="h-16 w-16 rounded-full bg-gray-200" src="{{ Storage::url(Auth::user()->profile_image) }}" alt="Current profile photo">
                        <input type="file" name="profile_image" id="profile_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
                
                <div>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                  <div>
                    @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end">
                <button type="submit" class="cursor-pointer px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <div id="password" class="col-span-1 bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">Change Password</h2>
        </div>
        <form method="POST" action="{{ route('users.password.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="p-8 space-y-6">
                <div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div>
                    @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>
            <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end">
                <button type="submit" class="cursor-pointer px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection