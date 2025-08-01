@extends('layouts.guest')

@php
use \App\Services\CourseService;
@endphp

{{-- The title will be the name of the course --}}
@section('title', 'Web Development Bootcamp')

@section('content')
<main class="container mx-auto px-6 py-12">

    <div class="mb-8 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-[#5867dd]">Home</a>
        <span class="mx-2">&gt;</span>
        <a href="{{ route('courses.index') }}" class="hover:text-[#5867dd]">Courses</a>
        <span class="mx-2">&gt;</span>
        <span class="text-gray-800">{{ $course->title }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2">
            <div class="kt-portlet">
                <img src="{{ Storage::url($course->thumbnail) }}" alt="Course Image" class="w-full h-auto rounded-t-md">
                <div class="p-8">
                    <h1 class="kt-portlet__head-title text-2xl mb-4">{{ $course->title }}</h1>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $course->description }}
                    </p>
                </div>
            </div>
        </div>

        <div>
            <div class="kt-portlet p-6">
                <div class="text-3xl font-bold text-center mb-4">${{ $course->price }}</div>
                @guest
                    <a href="{{ route('login') }}" class="w-full text-center block btn-brand font-bold py-3 px-4 rounded-md transition duration-300">
                        Login to Enroll
                    </a>
                @else
                    @hasrole('client')
                        @if (auth()->user()->hasPurchased($course))
                            <div class="w-full text-center block btn-brand font-bold py-3 px-4 rounded-md transition duration-300">
                                Already Enrolled
                            </div>
                        @else
                            <form action="{{ route('courses.enroll', $course) }}" method="post">
                                @csrf
                                <button type="submit" class="cursor-pointer w-full text-center block btn-brand font-bold py-3 px-4 rounded-md transition duration-300">
                                    Enroll Now
                                </button>
                            </form>
                        @endif
                    @endhasrole
                @endguest
            </div>

            <div class="kt-portlet mt-8">
                <div class="p-6 divide-y divide-gray-200">
                    <div class="py-4 first:pt-0 last:pb-0">
                        <div class="font-bold mb-2">Instructor</div>
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full mr-3" src="{{ Storage::url($course->instructor->profile_image) }}" alt="Instructor Avatar">
                            <span class="text-gray-800">{{ $course->instructor->name }}</span>
                        </div>
                    </div>
                    <div class="py-4 first:pt-0 last:pb-0">
                        <div class="font-bold mb-1">Duration</div>
                        <span class="text-gray-600">{{ CourseService::durationHuman($course) }}</span>
                    </div>
                    <div class="py-4 first:pt-0 last:pb-0">
                        <div class="font-bold mb-1">Skill Level</div>
                        <span class="text-gray-600">{{ $course->skill_level }}</span>
                    </div>
                    @if ($course->certified)
                    <div class="py-4 first:pt-0 last:pb-0">
                        <div class="font-bold mb-1">Certificate</div>
                        <span class="text-gray-600">Certificate of Completion</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</main>
@endsection