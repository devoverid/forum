@extends('layouts.app', [
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <section class="hero">
        <div class="container mx-auto h-full">
            <div class="flex h-full justify-center items-center flex-col text-center">
                <div>
                    <img src="{{ asset('assets/images/logo_white.svg') }}" class="h-24 mx-auto mb-8">
                    <h5 class='text-4xl text-white'>INDONESIA'S IT GEN-Z COMMUNITY</h5>
                    <p class='text-white font-light opacity-75'>A place where the youth are being enthusiastic in Information and Technology.</p>
                    <div class="form-inline flex mt-4">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="latest-thread py-24">
        <div class="container mx-auto">
            <div class="section-header text-4xl mb-5">
                <h3 class='mb-2'>Latest Thread</h3>
                <div class="divider"></div>
            </div>
            <div class="section-body">
                <div class="flex">
                    <div class="row w-full md:w-2/3 mb-20">
                        <div class="discussions">
                            @foreach($discussions as $discussion) 
                            <a href="{{ route('discussion.show', $discussion->slug) }}" role="link">
                                        <div onClick="articelRedirect('{{ route('discussion.show', $discussion->slug) }}')" class="flex flex-col md:flex-row items-center cursor-pointer rounded-lg hover:bg-gray-100 px-6 py-4">
                                            <div class="avatar w-full md:w-auto md:mr-6 flex items-center md:block mb-4 md:mb-0">
                                                <a href="" class="block mr-3 md:mr-0">
                                                    <img style="max-height: 50px;" class="rounded-full" src="{{ asset('avatar/' . $discussion->user->avatar) }}">
                                                </a>
                                                
                                                <div class="flex items-center justify-center md:hidden ml-auto mr-3 md:mr-4 bg-grey-panel rounded-xl py-2">
                                                    <div class="flex items-center justify-center mr-4">
                                                        <div class="mr-2"><i class="fa fa-comments"></i></div>
                                                        <span class="text-xs text-grey-dark font-semibold text-left leading-none relative">{{ $discussion->comments()->count() }}</span>
                                                    </div>
                                                    <div class="flex items-center justify-center">
                                                        <div class="mr-2"><i class="fa fa-eye"></i></div>
                                                        <span class="text-xs text-grey-dark font-semibold text-left leading-none">{{ $discussion->view }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full md:pr-10 lg:pr-0 lg:w-5/6 md:mb-0">
                                                <h4 class="mb-3 md:mb-1 text-base">
                                                    <a href="{{ route('discussion.show', $discussion->slug) }}" class="font-bold transition-all tracking-tight text-gray-600 hover:text-gray-800 link">
                                                        {{ $discussion->title }}
                                                    </a>
                                                </h4>
                                                <div class="break-words  text-base md:text-sm mb-3 widescreen:pr-10 text-grey-darker phone:leading-loose" style="word-break: break-word;">
                                                    {{ substr(strip_tags($discussion->content),0,100) }}
                                                    <span class="is-muted">...</span>
                                                </div>
                                                <div class="text-xs mb-2 text-white">
                                                    @foreach ($discussion->tags as $tag)
                                                        <a href="{{ route('discussion.index') . '?tag=' . urlencode($tag->name) }}" class="bg-red-400 rounded-lg px-2 py-1">{{ $tag->name }}</a>
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
                                                    <span class="text-xs text-grey-dark font-semibold text-left leading-none relative">{{ $discussion->comments()->count() }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('css')
    <style>
       
    </style>
@endpush

@push('js')
    <script>
        $(document).on('scroll', () => {
            let sticky = $('nav')
            if ($(document).scrollTop() >= $('nav').height()) {
                if (sticky.length == 0) return 
                if( $(document).scrollTop() >= sticky.offset().top ) {
                    sticky.toggleClass("sticky-nav")
                }
            } else {
                sticky.css({ position: 'relative', top: 0, 'box-shadow': 'none' })  
            }
        })
    </script>
@endpush