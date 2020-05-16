@extends('layouts.app', [
    'title' => 'Discussion',
        'footer' => true,
        'navbar' => true,
])

@section('content')
    <div class="flex w-full bg-cool-gray-200">
        <div class="block w-full px-6 lg:w-6/12 mx-auto mt-4 mb-10 justify-center" style="min-height: 80vh;">
 
            <!-- profile -->
            <div class="w-full mt-4 bg-white shadow-lg rounded p-8 text-center">
                <div class="avatar block mb-4">
                    <img class="inline-block rounded-full" src="//www.gravatar.com/avatar/b1a867b5382f8a6cb08fb9d72693bf41?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Favatar-23.png" alt="Avatar" width="70" height="70">
                </div>
                <div class="mt-4 font-bold">{{ $user->name }}</div>
                <div class="mb-4 text-xs">{{ '@' . $user->username }}</div>
                <div>                    
                    <span class="p-2 text-white bg-red-300 rounded break-words">
                        {{ $user->email }}
                    </span>
                </div>
            </div>
            
            <!-- activity -->
            <div class="w-full mt-4 bg-white shadow-lg rounded p-8 text-left">
                <div class="font-bold text-lg text-gray-500">My Activity</div>
                <div class="relative w-1/2 m-8">
                    <div class="border-r-2 border-indigo-500 absolute h-full top-0" style="left: 15px"></div>
                    <ul class="list-none m-0 p-0">
                        <li class="mb-2">
                            <div class="flex items-center mb-1">
                                <div class="bg-indigo-500 rounded-full h-8 w-8"></div>
                                <div class="flex-1 ml-4 font-medium">Oct 2017 - First Release</div>
                            </div>
                            <div class="ml-12 text-sm text-gray-400">
                                First release of Tailwind CSS
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center mb-1">
                                <div class="bg-indigo-500 rounded-full h-8 w-8"></div>
                                <div class="flex-1 ml-4 font-medium">Nov 2017 - Multiple Releases</div>
                            </div>
                            <div class="ml-12 text-sm text-gray-400">
                                v0.1.0 - v0.2.2
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@stop