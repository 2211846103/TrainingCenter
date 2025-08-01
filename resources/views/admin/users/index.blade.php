@extends('layouts.dashboard')

@section('title', 'User Management')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Users</span>
@endsection

@section('toolbar-actions')
    <a href="{{ route('users.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
        Add New User
    </a>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-medium text-[#48465b]">All Users</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-sm text-gray-600 uppercase">
                <tr>
                    <th class="px-6 py-3 font-medium">User</th>
                    <th class="px-6 py-3 font-medium">Role</th>
                    <th class="px-6 py-3 font-medium">Registered On</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @foreach ($users as $user)
                @php
                $role = $user->getRoleNames()->first();
                $color = ($role == 'admin') ? 'red' : ($role == 'instructor' ? 'blue' : 'green');
                @endphp
                <tr>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        
                        <span class="px-2 py-1 text-xs font-semibold text-{{ $color }}-800 bg-{{ $color }}-100 rounded-full">{{ ucfirst($role) }}</span>
                    </td>
                    <td class="px-6 py-4">{{ $user->created_at->format('F j, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('users.edit', $user) }}" class="p-1 text-gray-500 hover:text-blue-600 rounded-md inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="p-6 border-t border-gray-200">
        {{ $users->links() }}
    </div>
</div>
@endsection