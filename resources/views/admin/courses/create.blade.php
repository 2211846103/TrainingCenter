@extends('layouts.dashboard')

@section('title', 'Create New Course')

@section('breadcrumbs')
    <a href="{{-- route('dashboard') --}}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{-- route('admin.courses.index') --}}" class="hover:text-blue-600">Courses</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Create</span>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-medium text-[#48465b]">New Course Details</h2>
    </div>

    <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g., Introduction to Python" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="5" placeholder="Enter a brief summary of the course..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                    </div>
                    <div>
                        @error('thumbnail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Course Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                     <div>
                        @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input type="text" id="category" name="category" placeholder="e.g., Programming" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>
                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        @error('instructor_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                        <select id="instructor_id" name="instructor_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="">Select an instructor...</option>
                            @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @error('skill_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="skill_level" class="block text-sm font-medium text-gray-700 mb-1">Skill Level</label>
                        <select id="skill_level" name="skill_level" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="professional">Professional</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                    </div>
                     <div class="grid grid-cols-2 gap-6">
                        <div>
                            @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <input type="number" id="price" name="price" placeholder="0.00" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            @error('capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Student Capacity</label>
                            <input type="number" id="capacity" name="capacity" placeholder="e.g., 30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        </div>
                    </div>
                     <div>
                        @error('mode')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="mode" class="block text-sm font-medium text-gray-700 mb-1">Course Mode</label>
                        <select id="mode" name="mode" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="offline">Offline</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                    <div>
                        @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" id="location" name="location" placeholder="e.g., Online or Room 101" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <!-- Certified Checkbox -->
                    <div class="flex items-center">
                        @error('certified')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <input id="certified" name="certified" type="checkbox" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="certified" class="ml-2 block text-sm text-gray-900">This course offers a certificate upon completion.</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end items-center space-x-4">
            <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</a>
            <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Create Course
            </button>
        </div>
    </form>
</div>
@endsection