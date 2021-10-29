@extends('layouts/login-cadastro')

@php
    $onlyEdit = data_get($config,"onlyEdit");
    $title = data_get($config,"title");
    $method = data_get($config, "method");
    $_method = data_get($config,"_method");
    $route = data_get($config,"route");
    $postTitle = $post->title ?? "";
    $postContent = $post->content ?? "";

    $postPhoto = data_get($post ?? [], 'photo', '');
    $postPictureUrl = $postPhoto ? url('/') . '/' . str_replace('public', 'storage', $postPhoto) : "https://semantic-ui.com/images/wireframe/image.png";
@endphp
@section('title')
    @if (!$onlyEdit)
        {{ __("post.text.title.create") }}
    @else
        {{ __("post.text.title.edit") }}
    @endif
@endsection
@section('content-form')
<x-system.message />
 <div class="heading text-center font-bold text-2xl m-5 text-gray-800">
     @if (!$onlyEdit)
        {{ __("post.text.title.create") }}
     @else
        {{ __("post.text.title.edit") }}
     @endif
 </div>
<style>
  body {background:white !important;}
</style>
  <form action="{{ $route }}" method="{{ $method }}" id="postSaveForm" enctype="multipart/form-data">
    @csrf
    @if ($_method)
        @method($_method)
    @endif
    <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
        <div class="mb-6">
            <label for="profile_picture" class="cursor-pointer">
            <img @if ($postPictureUrl) src="{{ $postPictureUrl }}" @endif alt="" class="img-post--" id="img-preview" />
            </label>
            <x-form.input type="file" name="post_picture" id="profile_picture" class="hidden" id="profile_picture" />
        </div>

        <x-form.input type="text" name="title" icon="none"  placeholder="{{ __('post.placeholder.title') }}" value="{{ $postTitle }}" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"/>

        <div id="quillEditor" class="height">
            {!! $postContent !!}
        </div>
        <x-form.textarea name="content"/>

        <!-- icons -->
        <div class="icons flex text-gray-500 m-2">
          <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
          <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
        </div>
        <!-- buttons -->
        <div class="buttons flex">
          <div id="btn_cancel_post" class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">{{ __("misc.button.cancel") }}</div>
          <div class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500" id="savePost">{{ $title }}</div>
        </div>
      </div>
  </form>
    <script type="text/javascript">
        document.getElementById('savePost').addEventListener('click', function() {
            var postContent = document.querySelector("#quillEditor div").innerHTML;
            document.getElementById('content').value = postContent;
            document.getElementById('postSaveForm').submit();
        });

        document.getElementById("btn_cancel_post").addEventListener("click", function(){
            window.history.back();
        })
    </script>
@endsection
