<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Judul halaman dinamis, dengan judul default 'ReadyLab' --}}
    <title>@yield('title', 'ReadyLab')</title>

    {{-- Memuat Vite untuk Tailwind CSS dan file JS utama --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white text-gray-800 antialiased">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')


</body>
</html>