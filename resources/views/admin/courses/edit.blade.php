@extends('layouts.dashboard')

@section('title', 'Edit Course')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('courses.manage') }}" class="hover:text-blue-600">Courses</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Edit {{ $course->title }}</span>
@endsection

@section('toolbar-actions')
    @if($course->status === 'draft')
        <form method="POST" action="{{ route('courses.publish', $course) }}" class="flex">
            @csrf
            @if (session('error'))
            <div class="px-4 py-2 text-sm text-red-700">
                {{ session('error') }}
            </div>
            @endif
            <button type="submit" class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                Publish Course
            </button>
        </form>
    @elseif($course->status === 'published')
        <form method="POST" action="{{ route('courses.archive', $course) }}">
            @csrf
            <button type="submit" class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-gray-700 rounded-md hover:bg-gray-800">
                Archive Course
            </button>
        </form>
    @endif
@endsection


@section('content')
<div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-medium text-[#48465b]">Edit Course Details</h2>
    </div>

    <form method="POST" action="{{ route('courses.update', $course) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Course Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                     <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $course->category) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                        <select id="instructor_id" name="instructor_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}" @selected(old('instructor_id', $course->instructor_id) == $instructor->id)>{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="skill_level" class="block text-sm font-medium text-gray-700 mb-1">Skill Level</label>
                        <select id="skill_level" name="skill_level" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="beginner" @selected(old('skill_level', $course->skill_level) == 'beginner')>Beginner</option>
                            <option value="intermediate" @selected(old('skill_level', $course->skill_level) == 'intermediate')>Intermediate</option>
                            <option value="professional" @selected(old('skill_level', $course->skill_level) == 'professional')>Professional</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', optional($course->start_date)->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', optional($course->end_date)->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                    </div>
                     <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $course->price) }}" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Student Capacity</label>
                            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $course->capacity) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                    </div>
                     <div>
                        <label for="mode" class="block text-sm font-medium text-gray-700 mb-1">Course Mode</label>
                        <select id="mode" name="mode" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="offline" @selected(old('mode', $course->mode) == 'offline')>Offline</option>
                            <option value="online" @selected(old('mode', $course->mode) == 'online')>Online</option>
                        </select>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $course->location) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div class="flex items-center">
                        <input id="certified" name="certified" type="checkbox" value="1" @checked(old('certified', $course->certified)) class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="certified" class="ml-2 block text-sm text-gray-900">This course offers a certificate upon completion.</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-between items-center">
            <div>
                <button type="submit" form="delete-form" class="cursor-pointer text-sm font-medium text-red-600 hover:text-red-800">
                    Delete Course
                </button>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('courses.manage') }}" class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="cursor-pointer px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
    <form id="delete-form" method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Are you sure you want to delete this course? This action cannot be undone.');">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection