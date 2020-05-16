@extends('layouts.app', [
    'title' => 'Login',
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <div class="block bg-gray-200 font-sans text-gray-700">
        <div class="flex items-center lg:p-20 w-full">

            <div class="lg:w-8/12 md:w-full hidden pr-20 md:block text-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="">
                <p class="mt-4 leading-relaxed mb-4 text-center">
                    <b>{{ env('APP_NAME', 'Devover Forum') }}</b> merupakan situs forum yang
                    bisa mebantu anda dalam bertanya, berdiskusi bersama di seputar teknologi
                    Pemrogaman IT.
                </p>
                <a href="{{ route('discussion.index') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <span>Discussion</span>
                </a>
            </div>

            <div class="lg:w-4/12 md:w-full">    
                <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                    <div class="font-semibold text-gray-700 pt-4 px-6 mb-0 text-xl">
                        Login
                    </div>
                    <div class="p-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Email</label>
                                <input type="email" name="email" class="block w-full p-3 rounded bg-gray-200 border-transparent focus:outline-none hover:bg-gray-300 focus:bg-gray-300 @error('email') border-4 border-red-300 @enderror" required autocomplete="email" autofocus>
                            </div>

                            @error('email')
                            <p class="text-red-500 text-xs italic my-4">
                                {{ $message }}
                            </p>                                
                            @enderror
                    
                            <div class="mb-5">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
                                <input type="password" name="password" class="block w-full p-3 rounded bg-gray-200 border-transparent focus:outline-none hover:bg-gray-300 focus:bg-gray-300 @error('password') border-4 border-red-300 @enderror" required autocomplete="password">
                            </div>

                            @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>                                
                            @enderror
    
                            <button type="submit" class="block text-center w-full p-3 mt-4 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600">Login</button>
                            
                            <a href="{{ route('auth.github') }}" class="block text-center w-full p-3 mt-4 bg-black text-white rounded shadow hover:bg-gray-900">
                                <svg class="w-5 fill-current text-white inline-block mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><rect width="24" height="24" opacity="0"></rect><path d="M16.24 22a1 1 0 0 1-1-1v-2.6a2.15 2.15 0 0 0-.54-1.66 1 1 0 0 1 .61-1.67C17.75 14.78 20 14 20 9.77a4 4 0 0 0-.67-2.22 2.75 2.75 0 0 1-.41-2.06 3.71 3.71 0 0 0 0-1.41 7.65 7.65 0 0 0-2.09 1.09 1 1 0 0 1-.84.15 10.15 10.15 0 0 0-5.52 0 1 1 0 0 1-.84-.15 7.4 7.4 0 0 0-2.11-1.09 3.52 3.52 0 0 0 0 1.41 2.84 2.84 0 0 1-.43 2.08 4.07 4.07 0 0 0-.67 2.23c0 3.89 1.88 4.93 4.7 5.29a1 1 0 0 1 .82.66 1 1 0 0 1-.21 1 2.06 2.06 0 0 0-.55 1.56V21a1 1 0 0 1-2 0v-.57a6 6 0 0 1-5.27-2.09 3.9 3.9 0 0 0-1.16-.88 1 1 0 1 1 .5-1.94 4.93 4.93 0 0 1 2 1.36c1 1 2 1.88 3.9 1.52a3.89 3.89 0 0 1 .23-1.58c-2.06-.52-5-2-5-7a6 6 0 0 1 1-3.33.85.85 0 0 0 .13-.62 5.69 5.69 0 0 1 .33-3.21 1 1 0 0 1 .63-.57c.34-.1 1.56-.3 3.87 1.2a12.16 12.16 0 0 1 5.69 0c2.31-1.5 3.53-1.31 3.86-1.2a1 1 0 0 1 .63.57 5.71 5.71 0 0 1 .33 3.22.75.75 0 0 0 .11.57 6 6 0 0 1 1 3.34c0 5.07-2.92 6.54-5 7a4.28 4.28 0 0 1 .22 1.67V21a1 1 0 0 1-.94 1z"></path></g></svg>
                                <span class="hidden md:inline-block">Login with GitHub</span>
                                <span class="inline-block md:hidden">Login</span>
                            </a>
                        </form>
                    </div>
                    
                    <div class="flex justify-between p-8 text-sm border-t border-gray-300 bg-gray-100">
                        <a href="{{ route('register') }}" class="font-medium text-indigo-500">Create account</a>
                        <a href="{{ route('password.request') }}" class="text-gray-600">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop