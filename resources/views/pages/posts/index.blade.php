@extends('layouts/default')

@section('title', "Posts")
<x-system.message />
@section('header')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<div class=" bg-gray-200 flex justify-center items-center">
  <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 w-64 flex justify-center items-center">
      <div @click="open = !open" class="relative border-b-4 border-transparent py-3" :class="{'border-indigo-700 transform transition duration-300 ': open}" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100">
        <div class="flex justify-center items-center space-x-3 cursor-pointer">
          <div class="w-12 h-12 rounded-full overflow-hidden border-2 dark:border-white border-gray-900">
            <img src="https://images.unsplash.com/photo-1610397095767-84a5b4736cbd?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" alt="" class="w-full h-full object-cover">
          </div>
          <div class="font-semibold dark:text-white text-gray-900 text-lg">
            <div class="cursor-pointer">Fulaninho</div>
          </div>
        </div>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5">
          <ul class="space-y-3 dark:text-white">
            <li class="font-medium">
              <a href="#" class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
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
                    <button>
                        {{ __("misc.button.logout") }}
                    </button>
                </form>
              </a>
            </li>
          </ul>
        </div>
      </div>
  </div>
</div>
@endsection
@section('content')
<br>
  <form action="{{ route('posts.create') }}" method="GET" class="form-create-post">
    <button id="btn_create_post" class="p-2 pl-5 pr-5 bg-blue-500 text-gray-100 text-lg rounded-lg focus:border-4 border-blue-300">{{ __("misc.button.create_post") }}</button>
    </form>
    <div class="arrow-back-container--" id="back-to-page">
        <i class="fas fa-arrow-left"></i>
    </div>
    <div class="">
@foreach ($posts as $post)
<section class="text-blueGray-700 bg-white mt-20">
    <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row lg:px-28">
        <div class="flex flex-col items-start mb-16 text-left lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:mb-0">
            <h2 class="mb-8 text-xs font-semibold tracking-widest text-black uppercase title-font">  {{ $post->user->name}}</h2>
            <h1 class="mb-8 text-2xl font-black tracking-tighter text-black md:text-5xl title-font"> {{ $post->title }} </h1>
            <p class="mb-8 text-base leading-relaxed text-left text-blueGray-600 "> {!! $post->content !!} </p>
            <div class="flex flex-col justify-center lg:flex-row">
                <form action="{{ route('posts.show', $post->id) }}" method="GET">
                    <button class="btn-show-post flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-lg hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2"> {{ __("post.text.title.show") }} </button>
                </form>
            </div>
        </div>
        <div class="w-full lg:w-1/3 lg:max-w-lg md:w-1/2">
            <img class="object-cover object-center rounded-lg " alt="hero" src="https://dummyimage.com/720x600/F3F4F7/8693ac">
        </div>
    </div>
</section>
<!-- This is an example component -->
    <!--<div class='flex max-w-xl my-10 bg-white shadow-md rounded-lg overflow-hidden mx-auto'>
        <div class='flex items-center w-full'>
            <div class='w-full'>
                <div class="flex flex-row mt-2 px-2 py-3 mx-3">
                    <div class="w-auto h-auto rounded-full border-2 border-pink-500">
                        <img class='w-12 h-12 object-cover rounded-full shadow cursor-pointer' alt='User avatar' src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
                    </div>
                    <div class="flex flex-col mb-2 ml-4 mt-1">
                        <div class='text-gray-600 text-sm font-semibold'>Sara Lauren</div>
                        <div class='flex w-full mt-1'>
                            <div class='text-blue-700 font-base text-xs mr-1 cursor-pointer'>
                                UX Design
                            </div>
                            <div class='text-gray-400 font-thin text-xs'>
                                • 30 seconds ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b border-gray-100"></div>
                <div class='text-gray-400 font-medium text-sm mb-7 mt-6 mx-3 px-2'><img class="rounded" src="https://picsum.photos/536/354"></div>
                <div class='text-gray-600 font-semibold text-lg mb-2 mx-3 px-2'>Dummy text of the printing and typesetting industry</div>
                <div class='text-gray-500 font-thin text-sm mb-6 mx-3 px-2'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500</div>
            </div>
        </div>
    </div>-->
@endforeach
</div>
    {{ $posts->links() }}
@endsection
