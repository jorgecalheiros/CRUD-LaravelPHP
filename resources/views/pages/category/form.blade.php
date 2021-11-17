@extends('layouts/admindefault')

@php
    $onlyEdit = data_get($config,"onlyEdit");
    $title = data_get($config,"title");
    $method = data_get($config, "method");
    $_method = data_get($config,"_method");
    $route = data_get($config,"route");

@endphp

@section('title', $title)

@section('content')
<div class="flex items-center justify-center" style="margin-top: 100px">
    <div class="w-full max-w-md">
      <form  action="{{ $route }}" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4" method="{{ $method }}">
        @csrf

        @if ($_method)
            @method($_method)
        @endif

        <div
          class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4"
        >
          {{ __("category.text.title.create") }}
        </div>
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-normal mb-2"
            for="username"
          >
            {{ $title }}
          </label>
          <x-form.input type="text" name="title" icon="none"  placeholder="{{ __('category.placeholder.title') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
        </div>
        <div class="flex items-center justify-between">
          <button class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit">{{ __('category.text.title.create') }}</button>
        </div>
      </form>
    </div>
  </div>
@endsection
