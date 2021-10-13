@extends('layouts/default')

@php
    $postPhoto = data_get($user ?? [], 'photo', '');
    $photoPictureUrl = $postPhoto ? url('/') . '/' . str_replace('public', 'storage', $postPhoto) : "https://semantic-ui.com/images/wireframe/image.png";

    $id = auth()->user()->id;
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
@section('title', $user->name)
<x-system.message />

@section('content')
<div class="show-user--">
    <div class="md:grid grid-cols-4 grid-rows-2  bg-white gap-2 p-4 rounded-xl">
         <div class="md:col-span-1 h-48 shadow-xl ">
                 <div class="flex w-full h-full relative">
                     <img @if ($photoPictureUrl) src="{{ $photoPictureUrl }}" @endif class="w-44 h-44 m-auto" alt="">
                 </div>
         </div>
         <div class="md:col-span-3 h-48 shadow-xl p-4 space-y-2 p-3">
                 <div class="flex ">
                     <span
                         class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">{{ __("misc.text.name") }}</span>
                     <input
                         class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                         type="text" value="{{ $user->name }}"  readonly/>
                 </div>
                 <div class="flex ">
                     <span
                         class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">{{ __("misc.text.email") }}</span>
                     <input
                         class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                         type="text" value="{{ $user->email }}"  readonly/>
                 </div>
                  <div class="flex ">
                     <span
                         class="text-sm border bg-blue-50 font-bold uppercase border-2 rounded-l px-4 py-2 bg-gray-50 whitespace-no-wrap w-2/6">{{ __("misc.text.phone") }}</span>
                     <input
                         class="px-4 border-l-0 cursor-default border-gray-300 focus:outline-none  rounded-md rounded-l-none shadow-sm -ml-1 w-4/6"
                         type="text" value="{{ $user->phone }}"  readonly/>
                 </div>
         </div>
         <div class="md:col-span-3 h-48 shadow-xl p-4 space-y-2 hidden md:block">
             <h3 class="font-bold uppercase">{!! __("user.text.title-profile") !!}</h3>
             <p class="">
                {{ $user->description }}
             </p>
         </div>
         <div style="width: 100%; display:flex;height: fit-content; align-items: center;justify-content: center; ">
            <form action="{{ route('users.edit', $user->id) }}" method="GET">
                <button class="bg-gray-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-gray-600 transition duration-200 each-in-out">{{ __("misc.button.edit")}}</button>
            </form>
            <button  class="bg-red-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-red-600 transition duration-200 each-in-out" id="btn-delete-user">{{ __("misc.button.delete")}}</button>
         </div>
     </div>
 </div>
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

                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button  class="bg-red-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-red-600 transition duration-200 each-in-out">{{ __("misc.button.delete")}}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
