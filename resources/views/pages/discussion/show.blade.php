@extends('layouts.app', [
    'title' => $discussion->title,
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
                <div class="forum-main lg:ml-10 lg:flex text-xs mb-5">
                    <a href="{{ route('profile', [$discussion->user->username]) }}" class="uppercase font-bold text-blue-400 hover:text-blue-500 hover:underline mr-2">
                        {{ $discussion->user->name }} 
                    </a> Posted
                    <span class="ml-2">
                        <span class="font-bold text-gray-500"> {{ $discussion->created_at->diffForHumans() }} </span>
                    </span>
                </div>
                <div class="mx-1 lg:mx-10 mb-5">
                    <div class="text-gray-600 leading-10 mb-2" style="font-size: 2rem;">
                        # <h1 class="inline-block">{{ $discussion->title }}</h1>
                    </div>
                </div>
                <div class="block h-2 border-t-2 border-gray-200 lg:mx-10 mb-10 mx-1"></div>
                <div class="forum-main lg:ml-10 lg:flex">
                    <div class="content-md hidden">{{ $discussion->content }}</div>
                    <div class="lg:flex-1" id="wrapper">
                        Loading...
                    </div>
                </div>
                <div class="block h-2 border-t-2 border-gray-200 lg:mx-10 mt-10 mx-1"></div>
            </div>
            


            <!-- activity -->
            <div class="sticky md:ml-9 mobile:bg-white hidden xl:block" style="top: 0px;">
                <div class="forum-secondary-sidebar lg:sticky vue-portal-target">
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
        mounted() {
            let md = marked($('.content-md').html(), { 
                gfm: true,
                tables: true,
                breaks: false,
                pedantic: false,
                sanitize: true,
                smartLists: true,
            });
            $('#wrapper').html(md)
        }
    });
</script>
@endpush