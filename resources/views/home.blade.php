@extends('layouts.guest')

@section('title', 'Welcome to the Training Center')

@section('content')
<main class="container mx-auto px-6 py-12">

    <section class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-[#282a3c] mb-4">Unlock Your Potential</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">Join thousands of learners and advance your career with our professional training courses, designed by industry experts.</p>
    </section>

    <section>
        <h2 class="text-3xl font-bold text-center text-[#282a3c] mb-8">Featured Courses</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($courses as $course)
            <div class="bg-white rounded-md flex flex-col">
                <div class="p-6 flex-grow">
                    <div class="kt-portlet__head-title mb-4">{{ $course->title }}</div>
                    <p class="text-gray-600 mb-4">{{ $course->description }}</p>
                </div>
                <div class="p-6 border-t border-gray-200">
                    <a href="{{ route('courses.show', $course) }}" class="font-semibold text-[#5867dd] hover:underline">Learn More &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="mt-20">
        @php
        use \App\Services\CourseService;
        function round_zeros($num)
        {
            $result = floor($num / pow(10, strlen($num) - 1)) * pow(10, strlen($num) - 1);
            return $result < 10 ? $num : $result;
        }
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="kt-portlet p-8">
                <div class="text-4xl font-bold text-[#34bfa3]">{{ round_zeros($courses->count()) }}+</div>
                <div class="mt-2 text-gray-600">Expert-Led Courses</div>
            </div>
            <div class="kt-portlet p-8">
                <div class="text-4xl font-bold text-[#ffb822]">{{ round_zeros($courses->flatMap->students->count()) }}+</div>
                <div class="mt-2 text-gray-600">Students Enrolled</div>
            </div>
            <div class="kt-portlet p-8">
                <div class="text-4xl font-bold text-[#fd3995]">{{ CourseService::percetageCompleted() }}%</div>
                <div class="mt-2 text-gray-600">Completion Rate</div>
            </div>
        </div>
    </section>

</main>
@endsection