@extends('layouts.app', [
    'title' => $discussion->title,
    'footer' => true,
    'navbar' => true,
])

@section('content')
<div class="section py-10 min-h-full">
    <div class="disscussion-wrapper">
        <div class="flex flex-col-reverse md:flex-row mx-auto" style="max-width: 1400px;">
            <!-- sidebar:left -->
            <div>
                <x-discussion.left-sidebar />
            </div>


            <!-- Content -->
            <div class="flex-1">
                <!-- top -->
                <div class="forum-main lg:mx-10 flex text-xs mb-5">
                    <div class="md:mr-5 text-left phone:flex phone:items-center md:items-start">
                        <a href="" class="block relative" style="margin-bottom: 3px;">
                            <img style="max-height: 50px;" class="rounded-full" src="{{ asset('avatar/' . $discussion->user->avatar) }}">
                        </a>
                    </div>
                    <div class="flex-1 relative text-xs ml-2">
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
                <div>
                    <div class="mx-1 lg:mx-10 mb-5">
                        <div class="text-gray-600 leading-10 mb-2" style="font-size: 1.8rem;">
                            <div class="inline-block break-words" style="min-width: 100px;">
                                # <h1 class="inline break-words"> {{ $discussion->title }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="block border-t-2 border-gray-200 mb-10"></div>
                    <div class="forum-main lg:mx-10 lg:px-4 lg:flex hover:bg-gray-100 rounded">
                        <div class="content-md hidden">{{ $discussion->content }}</div>
                        <div class="lg:flex-1 md-wrapper">
                            @markdown($discussion->content)
                        </div>
                    </div>
                    <div class="mx-10 mt-8 font-bold text-xl"># Reply</div>
                    <div class="block border-t-2 border-gray-200 mb-4"></div>
                </div>


                <!-- comments -->
                <div>
                    @if (count($discussion->comments) == 0)
                        <div class="block bg-red-300 p-3 text-center text-white mt-4 lg:mx-10 mx-0">
                            No reply found.
                        </div>
                    @endif
                    @foreach ($discussion->comments as $comment)
                        @php $isBestAnswer = ($comment->id == $discussion->best_answer) ? true : false; @endphp
                        <div class="user-comment md:mb-2 is-reply md:flex md:px-6 md:-ml-4 pt-4 pb-7 md:py-4 hover:bg-gray-200 lg:mx-10 mx-0 {{ ($isBestAnswer) ? 'bg-cool-gray-100' : '' }}">
                            <div class="md:mr-5 text-left phone:flex phone:items-center md:items-start">
                                <a href="{{ route('profile', [$comment->user->avatar]) }}" class="block relative" style="margin-bottom: 3px;">
                                    <img style="max-height: 50px;" class="rounded-full" src="{{ asset('avatar/' . $comment->user->avatar) }}">
                                </a>
                            </div>
                            <div class="flex-1 relative">
                                <div class="phone:hidden flex mb-3 justify-between">
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

                                <div class="md-wrapper">@markdown($comment->text)</div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- reply -->
                <div>
                    @if ($discussion->solved_at == null)
                        @auth
                            <div id="to-reply" class="block bg-indigo-300 p-3 text-center text-white mt-4 mx-0 lg:mx-10">
                                We make reply form with Markdown, you can see markdown
                                <a class="underline hover:text-blue-400" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">
                                    Markdown Cheatshett
                                </a>
                                for how to write markdown.
                            </div>
                            <div class="mt-4 bg-white shadow-xl rounded mx-0 lg:mx-10">
                                <form action="{{ route('comment', [ 'discussion', $discussion->slug ]) }}" method="POST">
                                    @csrf
                                    <div class="flex p-2 pl-4 text-gray-600 font-bold bg-gray-100 border-b border-2ray-400 content-center items-center justify-center">
                                        <div class="w-6/12">Reply a discussion...</div>
                                        <div class="w-6/12 text-right">
                                            <button @click.prevent="preview" class="bg-indigo-500 p-2 text-xs text-white">Show / Hide Preview</button>
                                        </div>
                                    </div>
                                    <div id="reply-wrapper" class="flex h-full" style="min-height: 50vh;">
                                        <textarea name="content" class="flex-1 h-full" :class="{'w-12/12': showPreview}" :value="input" @input="update"></textarea>
                                        <textarea id="content-old" class="hidden">{{ old('content', 'null') }}</textarea>
                                        <div v-show="showPreview" class="flex-1 h-full md-wrapper" v-html="compiledMarkdown" style="padding: 1.3rem;"></div>
                                    </div>
                                    <div class="block text-right px-4 text-sm border-t border-gray-300 bg-gray-100">
                                        <button type="submit" class="text-center p-3 mt-4 mb-4 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600">
                                            <i class="fa fa-paper-plane"></i>
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div id="to-reply" class="block bg-red-300 p-3 text-center text-white mt-4 lg:mx-10 mx-0">
                                You must login to reply this discussion.
                            </div>
                        @endauth
                    @else
                        <div id="to-reply" class="block bg-indigo-300 p-3 text-center text-white mt-4 lg:mx-10 mx-0">
                            You cannt reply this discussion because authoer set discussion to solved.
                        </div>
                    @endif
                </div>

            </div>


            <!-- sidebar:right -->
            <div class="mobile:bg-white xl:block forum-sidebar hidden lg:block flex-none border-l border-solid border-gray-100" style="border-color: rgb(239, 239, 239);">
                <div class="forum-secondary-sidebar sticky" data-sticky-offset="100">
                    <div class="block text-right w-auto ml-10" style="padding-top: -1.2rem;">

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
                    <div class="flex md:h-full mb-8 md:mb-0">

                        <div class="relative m-8">
                            <div class="border-r-2 border-indigo-500 absolute h-full top-0" style="left: 15px"></div>
                            <ul class="list-none m-0 p-0">
                                <li class="mb-2">
                                    <div class="flex items-center mb-1">
                                        <div class="bg-indigo-500 rounded-full h-8 w-8"></div>
                                        <div class="flex-1 ml-4 font-medium">{{ $discussion->created_at }}</div>
                                    </div>
                                    <div class="ml-12 text-sm text-gray-400">
                                        Create discussion
                                    </div>
                                </li>
                                @if (count($discussion->comments) > 0)
                                    <li class="mb-2">
                                        <div class="flex items-center mb-1">
                                            <div class="bg-indigo-500 rounded-full h-8 w-8"></div>
                                            <div class="flex-1 ml-4 font-medium">{{ $discussion->comments[0]->created_at }}</div>
                                        </div>
                                        <div class="ml-12 text-sm text-gray-400">
                                            Newest Reply
                                        </div>
                                        <div class="ml-12 text-sm text-gray-400 text-xs">
                                            by {{ $discussion->comments[count($discussion->comments)-1]->user->name }}
                                        </div>
                                    </li>
                                @endif
                                @if ($discussion->solved_at != null)
                                    <li class="mb-2">
                                        <div class="flex items-center mb-1">
                                            <div class="bg-indigo-500 rounded-full h-8 w-8"></div>
                                            <div class="flex-1 ml-4 font-medium">{{ $discussion->solved_at }}</div>
                                        </div>
                                        <div class="ml-12 text-sm text-gray-400">
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
</div>
@stop

