@extends('layouts.dashboard')

@section('title', 'Add New Material')

@section('breadcrumbs')
    <a href="#" class="hover:text-blue-600">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800">New Material</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-[0_0_30px_0_rgba(82,63,105,0.05)]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-[#48465b]">Upload Course Material</h2>
        </div>
        
        <form method="POST" action="{{-- route('materials.store') --}}" enctype="multipart/form-data">
            {{-- @csrf --}}
            <div class="p-8 space-y-6">

                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                    <select id="course_id" name="course_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="">Select a course...</option>
                        <option value="1" selected>Web Development Bootcamp</option>
                        <option value="2">Advanced Laravel</option>
                        <option value="3">Intro to Vue.js</option>
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Material Title</label>
                    <input type="text" id="title" name="title" placeholder="e.g., 'Chapter 1 Slides'" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload a file</span>
                                    <input id="file-upload" name="file_upload" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, PNG, JPG, ZIP up to 10MB</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-200 flex justify-end">
                <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Upload Material
                </button>
            </div>
        </form>
    </div>
</div>
@endsection