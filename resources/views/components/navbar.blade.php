@auth
    @if (!auth()->user()->hasVerifiedEmail())
    <div class="block bg-red-300 p-2 text-center text-white">
        Hey {{ auth()->user()->name }}, Your Email isn't verified!
        <a class="underline hover:text-indigo-500" href="{{ route('verification.resend') }}" onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">
            Click Here
        </a> to Resend.
        <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}" class="hidden">
            @csrf
        </form>
    </div>
    @endif
@endauth

<nav class="section nav lg:z-20 bg-bg-blue-darkest relative lg:py-3" style="height: 60px;">
    <div class="flex justify-between h-full items-center relative">
        <div class="xl:flex-1 mr-4 xl:mr-0">
            <a href="{{ url('') }}" class="cursor-pointer leading-none inline-block link-brand">
                <img src="{{ asset('assets/images/logo_white.png') }}" style="height: 36px;">
            </a>
        </div>
        <div class="navbar-links xl:flex-grow relative hidden md:flex md:justify-center text-xs lg:text-sm xl:w-1/2">
            <a href="{{ route('discussion.index') }}" class="navbar-link text-gray-300 border-b-8 border-transparent hover:border-white m-3 md:px-1 xl:px-0 py-4 pt-6 block uppercase text-transparent-50 font-semibold hover:text-white {{ request()->is( str_replace(url('') . '/', '', route('discussion.index')) . '*') ? 'active' : '' }}">
                Discussion
            </a>
            <a href="{{ route('discussion.index') }}" class="navbar-link text-gray-300 border-b-8 border-transparent hover:border-white m-3 md:px-1 xl:px-0 py-4 pt-6 block uppercase text-transparent-50 font-semibold hover:text-white">
                Article
            </a>
            <a href="{{ route('discussion.index') }}" class="navbar-link text-gray-300 border-b-8 border-transparent hover:border-white m-3 md:px-1 xl:px-0 py-4 pt-6 block uppercase text-transparent-50 font-semibold hover:text-white">
                Series
            </a>
        </div>

        <div class="pl-4 py-2 ml-2 md:block flex text-right">
            <button class="mr-4 bg-gray-100 button-transparent hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 15 15" class="text-white"><g fill="none" fill-rule="evenodd"><path d="M-2-2h20v20H-2z"></path> <path d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z" class="fill-current"></path></g></svg>
            </button>
            @auth
                <a href="javascript:void()" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mr-2">
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
                <a href="javascript:void()" class="app-drawer-btn bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded inline-flex items-center pr-2">
                    <i class="fa fa-bars p-0"></i>
                </a>
            @else
                <a href="{{ route('register') }}" class="hidden lg:inline-flex md:inline-flex sm:inline-flex lg: text-white font-semibold mr-4 mt-2 lg:mt-0">
                    <span>Register</span>
                </a>
                <a href="{{ route('login') }}" class="hidden lg:inline-flex md:inline-flex sm:inline-flex lg: bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded items-center">
                    <span>Login</span>
                </a>
                <a href="javascript:void()" class="app-drawer-btn bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded inline-flex items-center pr-2 lg:hidden md:hidden sm:hidden">
                    <i class="fa fa-bars p-0"></i>
                </a>
            @endauth
        </div>
    </div>
</nav>


@auth
    <div class="app-drawer-bg hidden w-full h-full fixed z-30 top-0" style="background: rgba(0, 0, 0, .5)"></div>
    <div class="app-drawer hidden w-10/12 md:w-3/12 fixed right-0 h-full bg-gray-100 z-40 top-0 text-center pt-10">
        <div class="flex flex-col items-center text-center overflow-y-auto">
            <a href="{{ url('/@') . auth()->user()->username }}" class="block">
                <img src="{{ asset('avatar/' . auth()->user()->avatar) }}" alt="Avatar" width="70" class="rounded-full">
            </a>
            <div class="mb-8 mt-4">
                <a href="{{ url('/@') . auth()->user()->username }}" class="btn text-2xs bg-indigo-400 p-2 rounded p-0 pr-4 leading-none text-center px-4 text-white">
                    {{ auth()->user()->name }}
                </a>
            </div>

            <ul class="text-center w-8/12">
                <li class="py-2">
                    <a href="{{ url('/') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Home
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('discussion.index') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Discussion
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ url('/@') . auth()->user()->username }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        My Profile
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('setting') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Setting
                    </a>
                </li>
                <li class="py-2">
                    <a href="javascript:void()" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        <span>Logout</span>
                    </a>
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
                    <a href="{{ url('/') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Home
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('discussion.index') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Discussion
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('login') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Login
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('register') }}" class="block hover:text-gray-700 hover:bg-gray-200 rounded py-2 text-gray-500 font-bold uppercase">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </div>

@endauth

@push('js')
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script>
    let appDrawerState = false;
    const handleAppDrawer = (e) => {
        e.preventDefault()
        appDrawerState = !appDrawerState
        let appDrawer = $('.app-drawer');
        if (appDrawerState) {
            appDrawer.css('right', 0 - appDrawer.width()).removeClass('hidden').animate({ right: 0 });
            $('.app-drawer-bg').fadeIn(1000, () => $(this).removeClass('hidden'));
            $('body').css('overflow', 'hidden');
        } else {
            appDrawer.animate({ right: 0 - appDrawer.width() }, { complete: () => appDrawer.addClass('hidden') });
            $('.app-drawer-bg').fadeOut(500, () => $(this).addClass('hidden'));
            $('body').css('overflow', 'auto');
        }
    }
    $('.app-drawer-bg').on('click', handleAppDrawer);
    $('.app-drawer-btn').on('click', handleAppDrawer);
</script>
@endpush