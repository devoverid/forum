@extends('layouts.app', [
    'title' => 'Setting',
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <div class="block bg-gray-200 font-sans text-gray-700">
        <div class="container flex mx-auto items-center lg:p-20 p-8">
            <div class="max-w-md w-full mx-auto">
                <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                    <div class="font-semibold text-gray-700 pt-4 px-6 mb-0 text-xl">
                        Setting
                    </div>
                    <div class="p-8">
                        <form method="POST" action="{{ route('setting.update') }}">
                            @csrf

                            <!-- name -->
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Name</label>
                                <input value="{{ old('name', $user->name) }}" type="text" name="name" class="block w-full p-3 rounded bg-gray-200 border-transparent focus:outline-none hover:bg-gray-300 focus:bg-gray-300 @error('name') border-4 border-red-300 @enderror" required autocomplete="name" autofocus>
                            </div>

                            @error('name')
                            <p class="text-red-500 text-xs italic my-4">
                                {{ $message }}
                            </p>                                
                            @enderror

                            <!-- username -->
                            <div class="mb-5">
                                <label for="username" class="block mb-2 text-sm font-medium text-gray-600">Username</label>
                                <input value="{{ old('username', $user->username) }}" type="text" name="username" class="block w-full p-3 rounded bg-gray-200 border-transparent focus:outline-none hover:bg-gray-300 focus:bg-gray-300 @error('username') border-4 border-red-300 @enderror" required autocomplete="username" autofocus>
                                <a href="{{ route('profile', [$user->username]) }}" class="text-xs underline">{{ route('profile', [$user->username]) }}</a>
                            </div>

                            @error('username')
                            <p class="text-red-500 text-xs italic my-4">
                                {{ $message }}
                            </p>                                
                            @enderror

                            <!-- email -->
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Email</label>
                                <input value="{{ old('email', $user->email) }}" type="text" name="email" class="block w-full p-3 rounded bg-gray-200 border-transparent focus:outline-none hover:bg-gray-300 focus:bg-gray-300 @error('email') border-4 border-red-300 @enderror" required autocomplete="email" autofocus>
                            </div>

                            @error('email')
                            <p class="text-red-500 text-xs italic my-4">
                                {{ $message }}
                            </p>                                
                            @enderror
    
                            <button class="block text-center w-full p-3 mt-4 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop