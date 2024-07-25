<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="w-[100vw]">

    <nav class="w-full px-[10%] py-8 flex bg-red-600 text-white justify-between items-center absolute top-0 left-0">
        <h1 class="text-3xl font-bold">DSS MOORA</h1>
        <div class="flex items-center font-bold">
            <a href="{{ route('home') }}" class="mr-4">Home</a>
            <a href="{{ route('dashboard') }}" class="mr-4">Dashboard</a>
        </div>
    </nav>

    <div class="px-[10%] pb-16">
        @yield('content')
    </div>

</body>

</html>
