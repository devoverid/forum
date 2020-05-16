<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($title) ? $title . ' - ' : '') }}{{ config('app.name', 'Devover Forum') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_white.png') }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        body {
            color: #4d545d;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.428571428571429;
        }
        .nav:not(.bg-transparent):not(.bg-laracasts-light) {
            background-image: linear-gradient(90deg,#8796F0,#4261EB);
            background-position: 0 0;
        }
        .navbar-link {
            transition: border .2s ease-in;
            min-width: 5rem;
            text-align: center;
        }
        .navbar-link.active {
            color: white;
            border-color: white!important;
        }
        .link-brand img { transition: all .4s ease-in-out; }
        .link-brand:hover img { transform: rotate(360deg); }
        .button-transparent { background: rgba(255, 255, 255, 0.3); }
        .button-transparent:hover { background: rgba(255, 255, 255, 0.5); }
        .section, section {
            position: relative;
            padding-left: 20px;
            padding-right: 20px;
        }
        @media (min-width: 768px) {
            .section, section {
                padding-left: 40px;
                padding-right: 40px;
            }
        }
        .btn-blue {
            background-color: #328af1;
            background-color: rgba(50,138,241, 1);
            color: #fff;
            color: rgba(255,255,255, 1);
            border-color: #328af1;
            border-color: rgba(50,138,241, 1);
            padding: .6rem 2rem;
            width: 100%;
            cursor: pointer;
        }
        .btn-blue:hover {
            background-color: rgba(39,121,189, 1);
            color: rgba(255,255,255, 1);
            border-color: rgba(50,138,241, 1);
        }
        a > i.fa, a > i.far, a > i.fas,
        button > i.fa, button > i.far, button > i.fas {
            font-size: 1rem;
            margin-right: .6rem;
        }
        *:focus {
            outline: none;
        }
        .is-circle { border-radius: 50%; }
        .loading img {
            -webkit-animation:rotate-center .6s ease-in infinite both;animation:rotate-center 1s ease-out infinite both}
        }
        @-webkit-keyframes rotate-center{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotate-center{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
    </style>
    @stack('css')
</head>
<body>
    <!-- loading -->
    <div class="loading w-full fixed h-full bg-gray-300 flex justify-center items-center">
        <img src="{{ asset('assets/images/logo_white.png') }}" style="height: 100px;">
    </div>

    <!-- app -->
    <div id="app" class="hidden">
        <!-- navbar -->
        @if (isset($navbar) && $navbar) <x-navbar /> @endif

        <!-- content -->
        <div class="wrapper">
            @yield('content')
        </div>

        <!-- footer -->
        @if (isset($footer) && $footer) <x-footer /> @endif
    </div>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on("scroll", () => {
            let sticky = $('.sticky')
            let offset = 50;
            if (sticky.length == 0) return 
            if( $(document).scrollTop() >= sticky.offset().top - offset ) {
                sticky.css({ position: 'sticky', top: offset })
            }
        })
    </script>
    @stack('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                $('#app').removeClass('hidden');
                $('.loading').fadeOut();
            }, 1000)
        });
        $(window).bind('beforeunload', function(){
            $('#app').addClass('hidden');
            $('.loading').css('display', 'flex');
        });        
    </script>
</body>