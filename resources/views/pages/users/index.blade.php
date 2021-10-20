@extends('layouts/admindefault')

@section('title', "Laravel")

@php
    $name  = auth()->user()->name;
    $photo = auth()->user()->photo;
    $id = auth()->user()->id;
    $photoPictureUrl = $photo ? url("/"). '/' . str_replace("public" , "storage" , $photo) : "https://semantic-ui.com/images/wireframe/image.png";
    $nameSearch = request()->get("name","");
@endphp

@section('content')

<div class="md:px-32 py-8 w-full">
    <form id="postSearchForm" action="{{ route('users.index', ['s' => $nameSearch]) }}" method="GET">
        <div class="flex mb-5">
            <x-form.input id="titleSearch" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" type="text" name="name" placeholder="Search" value="{{ $nameSearch }}" />
            <input id="btnSearch" class="bg-red-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-red-600 transition duration-200 each-in-out cursor-pointer" type="reset" value="Reset"/>
        </div>
    </form>
    <div class="shadow overflow-hidden rounded border-b border-gray-200">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">{{ __("misc.text.id") }}</th>
            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">{{ __("misc.text.name") }}</th>
            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __("misc.text.email") }}</th>
            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ __("misc.text.phone") }}</td>
          </tr>
        </thead>
      <tbody class="text-gray-700">
       @foreach ($users as $user)
        <tr>
            <td class="w-1/3 text-left py-3 px-4">{{ $user->id }}</td>
            <td class="w-1/3 text-left py-3 px-4">{{ $user->name }}</td>
            <td class="text-left py-3 px-4">{{ $user->email }}</td>
            <td class="text-left py-3 px-4">{{ $user->phone }}</td>
            <td class="text-left py-3 px-4"><a class="hover:text-blue-500 a-show-user--" href="{{ route('users.show', $user->id) }}">{{ __("misc.text.show") }}</a></td>
        </tr>
       @endforeach
      </tbody>
      </table>
    </div>
  </div>
  <div class="pagination--">
    {{ $users->appends(request()->except('page'))->links() }}
  </div>
@endsection
