<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('app.name', 'Training Center') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .auth-card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 0 13px 0 rgba(82, 63, 105, 0.05);
        }
        .btn-brand {
            background-color: #5867dd;
            color: #ffffff;
        }
        .btn-brand:hover {
            background-color: #4a59d1;
        }
    </style>
</head>
<body class="bg-[#f2f3f8]">

    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="mb-8 text-3xl font-bold text-gray-800">
            <a href="/">TrainingCenter</a>
        </div>

        <div class="w-full max-w-md auth-card">
            @yield('content')
        </div>
    </div>

</body>
</html>