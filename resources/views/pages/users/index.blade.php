@extends('layouts/default')

@section('title', "Laravel")

@php
    $name  = auth()->user()->name;
    $photo = auth()->user()->photo;
    $id = auth()->user()->id;
    $photoPictureUrl = $photo ? url("/"). '/' . str_replace("public" , "storage" , $photo) : "https://semantic-ui.com/images/wireframe/image.png";
@endphp

@section('header')
@include('partials.common.header');
@endsection

@section('content')

<div class="md:px-32 py-8 w-full">
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
    {{ $users->links() }}
  </div>
@endsection
