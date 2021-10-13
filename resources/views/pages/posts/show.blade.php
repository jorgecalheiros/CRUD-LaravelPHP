@php
    $postPhoto = data_get($post ?? [], 'photo', '');
    $postPictureUrl = $postPhoto ? url('/') . '/' . str_replace('public', 'storage', $postPhoto) : "https://semantic-ui.com/images/wireframe/image.png";
@endphp

@extends('layouts/default')


@section('title', $post->title)
<x-system.message />
@section('content')
<div class="arrow-back-container--" id="back-to-page">
    <i class="fas fa-arrow-left"></i>
</div>
<article class="py-12 px-4 show-post--">
    <div class="mb-6">
        <label for="profile_picture" class="cursor-pointer">
        <img @if ($postPictureUrl) src="{{ $postPictureUrl }}" @endif alt="" class="img-post--" />
        </label>
    </div>
    <h1 class="text-4xl text-center mb-4 font-semibold font-heading font-semibold">{{ $post->title }}</h1>
    <p class="text-center">
      <span>{{ $post->created_at }}</span>
    </p>
    <div class="max-w-3xl mx-auto">
      <p class="mb-4">{!! $post->content !!}</p>
      <blockquote class="text-center mb-10">
        <footer class="text-gray-400">{{$post->user->name}}</footer>
      </blockquote>
    </div>
    <div>
        <div class="flex justify-center items-center">
            <div class="flex">
            <form action="{{ route('posts.edit', $post->id) }}" method="GET">
                <button id="update-post" class="bg-gray-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-gray-600 transition duration-200 each-in-out">{{ __("misc.button.edit")}}</button>
            </form>
            <button  class="bg-red-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-red-600 transition duration-200 each-in-out" id="btn-delete-post">{{ __("misc.button.delete")}}</button>
            </div>
        </div>
    </div>
  </article>
<div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover hidden--"  style="" id="modal-id">
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
    <!--content-->
    <div class="">
        <!--body-->
        <div class="text-center p-5 flex-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <h2 class="text-xl font-bold py-4 ">{{ __("misc.text.sure") }}</h3>
            <p class="text-sm text-gray-500 px-8">{{ __("misc.text.irreversible_action") }}</p>
        </div>
        <!--footer-->
        <div class="p-3  mt-2 text-center space-x-4 md:block">
            <div class="flex justify-center items-center">
                <div class="flex">
                <button class="bg-gray-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-gray-600 transition duration-200 each-in-out" id="btn-cancel">{{ __("misc.button.cancel")}}</button>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button  class="bg-red-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-red-600 transition duration-200 each-in-out" id="delete-with-sure">{{ __("misc.button.delete")}}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
