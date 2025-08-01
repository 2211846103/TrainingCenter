@extends('layouts.dashboard')

@section('title', 'Client Dashboard')

@section('breadcrumbs')
    <a href="#" class="hover:text-blue-600">Dashboard</a>
@endsection

@section('content')
    <div class="mb-8">
        <p class="text-gray-600">Welcome back! Here are your courses and learning progress.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Courses Enrolled</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ auth()->user()->enrolledCourses()->count() }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Courses Completed</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ auth()->user()->enrolledCourses()->where('status', 'archived')->count() }}</div>
        </div>
        <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-6">
            <div class="text-gray-500">Certificates Earned</div>
            <div class="text-3xl font-bold text-gray-800 mt-1">{{ auth()->user()->enrolledCourses()->where('status', 'archived')->where('certified', true)->count() }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">My Courses</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-sm text-gray-600 uppercase">
                    <tr>
                        <th class="px-6 py-3 font-medium">Course Title</th>
                        <th class="px-6 py-3 font-medium">Instructor</th>
                        <th class="px-6 py-3 font-medium">Completion Date</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @if ($courses->isEmpty())
                    <tr class="border-b bg-gray-50">
                        <td colspan="100%" class="px-6 py-4 text-center text-gray-500">
                            You haven't enrolled in any courses yet.
                        </td>
                    </tr>
                    @endif
                    @foreach ($courses as $course)
                    <tr class="border-b">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $course->title }}</td>
                        <td class="px-6 py-4">{{ $course->instructor->name }}</td>
                        <td class="px-6 py-4">
                            @if ($course->end_date && now()->gte(\Illuminate\Support\Carbon::parse($course->end_date)))
                                {{ \Illuminate\Support\Carbon::parse($course->end_date)->format('F j, Y') }}
                            @else
                                Not Completed
                            @endif
                        </td>

                        @php
                        $material = $course->materials->first();
                        @endphp

                        @if ($course->status == 'published')
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">In Progress</span>
                        </td>
                        <td class="px-6 py-4">
                            
                            <a href="{{ route('materials.show', ["course" => $course, "material" => $material]) }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">View Materials</a>
                            <a href="{{ route('courses.show', $course) }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">View Details</a>
                        </td>
                        @else
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Completed</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('materials.archiveView', ["course" => $course, "material" => $material]) }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">View Archive</a>
                            @if ($course->certified)
                            <a href="{{ route('certificate.generate', $course) }}" class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">Download Certificate</a>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection