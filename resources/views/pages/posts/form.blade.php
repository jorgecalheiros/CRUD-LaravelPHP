@extends('layouts/login-cadastro')

@php
    $onlyEdit = data_get($config,"onlyEdit");
    $title = data_get($config,"title");
    $method = data_get($config, "method");
    $_method = data_get($config,"_method");
    $route = data_get($config,"route");
    $userName = $user->name ?? '';;
    $userEmail = $user->email ?? '';;
@endphp


@section('content-form')
<x-system.message />
<div class="container-form">
    @if (!$onlyEdit)
        <div class="side-post">
           {{ __("post.text.create_account") }}
        </div>
    @else
    <div class="side-post">
        {{ __("post.text.edit_account") }}
    </div>
    @endif
        <form action="{{ $route }}" class="side-form" method="{{ $method }}">
            @csrf
            @if ($_method)
                @method($_method)
            @endif
                <input type="text" name="title" placeholder="">
                <textarea name="content" id="" cols="30" rows="10"></textarea>
            <button class="btn submit">
                {{ $title }}
            </button>
        </form>
 </div>
@endsection