@push('css')
@include('assets.markdown-css')
<style>
    html, body, #reply-wrapper {
        margin: 0;
        height: 100%;
        font-family: "Helvetica Neue", Arial, sans-serif;
        color: #333;
        max-height:
    }
    #reply-wrapper div {
        overflow-y: scroll;
        height: 70vh;
    }
    textarea {
        border: none;
        border-right: 1px solid #ccc;
        resize: none;
        outline: none;
        background-color: #f6f6f6;
        font-size: 14px;
        font-family: "Monaco", courier, monospace;
        padding: 20px;
    }
    code {
        color: #f66;
    }
    #reply-wrapper textarea { min-height: 70vh; }
    h1, h2, h3, h4, h5, h6 {
        font-weight: 700;
        line-height: 1.7;
        cursor: text;
        position: relative;
        margin: 1em 0 15px;
        padding: 0;
    }
    .user-comment .user-comment-menu { visibility: hidden; }
    .user-comment:hover .user-comment-menu { visibility:visible!important; }
</style>
@endpush


@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/marked@0.3.6"></script>
<script src="https://unpkg.com/lodash@4.16.0"></script>
<script>
    new Vue({
        el: "#app",
        data: {
            input: "My code like this broh.. \n\n```\nconsole.log('hello' + 'world')\n```",
            showPreview: true,
        },
        computed: {
            compiledMarkdown: function() {
                return marked(this.input, {
                    gfm: true,
                    tables: true,
                    breaks: false,
                    pedantic: false,
                    sanitize: true,
                    smartLists: true,
                });
            }
        },
        methods: {
            update: _.debounce(function(e) { this.input = e.target.value; }, 300),
            preview: function () { this.showPreview = !this.showPreview }
        },
        mounted() {
            // reply old content
            if ($('#content-old').html() != '' && $('#content-old').html() != 'null') this.input = $('#content-old').html()
        }
    });
</script>
@endpush
