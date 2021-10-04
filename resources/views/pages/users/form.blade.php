@extends('layouts/login-cadastro')

@php
    $onlyEdit = data_get($config,"onlyEdit");
    $title = data_get($config,"title");
    $method = data_get($config, "method");
    $_method = data_get($config,"_method");
    $route = data_get($config,"route");
    $userName = $user->name ?? '';;
    $userEmail = $user->email ?? '';;
    $placeholder= $onlyEdit? __('misc.placeholder.password_edit_confirmation') :__('misc.placeholder.password');
    $description = $onlyEdit? __('user.text.Description_update'): __("user.text.Description_signup");
    $redirect = $onlyEdit ? "auth.login" : "users.index";
    $paragraf = $onlyEdit ? __("user.text.back_to_pag") : __("user.text.have_account");
    $back = $onlyEdit ? __("user.text.back") : __("user.text.Login")
@endphp

@section('title',$title)

@section('content-form')
<x-system.message />
<div class="arrow-back-container--" id="back-to-page">
    <i class="fas fa-arrow-left"></i>
</div>
 <div class="flex justify-center min-h-screen bg-gray-100">
    <div class="container sm:mt-40 mt-24 my-auto max-w-md border-2 border-gray-200 p-3 bg-white">
      <!-- header -->
      <div class="text-center my-6">
        <h1 class="text-3xl font-semibold text-gray-700">{{ $title }}</h1>
        <p class="text-gray-500">{{ $description }}</p>
      </div>
      <!-- sign-in -->
      <div class="m-6">
        <form class="mb-4" action="{{ $route }}"  method="{{ $method }}">
        @csrf
        @if ($_method)
            @method($_method)
        @endif
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">{{ __("misc.label.name") }}</label>
            <x-form.input  type="name" name="name" placeholder="{{ __('misc.placeholder.name') }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" value="{{ $userName }}"/>
        </div>
          <div class="mb-6">
            <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">{{ __("misc.label.email") }}</label>
            <x-form.input  type="email" name="email" placeholder="{{ __('misc.placeholder.email') }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" value="{{ $userEmail }}"/>
          </div>
          <div class="mb-6">
            <div class="flex justify-between mb-2">
              <label for="password" class="text-sm text-gray-600 dark:text-gray-400">{{ __("misc.label.password") }}</label>
            </div>
            <x-form.input  type="password" name="password" placeholder="{{ $placeholder }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"/>
          </div>
          @if (!$onlyEdit)
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">{{ __("misc.label.password_confirm") }}</label>
                <x-form.input type="password" name="password_confirmation" placeholder="{{ __('misc.placeholder.password_confirm') }}" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"/>
            </div>
            @else
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">{{ __("user.text.title-profile") }}</label>
                <textarea name="description" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">{{ $user->description }}</textarea>
            </div>
            @endif
          <div class="mb-6">
            <button  class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none duration-100 ease-in-out">{{ $title }}</button>
          </div>
          <p class="text-sm text-center text-gray-400">
            {{ $paragraf }}
            <a href="{{ route($redirect) }}" class="font-semibold text-indigo-500 focus:text-indigo-600 focus:outline-none focus:underline">
                {{ $back }}
            </a>.
          </p>
        </form>
       @if (!$onlyEdit)
        <!-- seperator -->
        <div class="flex flex-row justify-center mb-8">
            <span class="absolute bg-white px-4 text-gray-500">{{ __("user.text.sign-up-with") }}</span>
            <div class="w-full bg-gray-200 mt-3 h-px"></div>
        </div>
        <!-- alternate sign-in -->
       <div class="flex flex-row gap-2">
        <button class="bg-green-500 text-white w-full p-2 flex flex-row justify-center gap-2 items-center rounded-sm hover:bg-green-600 duration-100 ease-in-out">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="w-5" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12c6.627 0 12-5.373 12-12S18.627 0 12 0zm.14 19.018c-3.868 0-7-3.14-7-7.018c0-3.878 3.132-7.018 7-7.018c1.89 0 3.47.697 4.682 1.829l-1.974 1.978v-.004c-.735-.702-1.667-1.062-2.708-1.062c-2.31 0-4.187 1.956-4.187 4.273c0 2.315 1.877 4.277 4.187 4.277c2.096 0 3.522-1.202 3.816-2.852H12.14v-2.737h6.585c.088.47.135.96.135 1.474c0 4.01-2.677 6.86-6.72 6.86z" fill="currentColor"/></g></svg>
          Google
        </button>
        <button class="bg-gray-700 text-white w-full p-2 flex flex-row justify-center gap-2 items-center rounded-sm hover:bg-gray-800 duration-100 ease-in-out">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="w-5" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385c.6.105.825-.255.825-.57c0-.285-.015-1.23-.015-2.235c-3.015.555-3.795-.735-4.035-1.41c-.135-.345-.72-1.41-1.23-1.695c-.42-.225-1.02-.78-.015-.795c.945-.015 1.62.87 1.845 1.23c1.08 1.815 2.805 1.305 3.495.99c.105-.78.42-1.305.765-1.605c-2.67-.3-5.46-1.335-5.46-5.925c0-1.305.465-2.385 1.23-3.225c-.12-.3-.54-1.53.12-3.18c0 0 1.005-.315 3.3 1.23c.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23c.66 1.65.24 2.88.12 3.18c.765.84 1.23 1.905 1.23 3.225c0 4.605-2.805 5.625-5.475 5.925c.435.375.81 1.095.81 2.22c0 1.605-.015 2.895-.015 3.3c0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z" fill="currentColor"/></g></svg>
          Github
        </button>
      </div>
       @endif
      </div>
    </div>
  </div>
@endsection
