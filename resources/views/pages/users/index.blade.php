@extends('layouts/default')

@section('title', "Laravel")

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
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">


<section class="py-1" style="background-color: white">
<div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-base text-blueGray-700">{{ __("misc.text.User") }}</h3>
        </div>
      </div>
    </div>

    <div class="block w-full overflow-x-auto">
      <table class="items-center bg-transparent w-full border-collapse ">
        <thead>
          <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          {{ __("misc.text.name") }}
                        </th>
          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        {{ __("misc.text.email") }}
                        </th>
           <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                          {{ __("misc.text.phone") }}
                        </th>
          </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                  {{ $user->name }}
                </th>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                    {{ $user->email }}
                </td>
                <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    (12) 4002-8922
                </td>
              </tr>
            @endforeach
        </tbody>

      </table>
    </div>
  </div>
</div>
<footer class="relative pt-8 pb-6 mt-16">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-6/12 px-4 mx-auto text-center">

      </div>
    </div>
  </div>
</footer>
{{ $users->links() }}
</section>
@endsection
