@extends('layouts.dashboard')

@section('title', 'Instructor Dashboard')

@section('breadcrumbs')
    <a href="#" class="hover:text-blue-600">Dashboard</a>
@endsection

@section('content')
    <div class="mb-8">
        <p class="text-gray-600">Welcome back! Here are your assigned courses and tasks.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Active Courses</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ $courses->where('status', 'published')->count() }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Total Students</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ auth()->user()->instructedCourses->flatMap->students->count() }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Archived Courses</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ $courses->where('status', 'archived')->count() }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">My Assigned Courses</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-sm text-gray-600 uppercase">
                    <tr>
                        <th class="px-6 py-3 font-medium">Course Title</th>
                        <th class="px-6 py-3 font-medium">Start Date</th>
                        <th class="px-6 py-3 font-medium">Registered Students</th>
                        <th class="px-6 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($courses as $course)
                    @php
                    $firstMaterial = $course->materials()->first();
                    @endphp
                    <tr class="border-b">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $course->title }}</td>
                        <td class="px-6 py-4">{{ $course->start_date->format('F j, Y') }}</td>
                        <td class="px-6 py-4">{{ $course->students->count() }} / {{ $course->capacity }}</td>
                        @if ($course->status == 'published')
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('courses.students', $course) }}" class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-md hover:bg-blue-200">View Participants</a>
                            <a href="{{ route('materials.manage', $course) }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">Manage Materials</a>
                        </td>
                        @else
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('materials.archiveView', ["course" => $course, "material" => $firstMaterial]) }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">View Archive</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection