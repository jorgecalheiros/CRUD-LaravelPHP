@extends('layouts/default')

@section('title', "Posts")
<x-system.message />

@php
    $name  = auth()->user()->name;
    $id = auth()->user()->id;
    $photo = auth()->user()->photo;
    $photoPictureUrl = $photo ? url("/"). '/' . str_replace("public" , "storage" , $photo) : "https://semantic-ui.com/images/wireframe/image.png";
@endphp

@section('header')
<nav class="px-6 py-4 bg-white shadow">
    <div class="container flex flex-col mx-auto md:flex-row md:items-center md:justify-between">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 w-64 flex justify-center items-center">
            <div @click="open = !open" class="relative border-b-4 border-transparent py-3" :class="{'border-indigo-700 transform transition duration-300 ': open}" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100">
              <div class="flex justify-center items-center space-x-3 cursor-pointer">
                <div class="w-12 h-12 rounded-full overflow-hidden border-2 dark:border-white border-gray-900">
                    <img @if ($photoPictureUrl) src="{{ $photoPictureUrl }}" @endif alt="" class="w-full h-full object-cover">
                </div>
                <div class="font-semibold dark:text-white text-gray-900 text-lg">
                  <div class="cursor-pointer" id="cursor_pointer">{{ auth()->user()->name; }}</div>
                </div>
              </div>
              <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5">
                <ul class="space-y-3 dark:text-white">
                  <li class="font-medium">
                    <a href="{{ route('users.show', $id ) }}" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                      <div class="mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                      </div>
                      {{ __("misc.button.account") }}
                    </a>
                  </li>
                  <li class="font-medium">
                    <a href="#" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                      <div class="mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                      </div>
                      {{ __("misc.button.setting") }}
                    </a>
                  </li>
                  <hr class="dark:border-gray-700">
                  <li class="font-medium">
                    <a href="#" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-600">
                      <div class="mr-3 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                      </div>
                       <form action="{{ route('auth.logout') }}" method="GET" class="form-logout">
                          <button id="logout">
                              {{ __("misc.button.logout") }}
                          </button>
                      </form>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <div>
                <button type="button" class="block text-gray-800 hover:text-gray-600 focus:text-gray-600 focus:outline-none md:hidden">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="flex-col hidden md:flex md:flex-row md:-mx-4">
            <a href="/" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">{{__("misc.text.home")}}</a>
            <a href="#" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">{{ __("misc.text.about") }}</a>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="overflow-x-hidden bg-gray-100">
    <div class="px-6 py-8">
        <div class="container flex justify-between mx-auto">
            <div class="w-full lg:w-8/12">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold text-gray-700 md:text-2xl">{{ __("misc.text.post") }}</h1>
                </div>
                @foreach ($posts as $post)
                @php
                    $postPhoto = data_get($post ?? [], 'photo', '');
                    $postPictureUrl = $postPhoto ? url('/') . '/' . str_replace('public', 'storage', $postPhoto) : "https://semantic-ui.com/images/wireframe/image.png";

                    $photo = $post->user->photo;
                    $photoPictureUrl = $photo ? url("/"). '/' . str_replace("public" , "storage" , $photo) : "https://semantic-ui.com/images/wireframe/image.png";
                @endphp
                <div class="mt-6">
                    <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                        <div class="">
                            <img  @if ($postPictureUrl) src="{{ $postPictureUrl }}" @endif alt="" class="img-post--">
                        </div>
                        <div class="mt-2"><a href="{{ route('posts.show', $post->id) }}" class="text-2xl font-bold text-gray-700 hover:underline">{{ $post->title }}</a>
                            <p class="mt-2 text-gray-600">{!! $post->content !!}</p>
                        </div>
                        <div class="flex items-center justify-between mt-4"><a href="#"
                                class="text-blue-500 hover:underline">{{ __("misc.text.readMore") }}</a>
                            <div><a href="{{route('users.show', $post->user->id)  }}" class="flex items-center"><img
                                    @if ($photoPictureUrl) src="{{ $photoPictureUrl }}" @endif
                                        alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                                    <h1 class="font-bold text-gray-700 hover:underline">{{ $post->user->name }}</h1>
                                </a></div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="pagination--">
                    {{ $posts->links() }}
                </div>
            </div>
            <div class="hidden w-4/12 -mx-8 lg:block">
                <div class="px-8 mt-10">
                    <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
                    <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
                        <ul>
                            <li><a href="#" class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                    AWS</a></li>
                            <li class="mt-2"><a href="#"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                    Laravel</a></li>
                            <li class="mt-2"><a href="#"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">- Vue</a>
                            </li>
                            <li class="mt-2"><a href="#"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                    Design</a></li>
                            <li class="flex items-center mt-2"><a href="#"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                    Django</a></li>
                            <li class="flex items-center mt-2"><a href="#"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">- PHP</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="px-8 mt-10">
                    <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
                        <a href="{{ route('posts.create') }}" class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">+
                            {{ __("misc.button.create_post") }}</a>
                    </div>
                </div>
                <!--<div class="px-8 mt-10">
                    <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h1>
                    <div class="flex flex-col max-w-sm px-8 py-6 mx-auto bg-white rounded-lg shadow-md">
                        <div class="flex items-center justify-center"><a href="#"
                                class="px-2 py-1 text-sm text-green-100 bg-gray-600 rounded hover:bg-gray-500">Laravel</a>
                        </div>
                        <div class="mt-4"><a href="#" class="text-lg font-medium text-gray-700 hover:underline">Build
                                Your New Idea with Laravel Freamwork.</a></div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center"><img
                                    src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                    alt="avatar" class="object-cover w-8 h-8 rounded-full"><a href="#"
                                    class="mx-3 text-sm text-gray-700 hover:underline">Alex John</a></div><span
                                class="text-sm font-light text-gray-600">Jun 1, 2020</span>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection
