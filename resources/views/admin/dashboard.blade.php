@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('breadcrumbs')
    <a href="/" class="hover:text-blue-600">Home</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Dashboard</span>
@endsection

@section('toolbar-actions')
    <a href="{{ route('courses.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
        Create New Course
    </a>
@endsection

@section('content')
    @php
    use \App\Services\StripeService;
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Total Courses</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($courses->count()) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Active Students</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($clients->count()) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Total Instructors</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($instructors->count()) }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Revenue (This Month)</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">${{ number_format(new StripeService()->getMonthlyRevenue()) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-[#48465b]">Recent Registrations</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 text-sm text-gray-600 uppercase">
                        <tr>
                            <th class="px-6 py-3 font-medium">Student Name</th>
                            <th class="px-6 py-3 font-medium">Course</th>
                            <th class="px-6 py-3 font-medium">Date</th>
                            <th class="px-6 py-3 font-medium">Instructor</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($registrations as $registeration)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $registeration->user_name }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $registeration->course_title }}</td>
                            <td class="px-6 py-4">{{ \Illuminate\Support\Carbon::parse($registeration->registered_at)->format('F j, Y') }}</td>
                            <td class="px-6 py-4">{{ \App\Models\Course::find($registeration->course_id)->instructor->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
                 <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-[#48465b]">Recently Added Courses</h2>
                </div>
                <div class="p-6 space-y-4">
                    @foreach ($courses as $course)
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-medium text-gray-800">{{ $course->title }}</div>
                            <div class="text-xs text-gray-500">Added: {{ \Illuminate\Support\Carbon::parse($course->created_at)->format('F j, Y') }}</div>
                        </div>
                        <a href="{{ route('courses.edit', $course) }}" class="text-xs font-semibold text-blue-600 hover:underline">Edit</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection