<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aqar Masr') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&family=Parisienne&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
        }

        .plans-container {
            position: absolute;
            top: 0%;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            background-color: rgba(0, 0, 0, .3);
            display: none;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
            padding: 50px 0 50px 0;
        }

        .plans-container:before {
            font-size: 19px;
            content: "X";
            position: absolute;
            top: 10px;
            left: 12px;
            background: white;
            color: red;
            padding: 0 12px;
            font-weight: 800;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
