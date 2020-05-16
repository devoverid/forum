@extends('layouts.app', [
    'title' => 'Discussion',
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <div class="section py-10" style="min-height: 80vh;">
        <div class="disscussion-wrapper">
            <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1400px;">
                <!-- Menu -->
                <x-sidebar-discussion />

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
                                        <input value="{{ request()->get('q', '') }}" name="q" placeholder="What you looking for?" class="ml-4 px-5 py-3 text-sm w-full h-full bg-gray-200 hover:bg-gray-300 rounded-full" />
                                    </div>
                                </form>
                            </div>

                            <!-- list -->                      
                            <div class="post-list">
                                @if (count($discussions) == 0)
                                <div class="block bg-red-300 p-3 text-center text-white mx-4">
                                    No Discussion Found.
                                </div>                                    
                                @endif
                                @foreach ($discussions as $discussion)
                                    @php
                                        $stringCut = substr(strip_tags(markdown($discussion->content)), 0, 220);
                                        $endPoint = strrpos($stringCut, ' ');
                                        $description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    @endphp
                                    <a href="{{ route('discussion.show', $discussion->slug) }}">
                                        <div class="flex flex-col md:flex-row items-center cursor-pointer rounded-lg hover:bg-gray-100 px-6 py-4">
                                            <div class="avatar w-full md:w-auto md:mr-6 flex items-center md:block mb-4 md:mb-0">
                                                <a href="" class="block mr-3 md:mr-0">
                                                    <img style="max-height: 50px;" class="rounded-full" src="{{ asset('avatar/' . $discussion->user->avatar) }}">
                                                </a>
                                                
                                                <div class="flex items-center justify-center md:hidden ml-auto mr-3 md:mr-4 bg-grey-panel rounded-xl py-2">
                                                    <div class="flex items-center justify-center mr-4">
                                                        <div class="mr-2"><i class="fa fa-comments"></i></div>
                                                        <span class="text-xs text-grey-dark font-semibold text-left leading-none relative">1</span>
                                                    </div>
                                                    <div class="flex items-center justify-center">
                                                        <div class="mr-2"><i class="fa fa-eye"></i></div>
                                                        <span class="text-xs text-grey-dark font-semibold text-left leading-none">{{ $discussion->view }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full md:pr-10 lg:pr-0 lg:w-5/6 md:mb-0">
                                                <h4 class="mb-3 md:mb-1 text-base">
                                                    <a href="{{ route('discussion.show', $discussion->slug) }}" class="font-bold transition-all tracking-tight text-gray-600 hover:text-gray-800 hover:underline link">
                                                        {{ $discussion->title }}
                                                    </a>
                                                </h4>
                                                <div class="break-words  text-base md:text-sm mb-3 widescreen:pr-10 text-grey-darker phone:leading-loose" style="word-break: break-word;">
                                                    {{ $description }}
                                                    <span class="is-muted">...</span>
                                                </div>
                                                <div class="text-xs mb-2 text-white">
                                                    @foreach ($discussion->tags as $tag)
                                                        <a href="{{ route('discussion.index') . '?tag=' . $tag->name }}" class="bg-red-400 rounded-lg px-2 py-1">{{ $tag->name }}</a>
                                                    @endforeach
                                                </div>
                                                <div class="text-grey-dark text-xs">
                                                    <a href="{{ route('profile', [$discussion->user->username]) }}" class="uppercase font-bold text-blue-400 hover:text-blue-500 hover:underline">
                                                        {{ $discussion->user->name }} 
                                                    </a> Posted
                                                    <span>
                                                        <span class="font-bold text-gray-500"> {{ $discussion->created_at->diffForHumans() }} </span>
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
                                                    <span class="text-xs text-grey-dark font-semibold text-left leading-none">{{ $discussion->view }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <!-- paginate -->
                            <div class="mt-4">
                                {{ $discussions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
@stop