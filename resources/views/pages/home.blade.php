@extends('layouts.app', [
    'footer' => true,
    'navbar' => true,
])

@section('content')
    <section class="hero">
        <img src="{{ asset('assets/images/hero/layer1.svg') }}" data-direction="x" class="layer layer-1" data-speed="2">
        <img src="{{ asset('assets/images/hero/layer2.svg') }}" data-direction="x" class="layer layer-2" data-speed="5">
        <svg data-direction="both" class="layer" data-speed="2" style="top:5%;right: 10%;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="12" fill="#7C91E9"/>
        </svg>
        <svg data-direction="both" class="layer" data-speed="-5" style="top:10%;left: 80%;" width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="32.5" cy="32.5" r="32.5" fill="#708BFF"/>
        </svg>
        <svg data-direction="both" class="layer" data-speed="6" width="41" height="41" style="top:15%;left: 90%;" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M40.9405 -0.000617027L30.1133 40.1338L0.769462 10.69L40.9405 -0.000617027Z" fill="#637FF7"/>
        </svg>
        <svg class="layer" data-direction="both" data-speed="1" width="418" height="275" viewBox="0 0 418 275" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="280.754" y="34" width="172" height="172" transform="rotate(37.1008 280.754 34)" fill="#5D7BF8"/>
            <rect x="195.754" y="18" width="172" height="172" transform="rotate(37.1008 195.754 18)" fill="#6481FB"/>
            <rect x="103.754" width="172" height="172" transform="rotate(37.1008 103.754 0)" fill="#6F8AFF"/>
        </svg>
        <div class="content text-center">
            <img src="{{ asset('assets/images/logo_white.svg') }}" class="h-20 mx-auto mb-8">
            <h5 class='text-4xl text-white'>INDONESIA'S IT GEN-Z COMMUNITY</h5>
            <p class='text-white font-light opacity-75'>A place where the youth are being enthusiastic in
                Information and Technology.</p>
            <div class="form-inline flex mt-4">
            </div>
        </div>
    </section>
@stop
