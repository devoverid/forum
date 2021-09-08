{{-- Verification Alert --}}
@auth
    @if (!auth()->user()->hasVerifiedEmail())
        <div class="block bg-red-300 p-2 text-center text-white">
            Hey {{ auth()->user()->name }}, Your Email isn't verified!
            <a class="underline hover:text-indigo-500" href="{{ route('verification.resend') }}"
                onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">
                Click Here
            </a> to Resend.
            <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}"
                class="hidden">
                @csrf
            </form>
        </div>
    @endif
@endauth

@php
$links = [['text' => 'Discussion', 'link' => route('discussion.index')], ['text' => 'Owners', 'link' => route('owner')]];
@endphp

{{-- Navbar --}}
<nav class="section nav lg:z-20 relative px-2 lg:px-10 lg:py-1 z-30">
    <div class="container mx-auto">
        <div class="flex justify-between h-full items-center relative px-2">
            <!-- left menu -->
            <div class="flex items-center xl:mr-0">
                <div class="logo mr-4">
                    <a href="{{ url('/') }}" class="cursor-pointer leading-none inline-block link-brand">
                        <img src="{{ asset('assets/images/logo_blue_square.svg') }}" class="h-12">
                    </a>
                </div>

                <div class="navbar-links relative hidden md:flex md:justify-center text-xs lg:text-sm">
                    @foreach ($links as $link)
                        <a href="{{ $link['link'] }}"
                            class="navbar-link text-gray-500  block hover:text-gray-700 {{ request()->is(str_replace(url('') . '/', '', $link['link']) . '*') ? 'active font-bold' : '' }}">
                            {{ $link['text'] }}
                        </a>
                    @endforeach
                </div>

            </div>
            <!-- right menu -->
            <div class="pl-4 py-2 ml-2 md:block flex text-right">
                @auth
                    <a href="javascript:void()" class="app-drawer-btn bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded inline-flex items-center pr-2">
                        <i class="fa fa-bars p-0"></i>
                        <span class="text-sm mr-3 hidden md:inline">Menu</span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="navbar-link hidden lg:inline-flex md:inline-flex sm:inline-flex text-gray-600 hover:border-white mr-4 mt-2 py-4 pt-6 lg:mt-0">
                        <span>Register</span>
                    </a>
                    <a href="{{ route('login') }}" class="hidden lg:inline-flex md:inline-flex sm:inline-flex bg-blue-500 text-white py-2 px-6 rounded items-center hover:bg-blue-600">
                        <span>Login</span>
                    </a>
                    <a href="javascript:void()" class="app-drawer-btn bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded inline-flex items-center pr-2 lg:hidden md:hidden sm:hidden">
                        <i class="fa fa-bars p-0"></i>
                        <span class="text-sm mr-3 hidden md:inline">Menu</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>


{{-- App Drawer --}}
@auth
    <div class="app-drawer-bg hidden w-full h-full fixed z-30 top-0" style="background: rgba(0, 0, 0, .5)"></div>
    <div class="app-drawer hidden w-10/12 md:w-3/12 fixed right-0 h-full bg-gray-100 z-40 top-0 text-center pt-10">
        <div class="flex flex-col items-center text-center overflow-y-auto">
            <a href="{{ url('/@') . auth()->user()->username }}" class="block">
                <img src="{{ asset('avatar/' . auth()->user()->avatar) }}" alt="Avatar" width="70"
                    class="rounded-full">
            </a>
            <div class="mb-8 mt-4">
                <a href="{{ url('/@') . auth()->user()->username }}"
                    class="btn text-2xs bg-indigo-400 p-2 rounded p-0 pr-4 leading-none text-center px-4 text-white">
                    {{ auth()->user()->name }}
                </a>
            </div>

            <ul class="text-center w-8/12">
                <li class="py-2">
                    <a href="{{ url('/') }}"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Home
                    </a>
                </li>
                {{-- dynamyc link --}}
                @foreach ($links as $link)
                    <li class="py-2">
                        <a href="{{ $link['link'] }}"
                            class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                            {{ $link['text'] }}
                        </a>
                    </li>
                @endforeach
                <li class="py-2">
                    <a href="{{ url('/@') . auth()->user()->username }}"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        My Profile
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('setting') }}"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Setting
                    </a>
                </li>
                <li class="py-2">
                    <a href="javascript:void()"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
@else
    <div class="app-drawer-bg hidden w-full h-full fixed z-30 top-0" style="background: rgba(0, 0, 0, .5)"></div>
    <div class="app-drawer hidden w-10/12 md:w-3/12 fixed right-0 h-full bg-gray-100 z-40 top-0 text-center pt-10">
        <div class="flex flex-col items-center text-center overflow-y-auto">
            <ul class="text-center w-8/12">
                <li class="py-2">
                    <a href="{{ url('/') }}"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Home
                    </a>
                </li>
                {{-- dynamyc link --}}
                @foreach ($links as $link)
                    <li class="py-2">
                        <a href="{{ $link['link'] }}"
                            class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                            {{ $link['text'] }}
                        </a>
                    </li>
                @endforeach
                <li class="py-2">
                    <a href="{{ route('login') }}"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Login
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('register') }}"
                        class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endauth
