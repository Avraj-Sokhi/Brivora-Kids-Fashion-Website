<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Brivora Kids Fashion') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&family=Fredoka+One&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite / App assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Inline custom styles -->
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            margin: 0;
            padding: 0;
        }

        header {
            background: #1477b5;
            color: white;
            padding: 1rem;
            text-align: center;
            font-family: 'Fredoka One', cursive;
            font-size: 2rem;
            letter-spacing: 2px;
        }

        nav {
            background: #4a90e2;
            padding: 0.5rem;
            text-align: center;
        }

        nav a {
            color: #fff;
            margin: 0 1rem;
            text-decoration: none;
            font-weight: bold;
            font-family: 'Comic Neue', cursive;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffeb3b;
            text-decoration: underline;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem;
            flex-wrap: wrap;
        }

        .filters input,
        .filters select {
            padding: 0.5rem;
            border: 2px solid #ff6f61;
            border-radius: 10px;
            font-family: 'Comic Neue', cursive;
            background-color: #fff8e1;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }

        .card {
            border: 3px solid #0320ff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            background: #fff;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #ff6f61;
        }

        .card-body {
            padding: 1rem;
            background-color: #f0f9ff;
        }

        .card-body h3 {
            margin: 0 0 .5rem;
            font-family: 'Fredoka One', cursive;
            color: #ff6f61;
        }

        .card-body p {
            margin: .3rem 0;
            color: #333;
        }

        .stock {
            font-size: .9rem;
            margin-top: .5rem;
            font-weight: bold;
            color: #4caf50;
        }

        .btn {
            background: #ff6f61;
            color: white;
            border: none;
            padding: .5rem 1rem;
            cursor: pointer;
            border-radius: 20px;
            font-family: 'Comic Neue', cursive;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #ff4081;
        }

        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100" style="display: flex; flex-direction: column;">
        {{-- Laravel navigation removed - using custom nav component in pages instead --}}

        {{-- Page Content --}}
        <main style="flex: 1;">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>

        <x-footer />
    </div>
</body>

</html>