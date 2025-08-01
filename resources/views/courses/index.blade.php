@extends('layouts.guest')

@section('title', 'Browse Courses')

@section('content')
<main class="container mx-auto px-6 py-12">

    <div class="mb-12">
        <h1 class="text-3xl font-bold text-[#282a3c] mb-2">Our Courses</h1>
        <p class="text-gray-600">Find the perfect course to advance your skills and career.</p>
        <div class="mt-6 max-w-lg">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </span>
                <input type="text" placeholder="Search for courses..." class="w-full pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#5867dd]">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($courses as $course)
        <div class="kt-portlet flex flex-col overflow-hidden">
            <img src="{{ Storage::url($course->thumbnail) }}" alt="PMP Course" class="w-full h-48 object-cover">
            <div class="p-6 flex-grow flex flex-col">
                <h3 class="kt-portlet__head-title mb-2">{{ $course->title }}</h3>
                <p class="text-gray-600 text-sm mb-4 flex-grow">{{ $course->description }}</p>
                <div class="text-xs text-gray-500 space-y-2">
                    <p><strong>Instructor:</strong> {{ $course->instructor->name }}</p>
                    <p><strong>Category:</strong> {{ $course->category }}</p>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-between items-center">
                <span class="text-xl font-bold text-gray-800">د.ل {{ $course->price }}</span>
                <a href="{{ route('courses.show', $course) }}" class="btn-brand font-bold py-2 px-4 rounded-md text-sm transition duration-300">View Details</a>
            </div>
        </div>
        @endforeach
    </div>

    {{ $courses->links() }}

</main>
@endsection