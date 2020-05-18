@extends('layouts.app', [
    'title' => 'Edit Discussion',
    'footer' => true,
    'navbar' => true,
])

@section('content')
<form action="{{ route('discussion.update', [$discussion->slug]) }}" method="POST">
    @csrf
    @method('put')
    <div class="flex w-full">
        <div class="block w-full px-6 lg:w-9/12 mx-auto mt-4 mb-10 justify-center" style="min-height: 80vh;">
            
            <!-- aw -->
            <div>
                <a href="{{ url()->previous() }}" class="inline-block text-center p-3 mt-4 bg-red-500 text-white rounded shadow hover:bg-red-600" style="min-width: 100px;">
                    <i class="fa fa-chevron-left"></i>
                    Cancel
                </a>
                <button type="submit" class="inline-block text-center p-3 mt-4 bg-indigo-500 text-white rounded shadow hover:bg-indigo-600" style="min-width: 100px;">
                    <i class="fa fa-save"></i>
                    Update
                </button>
            </div>

            <!-- alert -->
            @if ($errors->any())
            <div class="bg-red-300 p-4 mt-4 text-white">
                <b>Error,</b> {{ $errors->first() }}
            </div>                
            @endif
            
            
            <!-- title -->
            <div class="w-full mt-4 bg-white shadow-xl rounded">
                <div class="p-2 pl-4 text-gray-600 font-bold bg-gray-100 border-b border-gray-200">
                    Give title a discussion...
                </div>
                <input value="{{ old('title', $discussion->title) }}" type="title" name="title" class="block w-full p-3 bg-gray-200 border-transparent focus:outline-none hover:bg-gray-300 focus:bg-gray-300" required placeholder="Title...">
            </div>
            
            <!-- tag -->
            <div class="w-full mt-4 bg-white shadow-xl rounded">
                <div class="p-2 pl-4 text-gray-600 font-bold bg-gray-100 border-b border-gray-200">
                    Give a tag to order your discussion...
                </div>
                <select name="tags[]" class="select2" multiple="multiple" style="width: 100%;" placeholder="Tag">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>                    
                    @endforeach
                </select>
            </div>
    
            <!-- editor -->
            <div class="w-full mt-4 bg-white shadow-xl rounded">
                <div class="flex p-2 pl-4 text-gray-600 font-bold bg-gray-100 border-b border-2ray-400 content-center items-center justify-center">
                    <div class="w-6/12">Type Your Question...</div>
                    <div class="w-6/12 text-right">
                        <button @click.prevent="preview" class="bg-indigo-500 p-2 text-xs text-white">Show / Hide Preview</button>
                    </div>
                </div>
                <div id="wrapper" class="flex h-full" style="min-height: 50vh;">
                    <textarea name="content" class="flex-1 h-full" :class="{'w-12/12': showPreview}" :value="input" @input="update"></textarea>
                    <textarea id="content-old" class="hidden">{{ old('content',  $discussion->content) }}</textarea>
                    <div v-show="showPreview" class="flex-1 h-full md-wrapper" v-html="compiledMarkdown" style="padding: 1.3rem;"></div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection { 
        border-radius: 0!important;
        padding: .2rem;
        background: rgba(229, 231, 235, 1)!important;
    }
    .select2-selection:hover { 
        background-color: rgba(210, 214, 220, 1);
    }
    html, body, #wrapper {
        margin: 0;
        height: 100%;
        font-family: "Helvetica Neue", Arial, sans-serif;
        color: #333;
        max-height: 
    }
    #wrapper div {
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
    #wrapper textarea { min-height: 70vh; }
        h1, h2, h3, h4, h5, h6 {
        font-weight: 700;
        line-height: 1.7;
        cursor: text;
        position: relative;
        margin: 1em 0 15px;
        padding: 0;
    }
</style>
@include('assets.markdown-css')
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
            input: "### Hello, this my code \n\n```\nconsole.log('hello world')\n```",
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
            if ($('#content-old').html() != '' && $('#content-old').html() != 'null') this.input = $('#content-old').html()
            $('.select2').select2();
            $('.select2').val(@JSON(old('tags', $discussion->tags->pluck('id')  ))).trigger('change')
        }
    });
</script>
@endpush