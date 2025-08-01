@extends('layouts.guest')

@section('title', 'Enrollment Canceled')

@section('content')
<main class="container mx-auto px-6 py-24">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
            <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-[#282a3c] mb-2">Enrollment Canceled</h1>
        <p class="text-gray-600 mb-6">
            Your enrollment process was canceled and your payment was not processed. You can browse our courses at any time.
        </p>
        <a href="{{ route('courses.index') }}" class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
            Back to Courses
        </a>
    </div>
</main>
@endsection