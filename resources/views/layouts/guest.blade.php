<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | ITSE408</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="font-sans bg-[#f6f7fb] text-gray-800 antialiased">

<div class="flex flex-col min-h-screen">
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-[1320px] mx-auto px-4 flex items-center justify-between h-[95px]">
            <div class="flex items-center gap-10">
                <a href="/" class="flex items-center gap-2.5">
                    <img class="h-[34px]" src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/app/mini-logo-circle-primary.svg" alt="Logo">
                    <span class="text-lg font-medium hidden md:block">ITSE408</span>
                </a>
                <nav class="hidden lg:flex items-stretch h-full">
                     <a href="{{ route('home') }}" class="flex items-center px-4 text-sm font-medium border-b-2 {{ (Route::currentRouteName() == "home") ? "border-blue-500 text-gray-900" : "border-transparent text-gray-500" }} hover:text-gray-900">Home</a>
                     <a href="{{ route('courses.index') }}" class="flex items-center px-4 text-sm font-medium border-b-2 {{ (Route::currentRouteName() == "courses.index") ? "border-blue-500 text-gray-900" : "border-transparent text-gray-500" }} hover:text-gray-900">Courses</a>
                </nav>
            </div>

            <div class="flex items-center flex-wrap gap-3">
                 @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">Dashboard</a>
                         <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600">Login</a>
                    <a href="{{ route('auth.register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Sign Up</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow" id="content">
        @yield('content')
    </main>

    <footer class="mt-auto bg-white">
        <div class="max-w-[1320px] mx-auto px-4">
            <div class="border-t">
                <div class="flex flex-col md:flex-row justify-between items-center gap-3 py-5 text-sm">
                    <div class="text-gray-500">
                        2025© <a href="/" class="font-semibold text-gray-600 hover:text-blue-600">ITSE408</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

</body>
</html>