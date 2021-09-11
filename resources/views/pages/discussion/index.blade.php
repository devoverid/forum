@extends('layouts.app', [
    'title' => 'Discussion',
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <div class="container mx-auto">
        <div class="relative px-4 md:px-4 lg:px-0 py-8 flex flex-col-reverse space-y-6 justify-between lg:flex-row lg:space-x-6 lg:space-x-8 lg:space-x-12">
            {{-- panel filters --}}
            <div class="w-full lg:w-2/12 hidden lg:block">
                <x-discussion.left-sidebar />
            </div>
            {{-- discussion list --}}
            <div class="w-full lg:w-8/12">
                @foreach ($discussions as $discussion_index => $discussion)
                    @php
                        $stringCut = substr(strip_tags(markdown($discussion->content)), 0, 440);
                        $endPoint = strrpos($stringCut, ' ');
                        $description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    @endphp
                    <div
                        class="discussion-item flex group transition-all duration-200 space-x-2 rounded-sm shadow p-8 bg-gray-100 mb-6 relative overflow-hidden hover:shadow-xl"
                        data-id="{{ $discussion->id }}"
                    >
                        <div class="w-1/12 mt-2 flex flex-col space-y-2 text-center">
                            <div class="flex flex-row justify-center text-sm @auth cursor-pointer vote-up @endauth">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="@auth vote-count @endauth">
                                {{ @$discussions_reactions[$discussion_index]->vote }}
                            </div>
                            <div class="flex flex-row justify-center text-sm @auth cursor-pointer vote-down @endauth">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                        </div>
                        <div class="w-11/12">
                            <a href="{{ route('discussion.show', $discussion->slug) }}" class="block text-xl font-bold text-gray-800 mb-3">
                                {{ $discussion->title }}
                            </a>
                            <div class="text-xs text-gray-600 mb-4">
                                {{ $description }}...
                            </div>
                            <div class="border-t border-gray-300 mb-3"></div>
                            <div class="flex flex-col text-center lg:text-left lg:flex-row lg:space-x-4">
                                <div class="lg:w-7/12 flex justify-center space-x-1 lg:justify-start">
                                    <img style="max-height: 20px;" class="rounded-full border border-blue-300" src="{{ asset('avatar/' . $discussion->user->avatar) }}">
                                    <div class="truncate max-w-full self-center text-xs">
                                        <span class="text-gray-500">Posted by</span>
                                        <a href="#" class="text-blue-500">{{ $discussion->user->name }}</a>
                                    </div>
                                </div>
                                <div class="lg:w-3/12 text-xs text-gray-500">
                                    {{ $discussion->created_at->diffForHumans() }}
                                </div>
                                <div class="lg:w-2/12 flex space-x-2 justify-center lg:justify-end text-xs text-gray-500">
                                    <div>
                                        <i class="fas fa-eye"></i>
                                        {{ $discussion->view }}
                                    </div>
                                    <div>
                                        <i class="fas fa-comment-alt"></i>
                                        {{ $discussion->comments_count }}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="bg-red-500">
                                {{ json_encode($discussion) }}
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- right sidebar --}}
            <div class="w-full lg:w-2/12">
                <x-discussion.right-sidebar />
            </div>
        </div>
    </div>
@stop

@push('app.navbar.center')
    <div style="max-width: 400px;" class="w-full relative">
        <input
            type="text"
            name="search"
            id="search"
            placeholder="Search... Topics, Tags, User"
            class="w-full block pr-6 py-3 pl-11 text-sm rounded-lg transition-all duration-200 hover:bg-gray-300 bg-gray-200 text-gray-600"
        >
        <span class="absolute left-0 top-0.5 ml-2">
            <i class="fas fa-search m-3 text-sm text-gray-400"></i>
        </span>
    </div>
@endpush
