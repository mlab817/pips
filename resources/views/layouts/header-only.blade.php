<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="shortcut icon" type="image/ico" href="/images/icons/favicon.ico"/>

    <!-- CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    <link href="https://unpkg.com/@github/details-dialog-element/dist/index.css" rel="stylesheet" />

    @livewireStyles

    @yield('styles')
</head>
<body>
    @include('includes.header')

    <main>
        <div class="container-md my-6 px-3 px-md-4 px-lg-5">
            @yield('content')
        </div>
    </main>

    @livewireScripts
    <script defer src="https://unpkg.com/alpinejs@3.1.1/dist/cdn.min.js"></script>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
