<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-white">
    @if(request()->routeIS('home'))
         {{ $slot }}
    @else
        @include('layouts.navigation')
        {{ $slot }}
    @endif
   

    @livewireScripts

</body>

</html>
