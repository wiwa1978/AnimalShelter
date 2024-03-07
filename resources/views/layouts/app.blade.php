<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-white">
    @if(request()->routeIs('home'))
         {{ $slot }}
    @else
        @include('layouts.navigation')
        {{ $slot }}
    @endif


 

    @livewireScripts
</body>

</html>
