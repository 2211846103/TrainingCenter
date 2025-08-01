@extends('layouts.dashboard')

@section('title', 'Course Participants')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">Participants for {{ $course->title }}</span>
@endsection

@section('toolbar-actions')
    <a href="{{ route('courses.students.export', $course) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
        Export List
    </a>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-medium text-[#48465b]">Enrolled Students ({{ $course->students->count() }} / {{ $course->capacity }})</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-sm text-gray-600 uppercase">
                <tr>
                    <th class="px-6 py-3 font-medium">Student Name</th>
                    <th class="px-6 py-3 font-medium">Email Address</th>
                    <th class="px-6 py-3 font-medium">Registered On</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
              @foreach ($course->students as $student)
              <tr>
                  <td class="px-6 py-4">
                      <div class="font-medium text-gray-800">{{ $student->name }}</div>
                  </td>
                  <td class="px-6 py-4 text-gray-600">{{ $student->email }}</td>
                  <td class="px-6 py-4 text-gray-600">{{ \Illuminate\Support\Carbon::parse($student->pivot->registered_at)->format('F j, Y') }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="p-6 border-t border-gray-200">
        {{-- Pagination links would go here --}}
    </div>
</div>
@endsection