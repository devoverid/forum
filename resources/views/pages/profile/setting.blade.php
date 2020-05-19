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
                        <form method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- avatar -->
                            <div class="mb-5">
                                <label>Avatar</label>
                                <div class="hover:bg-gray-100 p-4">
                                    <div class="relative inline-block rounded-full" style="width: auto; height: auto;">
                                        <img id="img-preview" class="inline-block" src="{{ asset('avatar/' . $user->avatar) }}" class="rounded-full" style="max-height: 128px;max-width: 128px;height:128px;width:128px;">
                                        <button id="btn-change-image" type="button" class="absolute bottom-0 right-0 inline-block text-center p-3 mt-4 bg-blue-500 text-white rounded shadow hover:bg-blue-600 text-xs">
                                            Change
                                        </button>
                                    </div>
                                    <div class="text-xs text-gray-500">* use image wit 1:1 ration, ex : 460x460</div>
                                    <input type="file" class="hidden" name="avatar" id="image-file">
                                </div>
                            </div>

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


@push('js')
    <script>
        $('#btn-change-image').on('click', () => {  $('#image-file').trigger('click'); });
        $('#image-file').on('change', (e) => {
            let input = e.target;
            let path = $(e.target).val();
            var ext = path.substring(path.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();
                reader.onload = function (res) { $('#img-preview').attr('src', res.target.result); };
                reader.readAsDataURL(input.files[0]);
            }
        })
    </script> 
@endpush