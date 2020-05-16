<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
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
        a > i.fa, a > i.far, a > i.fas {
            font-size: 1rem;
            margin-right: .6rem;
        }
        *:focus {
            outline: none;
        }
        .is-circle { border-radius: 50%; }
    </style>
</head>
<body>
    <div id="app">
        <!-- navbar -->
        <nav class="section nav lg:z-50 bg-bg-blue-darkest lg:py-3" style="height: 60px;">
            <div class="flex justify-between h-full items-center relative">
                <div class="xl:flex-1 mr-4 xl:mr-0">
                    <a href="{{ url('') }}" class="cursor-pointer leading-none inline-block link-brand">
                        <img src="{{ asset('assets/images/logo_white.png') }}" style="height: 36px;">
                    </a>
                </div>
                <div class="navbar-links xl:flex-grow relative hidden md:flex md:justify-center text-xs lg:text-sm xl:w-1/2">
                    <a href="" class="navbar-link active  text-gray-300 border-b-8 border-transparent hover:border-white m-3 md:px-1 xl:px-0 py-4 pt-6 block uppercase text-transparent-50 font-semibold hover:text-white">
                        Discussion
                    </a>
                    <a href="" class="navbar-link text-gray-300 border-b-8 border-transparent hover:border-white m-3 md:px-1 xl:px-0 py-4 pt-6 block uppercase text-transparent-50 font-semibold hover:text-white">
                        Article
                    </a>
                    <a href="" class="navbar-link text-gray-300 border-b-8 border-transparent hover:border-white m-3 md:px-1 xl:px-0 py-4 pt-6 block uppercase text-transparent-50 font-semibold hover:text-white">
                        Series
                    </a>
                </div>

                <div class="pl-4 py-2 ml-2 md:block flex text-right">
                    <button class="mr-4 bg-gray-100 button-transparent hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 15 15" class="text-white"><g fill="none" fill-rule="evenodd"><path d="M-2-2h20v20H-2z"></path> <path d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z" class="fill-current"></path></g></svg>
                    </button>
                    <button class="text-white font-semibold mr-4 inline-flex">
                        <span>Register</span>
                    </button>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <span>Login</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- page -->
        <div class="wrapper">
            <div class="section py-10">
                <div class="disscussion-wrapper">
                    <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1400px;">
                        <!-- Menu -->
                        <div class="forum-sidebar hidden lg:block flex-none border-r border-solid pr-10" style="border-color: rgb(239, 239, 239);">
                            <div class="sticky">
                                <a class="btn btn-blue rounded">
                                    New Discussion
                                </a>
                                <ul class="pt-2 mt-10 mobile:hidden">
                                    <li class="mt-4 block">
                                        <a href="" class="text-indigo-600 font-bold text-grey-dark text-sm mb-1 hover:text-indigo-600 hover:bg-gray-100 rounded py-2 px-3">
                                            <i class="far fa-comments"></i>
                                            All Threads
                                        </a>
                                    </li>
                                    <li class="mt-4 block">
                                        <a href="" class="text-grey-dark text-sm mb-1 hover:text-indigo-600 hover:bg-gray-100 rounded py-2 px-3">
                                            <i class="far fa-star"></i>
                                            Popular This Week
                                        </a>
                                    </li>
                                    <li class="mt-4 block">
                                        <a href="" class="text-grey-dark text-sm mb-1 hover:text-indigo-600 hover:bg-gray-100 rounded py-2 px-3">
                                            <i class="far fa-star"></i>
                                            Popular All Time
                                        </a>
                                    </li>
                                    <li class="mt-4 block">
                                        <a href="" class="text-grey-dark text-sm mb-1 hover:text-indigo-600 hover:bg-gray-100 rounded py-2 px-3">
                                            <i class="far fa-check-circle"></i>
                                            Solved
                                        </a>
                                    </li>
                                    <li class="mt-4 block">
                                        <a href="" class="text-grey-dark text-sm mb-1 hover:text-indigo-600 hover:bg-gray-100 rounded py-2 px-3">
                                            <i class="far fa-times-circle"></i>
                                            Unsolved
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="forum-main lg:ml-10 lg:flex">
                                <div class="lg:flex-1">

                                    <!-- panel -->
                                    <div class="flex justify-center md:justify-between mb-8 md:mb-4 px-6" style="height: 40px;">
                                        <div class="flex flex-1">
                                            <div>
                                                <div class="select-wrap">
                                                    <select class="text-grey-dark text-sm bg-grey-panel rounded-full px-8 cursor-pointer py-2">
                                                        <option value="all">All</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center md:px-4">
                                            <button class="forum-excerpt-toggle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" class="mx-2">
                                                    <g fill="#78909C" fill-rule="evenodd" class="forum-excerpt-toggle-lines">
                                                        <rect width="15" height="6" rx="2" class="forum-excerpt-toggle-line"></rect>
                                                        <rect width="15" height="6" y="9" rx="2" class="forum-excerpt-toggle-line"></rect>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="forum-excerpt-toggle is-active" disabled="disabled">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" class="mx-2">
                                                    <g fill="#78909C" fill-rule="evenodd" class="forum-excerpt-toggle-lines">
                                                        <rect width="15" height="4" rx="2" class="forum-excerpt-toggle-line"></rect>
                                                        <rect width="8" height="4" y="11" rx="2" class="forum-excerpt-toggle-line"></rect>
                                                        <rect width="15" height="4" y="5.5" rx="2" class="forum-excerpt-toggle-line"></rect>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <form action="" autocomplete="off" class="search-form hidden md:block md:w-52">
                                            <div class="bg-gray-200 hover:bg-gray-300 rounded-full relative">
                                                <i class="fa fa-search absolute mt-3 ml-3"></i>
                                                <input name="q" placeholder="What you looking for?" class="ml-4 px-5 py-3 text-sm w-full h-full bg-gray-200 hover:bg-gray-300 rounded-full" />
                                            </div>
                                        </form>
                                    </div>

                                    <!-- list -->                      
                                    <div class="post-list">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="flex flex-col md:flex-row items-center cursor-pointer rounded-lg hover:bg-gray-100 px-6 py-4">
                                                <div class="avatar w-full md:w-auto md:mr-6 flex items-center md:block mb-4 md:mb-0">
                                                    <a href="" class="block mr-3 md:mr-0">
                                                        <img style="max-height: 50px;" class="rounded-full" src="https://www.gravatar.com/avatar/7bf9b29e0256d345bda5573c05e635f8?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Favatar-29.png">
                                                    </a>
                                                    
                                                    <div class="flex items-center justify-center md:hidden ml-auto mr-3 md:mr-4 bg-grey-panel rounded-xl py-2">
                                                        <div class="flex items-center justify-center mr-4">
                                                            <div class="mr-2"><i class="fa fa-comments"></i></div>
                                                            <span class="text-xs text-grey-dark font-semibold text-left leading-none relative">1</span>
                                                        </div>
                                                        <div class="flex items-center justify-center">
                                                            <div class="mr-2"><i class="fa fa-eye"></i></div>
                                                            <span class="text-xs text-grey-dark font-semibold text-left leading-none">7</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full md:pr-10 lg:pr-0 lg:w-5/6 md:mb-0">
                                                    <h4 class="mb-3 md:mb-1 text-base">
                                                        <a href="" class="font-bold transition-all tracking-tight text-gray-600 hover:text-gray-800 hover:underline link">
                                                            Laravel with bootstrap v3 and v4 it's possible?
                                                        </a>
                                                    </h4>
                                                    <div class="break-words  text-base md:text-sm mb-3 widescreen:pr-10 text-grey-darker phone:leading-loose" style="word-break: break-word;">
                                                        I've used the partial route method. Instead of throwing an 404 page why it is throwing an error like this. How can I handle this? can anyone suggest me?
                                                        THis is my route wh
                                                        <span class="is-muted">...</span>
                                                    </div>
                                                    <div class="text-xs mb-2 text-white">
                                                        <a href="" class="bg-red-400 rounded-lg px-2 py-1">php</a>
                                                    </div>
                                                    <div class="text-grey-dark text-xs">
                                                        <a href="https://laracasts.com/@MichalOravec" class="uppercase font-bold text-blue-400 hover:text-blue-500 hover:underline">
                                                            MichalOravec
                                                        </a> Posted
                                                        <span>
                                                            <span class="font-bold text-gray-500"> 5 minutes ago </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="hidden md:flex md:items-center md:flex-row-reverse text-center md:ml-auto relative pl-4">
                                                    <div class="flex items-center justify-center ml-4">
                                                        <div class="mr-2"><i class="fa fa-comments"></i></div>
                                                        <span class="text-xs text-grey-dark font-semibold text-left leading-none relative">1</span>
                                                    </div>
                                                    <div class="flex items-center justify-center">
                                                        <div class="mr-2"><i class="fa fa-eye"></i></div>
                                                        <span class="text-xs text-grey-dark font-semibold text-left leading-none">7</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>              

                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>


        <!-- footer -->
        <div class="footer-wrap mobile:text-lg bg-gray-500 text-white pt-10">
            {{-- <section class="footer-section top pb-10 pt-10">
                <div class="container">
                    <div class="md:w-4/5 lg:w-1/2 mx-auto text-center">
                        <div>
                            <h2 class="text-white text-3xl pr-1-tablet mb-8 tracking-tight">
                                Want us to email you occasionally with Laracasts news?
                            </h2>
                        </div>
                        <div>
                            <form id="newsletter-form" method="POST" action="/newsletters/subscribe">
                                <div class="flex flex-col md:flex-row justify-center mb-10 lg:mb-0">
                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="Enter your email address"
                                        autocomplete="off"
                                        required="required"
                                        class="md:w-1/2 rounded-xl px-4 py-4 md:py-3 phone:mb-4 text-grey-black text-center md:text-left md:text-xs phone:w-64 phone:mx-auto md:-mr-8"
                                    />
                                    <button
                                        type="submit"
                                        class="btn phone:mx-auto phone:border md:bg-blue hover:bg-blue-dark hover:text-white md:border-none py-5 md:py-4 text-white font-bold uppercase rounded-none rounded-xl md:rounded-xl text-base md:text-xs md:w-32"
                                        style="box-shadow: rgb(119, 119, 119) -6px 0px 11px -7px;"
                                    >
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section> --}}
            <section class="footer-section bottom text-center md:text-left py-0">
                <footer class="container">
                    <div class="md:flex md:mb-3">
                        <div class="md:w-2/5 md:mr-auto">
                            <div class="tw-mb-3 tw-flex tw-justify-center md:tw-block">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="">
                            </div>
                            <p class="mb-8 text-white leading-loose">
                                Komunitas Developer Muda Indonesia, 
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Reprehenderit, voluptates velit? Ex, sint autem ratione nemo ut laboriosam
                            </p>
                        </div>
                        <div class="md:w-1/6 mobile:mb-6">
                            <h5 class="text-white font-bold md:font-semibold mb-2 md:mb-6 uppercase">Learn</h5>
                            <ul class="leading-loose">
                                <li><a href="/join" class="text-gray-300 hover:text-white">Sign Up</a></li>
                                <li>
                                    <a href="/login" class="text-gray-300 hover:text-white">
                                        Sign In
                                    </a>
                                </li>
                                <li><a href="/search?refinement=type&amp;name=series" class="text-gray-300 hover:text-white">Browse</a></li>
                                <li><a href="/index" class="text-gray-300 hover:text-white">Index</a></li>
                            </ul>
                        </div>
                        <div class="md:w-1/6 mobile:mb-6">
                            <h5 class="text-white font-bold md:font-semibold mb-2 md:mb-6 uppercase">Discuss</h5>
                            <ul class="leading-loose">
                                <li><a href="/discuss" class="text-gray-300 hover:text-white">Forum</a></li>
                                <li><a href="/podcast" class="text-gray-300 hover:text-white">Podcast</a></li>
                                <li><a href="/blog" class="text-gray-300 hover:text-white">Blog</a></li>
                                <li>
                                    <div>
                                        <a class="text-gray-300 hover:text-white">
                                            Support
                                        </a>
                                        <!---->
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="md:w-1/6 mobile:mb-8">
                            <h5 class="text-white font-bold md:font-semibold mb-2 md:mb-6 uppercase">Extras</h5>
                            <ul class="leading-loose">
                                <li><a class="text-gray-300 hover:text-white">Testimonials</a></li>
                                <li><a href="/faq" class="text-gray-300 hover:text-white">FAQ</a></li>
                                <li><a href="https://assets.laracasts.com" class="text-gray-300 hover:text-white">Assets</a></li>
                                <li><a href="https://larajobs.com/?partner=36#" target="_blank" rel="noreferrer" class="text-gray-300 hover:text-white">Get a Job</a></li>
                            </ul>
                            <ul class="zeroed leading-loose">
                                <li><a href="/privacy" class="text-gray-300 hover:text-white">Privacy</a></li>
                                <li><a href="/terms" class="text-gray-300 hover:text-white">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-solid py-4 md:mt-8 mobile:text-lg" style="border-color: rgba(255,255,255, 0.5)">
                        <div class="text-gray-300 text-base md:text-xs text-center">
                            <p class="mb-5 md:mb-2 tracking-normal">
                                © Devover 2020. All rights reserved. <br class="md:hidden" />
                                Yes, all of them. That means you, Todd.
                            </p>
                            <p class="tracking-normal">
                                <span class="mobile:block">
                                    Designed with 
                                    <img src="//laracast.com/images/icons/heart.svg" alt="heart" loading="lazy" class="px-1 relative heart-pulse inline" style="top: 2px;" />
                                    by
                                    <a href="https://github.com/viandwi24" class="font-bold inherits-color link hover:text-white">viandwi24</a>.
                                </span>
                            </p>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
        

    </div>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on("scroll", () => {
            let sticky = $('.sticky')
            let offset = 50;
            if( $(document).scrollTop() >= sticky.offset().top - offset ) {
                sticky.css({ position: 'sticky', top: offset })
            }
            // console.log( $('.sticky').offset().top + ' ' + $(document).scrollTop() );
        })
    </script>
</body>