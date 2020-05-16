@extends('layouts.app', [
    'title' => 'Discussion',
        'footer' => true,
        'navbar' => true,
])

@section('content')
    <div class="flex w-full bg-cool-gray-200">
        <div class="block w-full px-6 lg:w-6/12 mx-auto mt-4 mb-10 justify-center" style="min-height: 80vh;">
 
            <!-- profile -->
            <div class="w-full mt-4 bg-white shadow-lg rounded p-8 text-center relative">
                
                @if (auth()->check() && auth()->user()->username == $user->username)
                <div class="absolute">
                    <a href="#" class="bg-indigo-500 p-2 px-4 text-white hover:bg-indigo-600">
                        <i class="fa fa-edit"></i> Change Profile
                    </a>
                </div>                    
                @endif

                <div class="avatar block mb-4">
                    <img class="inline-block rounded-full" src="{{ asset('avatar/' . $user->avatar) }}" alt="Avatar" width="70" height="70">
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
                <div class="font-bold text-lg text-gray-500">User Activity</div>
                    @if (count($activities) == 0)
                        <div class="text-center">
                            No Activity
                        </div>
                    @else
                        <div class="relative w-full m-8">
                            <div class="border-r-2 border-indigo-500 absolute h-full top-0" style="left: 15px"></div>
                            <ul class="list-none m-0 p-0">
                                @foreach ($activities as $activity)
                                    @php
                                        $title = '';
                                        $subtitle = '';
                                        $time = '';

                                        if ($activity instanceOf \App\Models\Discussion) {
                                            $title = 'Create Discussion';
                                            $subtitle = $activity->title;
                                            $link = route('discussion.show', $activity->slug);
                                            $time = $activity->created_at;
                                        }
                                    @endphp
                                    <li class="mb-2">
                                        <div class="flex items-center mb-1">
                                            <div class="bg-indigo-500 rounded-full h-8 w-8"></div>
                                            <div class="flex-1 ml-4 font-medium">{{ $time }} - {{ $title }}</div>
                                        </div>
                                        <div class="ml-12 text-sm text-gray-400">
                                            @isset($link)
                                                <a href="{{ $link }}">{{ $subtitle }}</a>
                                            @else
                                                {{ $subtitle }}
                                            @endisset
                                        </div>
                                    </li>                            
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </div>

        </div>
    </div>
@stop