@extends('layouts.dashboard')

@section('title', 'Archived Materials')

@section('breadcrumbs')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">{{ $course->title }} (Archive)</span>
@endsection

@section('content')

    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-md mb-8" role="alert">
        <p class="font-bold">This course is archived.</p>
        <p class="text-sm">All materials are read-only. You can review the content and download resources at any time.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-black rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)] aspect-video flex items-center justify-center">
                {{-- Dynamically show content based on material type --}}
                @if ($material->type === 'video')
                    <video controls class="w-full h-full rounded-lg object-cover">
                        <source src="{{ Storage::url($material->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($material->type === 'document')
                    <a href="{{ Storage::url($material->file_path) }}" download
                       class="text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                        Download Document
                    </a>
                @elseif ($material->type === 'presentation')
                    <img src="{{ Storage::url($material->file_path) }}" alt="Material image" class="w-full h-full object-contain rounded-lg">
                @else
                    <p class="text-white text-xl">Unsupported content type</p>
                @endif
            </div>

            <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-[#48465b]">{{ $material->order }}. {{ $material->name }}</h2>
                    <a href="{{ Storage::url($material->file_path) }}" download class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                        Download
                    </a>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 leading-relaxed">
                        {{ $material->description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-[#48465b]">Course Content</h2>
                </div>
                <div class="p-4 border-b border-gray-200">
                    <a href="{{ route('materials.download', $course) }}" class="w-full text-center block bg-gray-100 font-bold py-3 px-4 rounded-md hover:bg-gray-200 transition duration-300 text-sm text-gray-800">
                        Download All Materials
                    </a>
                </div>
                <div class="divide-y divide-gray-200 max-h-[400px] overflow-y-auto">
                    {{-- Dynamically list all materials --}}
                    @foreach ($course->materials as $lesson)
                        @php
                            $is_active = $lesson->order == $material->order;
                        @endphp
                        <div class="flex items-center">
                            <div class="mr-3 flex-shrink-0 {{ $is_active ? 'text-blue-600' : 'text-gray-500' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" /></svg>
                            </div>
                            <div>
                                <div class="font-semibold text-sm {{ $is_active ? 'text-blue-700' : 'text-gray-800' }}">{{ $lesson->order }}. {{ $lesson->name }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ ucfirst($lesson->type) }} - {{ $lesson->type == 'video' ? \Carbon\CarbonInterval::seconds($lesson->length_in_sec)->cascade()->forHumans([
                                        'short' => false,
                                        'parts' => 3,
                                        'join' => true,
                                    ]) : $lesson->extension }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection