@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('users.index') }}" class="hover:text-blue-600">Users</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Edit {{ $user->name }}</span>
@endsection

@section('content')
<div class="grid grid-cols-1 grid-rows-3 lg:grid-cols-4 gap-8">
    <div id="profile" class="col-span-2 row-span-3 bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">Edit User: {{ $user->name }}</h2>
        </div>
        
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="p-8 space-y-6">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        @php
                            $currentRole = old('role', $user->getRoleNames()->first());
                        @endphp
                        <option value="admin" @selected($currentRole == 'admin')>Administrator</option>
                        <option value="instructor" @selected($currentRole == 'instructor')>Instructor</option>
                        <option value="client" @selected($currentRole == 'client')>Client</option>
                    </select>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end items-center space-x-4">
                <a href="{{ route('users.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="cursor-pointer px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <div id="password" class="col-span-2 row-span-2 bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">Change Password</h2>
        </div>
        <form method="POST" action="{{ route('users.password.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="p-8 space-y-6">
                @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div>
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

    <div class="col-span-2 row-span-1 bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
        </div>
        <div class="p-8 flex justify-between items-center">
            <div>
                <h4 class="font-medium text-gray-800">Delete This User</h4>
                <p class="text-sm text-gray-500 mt-1">Once you delete a user, there is no going back.</p>
            </div>
            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                    Delete User
                </button>
            </form>
        </div>
    </div>
</div>
@endsection