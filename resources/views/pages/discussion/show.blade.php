@extends('layouts.app', [
    'title' => $discussion->title,
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <div class="container mx-auto">
        <div class="relative px-4 py-8 flex flex-col-reverse space-y-6 justify-between lg:flex-row lg:space-x-6 lg:space-x-8 lg:space-x-12">
            {{-- panel filters --}}
            <div class="w-full lg:w-2/12 hidden lg:block">
                <x-discussion.left-sidebar />
            </div>
            {{-- main page --}}
            <div class="w-full lg:w-7/12">
                {{-- discussion --}}
                <div class="px-8 py-8 rounded bg-gray-100">
                    <!-- top -->
                    <div class="discussion-header flex space-x-4 items-center text-xs mb-5">
                        <div class="text-left phone:flex phone:items-center md:items-start">
                            <div class="block relative" style="margin-bottom: 3px;">
                                <img style="max-height: 50px;" class="rounded-full" src="{{ asset('avatar/' . $discussion->user->avatar) }}">
                            </div>
                        </div>
                        <div class="flex-1 relative text-xs">
                            <a href="{{ route('profile', [$discussion->user->username]) }}" class="block uppercase font-bold text-blue-400 hover:text-blue-500 hover:underline mr-2">
                                {{ $discussion->user->name }}
                            </a>
                            <div class="block">
                                Posted
                                <span class="font-bold text-gray-500"> {{ $discussion->created_at->diffForHumans() }} </span>
                            </div>
                            @if (auth()->check() && auth()->user()->id == $discussion->user_id)
                                <div class="block">
                                    <a href="{{ route('discussion.edit', [$discussion->slug]) }}" class="font-bold text-gray-500 hover:underline hover:text-gray-600 mr-2">Edit</a>
                                    <form action="{{ route('discussion.destroy', [$discussion->slug]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="font-bold text-gray-500 hover:underline hover:text-gray-600 mr-2">
                                            Delete
                                        </button>
                                    </form>
                                    @if($discussion->solved_at == null)
                                    <a href="{{ route('discussion.edit', [$discussion->slug]) . '?set_solved' }}" class="font-bold text-gray-500 hover:underline hover:text-gray-600 mr-2">Set Solved</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- main -->
                    <div class="discussion-main mb-2">
                        <div class="discussion-title mb-5">
                            <div class="text-gray-700 leading-10 mb-2" style="font-size: 1.8rem;">
                                <div class="inline-block break-words" style="min-width: 100px;">
                                    <h1 class="inline break-words"> {{ $discussion->title }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="discussion-content lg:flex">
                            <div class="content-md hidden">{{ $discussion->content }}</div>
                            <div class="lg:flex-1 text-gray-600 md-wrapper">
                                @markdown($discussion->content)
                            </div>
                        </div>
                    </div>
                </div>

                <!-- comments -->
                <div class="px-6 py-6 mt-4 rounded bg-gray-100">
                    @if (count($discussion->comments) == 0)
                        <div class="block bg-red-300 p-3 text-center text-white mt-4 mx-0">
                            No reply found.
                        </div>
                    @endif
                    @foreach ($discussion->comments as $comment)
                        @php $isBestAnswer = ($comment->id == $discussion->best_answer) ? true : false; @endphp
                        <div class="user-comment is-reply px-2 py-2 mb-2 flex hover:bg-gray-200 mx-0 {{ ($isBestAnswer) ? 'bg-cool-gray-100' : '' }}">
                            <div class="md:mr-5 text-left flex items-center md:items-start">
                                <a href="{{ route('profile', [$comment->user->avatar]) }}" class="block relative" style="margin-bottom: 3px;">
                                    <img style="max-height: 50px;" class="rounded-full" src="{{ asset('avatar/' . $comment->user->avatar) }}">
                                </a>
                            </div>
                            <div class="flex-1 relative">
                                <div class="phone:hidden flex justify-between">
                                    <div class="flex items-center w-full leading-none text-left text-xs">
                                        <a href="" class="block uppercase font-bold text-blue-400 hover:text-blue-500 hover:underline mr-2">
                                            {{ $comment->user->name  }}
                                        </a>
                                        <span class="text-grey-dark pr-2">•</span>
                                        <span class="inline pt-1 md:pt-0 text-xs text-grey-dark mr-3 link">
                                            <strong class="text-grey-dark">
                                                {{ $comment->created_at->diffForHumans()  }}
                                            </strong>
                                        </span>
                                        <!-- tag best answer -->
                                        @if ($comment->id == $discussion->best_answer)
                                            <span class="p-2 text-xs bg-green-400 text-white rounded">
                                                Best Answer
                                            </span>
                                        @endif
                                    </div>

                                    <!-- user comment menu -->
                                    @if (auth()->check())
                                        <div class="user-comment-menu text-xs flex">
                                            <!-- delete -->
                                            @if (auth()->user()->id == $comment->user->id)
                                                <div class="item">
                                                    <form action="{{ route('comment.delete', [$comment->id]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="font-bold text-gray-500 hover:underline hover:text-gray-600 mr-2">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                            <!-- set best answer -->
                                            @if (auth()->user()->id == $discussion->user->id && $comment->id != $discussion->best_answer)
                                                <div class="item">
                                                    <form action="{{ route('discussion.best_answer', [$discussion->slug, $comment->id]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="font-bold text-gray-500 hover:underline hover:text-gray-600 mr-2">
                                                            Set Best Answer
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="md-wrapper text-gray-700">@markdown($comment->text)</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- reply -->
                <div>
                    @if ($discussion->solved_at == null)
                        @auth
                            <div class="mt-4 bg-white shadow-xl rounded mx-0">
                                <form action="{{ route('comment', [ 'discussion', $discussion->slug ]) }}" method="POST">
                                    @csrf
                                    <div class="flex p-2 pl-4 text-gray-600 font-bold bg-gray-100 border-b border-2ray-400 content-center items-center justify-center">
                                        <div class="w-full">Reply a discussion...</div>
                                    </div>
                                    <div id="reply-wrapper" class="flex h-full">
                                        <textarea name="content" id="" cols="30" rows="10" class="w-full px-4 py-3 text-gray-100 bg-gray-600" placeholder="Reply..."></textarea>
                                    </div>
                                    <div class="block text-right p-2 text-sm border-t border-gray-300 bg-gray-100">
                                        <button type="submit" class="text-center p-2 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600">
                                            <i class="fa fa-paper-plane"></i>
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div id="to-reply" class="block bg-red-300 p-2 text-center text-white mt-4 lg:mx-10 mx-0">
                                You must login to reply this discussion.
                            </div>
                        @endauth
                    @else
                        <div id="to-reply" class="block bg-indigo-300 p-2 text-center text-white mt-4 lg:mx-10 mx-0">
                            You cannt reply this discussion because authoer set discussion to solved.
                        </div>
                    @endif
                </div>
            </div>
            {{-- right sidebar --}}
            <div class="w-full lg:w-2/12">
                <div class="sticky" data-sticky-offset="97">
                    <div class="block text-right w-auto" style="padding-top: -1.2rem;">
                        @if(auth()->check() && auth()->user()->id == $discussion->user_id)
                            <div class="block mb-2">
                                <a href="{{ route('discussion.edit', [$discussion->slug]) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-sm block w-full items-center mr-2 text-center">
                                    Edit
                                </a>
                                <form action="{{ route('discussion.destroy', [$discussion->slug]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-sm block w-full items-center mr-2">
                                        Delete
                                    </button>
                                </form>
                                @if($discussion->solved_at == null)
                                    <a href="{{ route('discussion.edit', [$discussion->slug]) . '?set_solved' }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-sm block w-full items-center mr-2 text-center">
                                        Set Solved
                                    </a>
                                @endif
                                @if ($discussion->best_answer != null)
                                    <form action="{{ route('discussion.best_answer.delete', [$discussion->slug]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-sm block w-full items-center mr-2">
                                            Clear Best Answer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                        <button id="btn-to-reply" onclick="$('html, body').animate({ scrollTop: $('#to-reply').offset().top }, 1000);" class="btn btn-blue rounded w-full block">
                            Reply
                        </button>
                    </div>
                    <div class="flex mt-4 md:mb-0">
                        <div class="relative m-2">
                            <div class="border-r-2 border-blue-500 absolute h-full top-0" style="left: 5px"></div>
                            <ul class="list-none m-0 p-0">
                                <li class="mb-3">
                                    <div class="flex items-center">
                                        <div class="bg-blue-500 rounded-full -ml-2 h-6 w-6"></div>
                                        <div class="flex-1 ml-2 text-xs font-semibold">{{ $discussion->created_at }}</div>
                                    </div>
                                    <div class="ml-6 text-xs text-gray-400">
                                        Create discussion
                                    </div>
                                </li>
                                @if (count($discussion->comments) > 0)
                                    <li class="mb-2">
                                        <div class="flex items-center mb-1">
                                            <div class="bg-blue-500 rounded-full -ml-2 h-6 w-6"></div>
                                            <div class="flex-1 ml-2 text-xs font-semibold">{{ $discussion->comments[0]->created_at }}</div>
                                        </div>
                                        <div class="ml-6 text-xs text-gray-400">
                                            Newest Reply
                                        </div>
                                        <div class="ml-6 text-gray-400 text-xs">
                                            by {{ $discussion->comments[count($discussion->comments)-1]->user->name }}
                                        </div>
                                    </li>
                                @endif
                                @if ($discussion->solved_at != null)
                                    <li class="mb-2">
                                        <div class="flex items-center mb-1">
                                            <div class="bg-blue-500 rounded-full -ml-2 h-6 w-6"></div>
                                            <div class="flex-1 ml-2 text-xs font-semibold">{{ $discussion->solved_at }}</div>
                                        </div>
                                        <div class="ml-6 text-xs text-gray-400">
                                            Author set this discussion solved.
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
