<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Training Center</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    @stack('scripts')
</head>
<body class="font-sans bg-[#f6f7fb] text-gray-800 antialiased">

<div class="flex flex-col min-h-screen">
    <header class="sticky top-0 z-50 bg-white/70 backdrop-blur-md shadow-sm">
        <div class="max-w-[1320px] mx-auto px-4 flex items-center justify-between h-[95px]">
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <img class="h-[34px]" src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/app/mini-logo-circle-primary.svg" alt="Logo">
                    <span class="text-lg font-medium hidden md:block">TrainingCenter</span>
                </a>
                <nav class="hidden lg:flex items-stretch h-full">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 text-sm font-medium text-gray-900">Dashboard</a>
                    @hasrole('admin')
                    <a href="{{ route('courses.manage') }}" class="flex items-center px-4 text-sm font-medium text-gray-900">Courses</a>
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 text-sm font-medium text-gray-900">Users</a>
                    @endhasrole
                </nav>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">
                        <div class="text-right">
                            <div class="font-semibold text-xs uppercase">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <img src="{{ Storage::url(auth()->user()->profile_image) }}" class="w-9 h-9 rounded-full flex items-center justify-center font-bold">
                    </a>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <div class="bg-white border-b border-t border-gray-200">
        <div class="max-w-[1320px] mx-auto px-4">
            <div class="flex items-center justify-between flex-wrap gap-2 py-5">
                <div class="flex flex-col gap-1">
                    <h1 class="font-medium text-lg">@yield('title')</h1>
                    <div class="flex items-center gap-1 text-sm text-gray-500">
                       @yield('breadcrumbs', '<a href="#" class="hover:text-blue-600">Home</a>')
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @yield('toolbar-actions')
                </div>
            </div>
        </div>
    </div>

    <main class="flex-grow py-8">
        <div class="max-w-[1320px] mx-auto px-4">
            @yield('content')
        </div>
    </main>

    <footer class="mt-auto bg-white">
        <div class="max-w-[1320px] mx-auto px-4">
            <div class="border-t">
                <div class="flex flex-col md:flex-row justify-between items-center gap-3 py-5 text-sm">
                    <div class="text-gray-500">
                        2025© <a href="#" class="font-semibold text-gray-600 hover:text-blue-600">TrainingCenter</a>
                    </div>
                    <nav class="flex gap-4 font-medium text-gray-600">
                        <a class="hover:text-blue-600" href="#">About</a>
                        <a class="hover:text-blue-600" href="#">Support</a>
                        <a class="hover:text-blue-600" href="#">License</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
</div>

</body>
</html>