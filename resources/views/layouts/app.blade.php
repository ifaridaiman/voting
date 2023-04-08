<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        @vite('resources/css/app.css')

        @yield('header')
    </head>
    <body class="antialiased">
        <div class="max-w-xl mx-auto container">
            @yield('content')

        </div>
    </body>
</html>
