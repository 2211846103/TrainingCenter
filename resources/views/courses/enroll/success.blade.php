@extends('layouts.guest')

@section('title', 'Enrollment Successful')

@section('content')
<main class="container mx-auto px-6 py-24">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] p-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
            <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-[#282a3c] mb-2">Enrollment Successful!</h1>
        <p class="text-gray-600 mb-6">
            Thank you for registering. A confirmation email with all the course details has been sent to your inbox.
        </p>
        <a href="{{ route('dashboard') }}" class="px-6 py-3 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Go to Your Dashboard
        </a>
    </div>
</main>
@endsection