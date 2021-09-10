<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($title) ? $title . ' - ' : '') }}{{ config('app.name', 'Devover') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_white.png') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    <!-- loading -->
    <div class="loading w-full fixed h-full bg-gray-300 flex justify-center items-center z-50">
        <img src="{{ asset('assets/images/logo_blue_square.svg') }}" style="height: 100px;">
    </div>

    <!-- app -->
    <div id="app">
        <!-- navbar -->
        @if (isset($navbar) && $navbar) <x-navbar /> @endif

        <!-- content -->
        <div class="wrapper pt-8 lg:pt-10">
            @yield('content')
        </div>

        <!-- footer -->
        @if (isset($footer) && $footer) <x-footer /> @endif
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('js')
    {{-- ^ preload animation, and other script ^ --}}
</body>
