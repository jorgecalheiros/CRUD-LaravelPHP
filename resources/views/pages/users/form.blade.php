@extends('layouts/login-cadastro')

@php
    $onlyEdit = data_get($config,"onlyEdit");
    $title = data_get($config,"title");
    $method = data_get($config, "method");
    $_method = data_get($config,"_method");
    $route = data_get($config,"route");
@endphp

@section('title',$title)

@section('content-form')
<x-system.message />
<div class="container-form">
    @if (!$onlyEdit)
        <div class="side-login">
            <h1 class="title">{{  __("misc.text.application_title") }}</h1>
            <h2 class="title-form">{{ __("user.text.have_account") }} </h2>
            <p class="description">{{ __("user.text.screen_form_description") }}</p>
            <br>
            <a href="{{ route('auth.login') }}" class="btn-a">
                {{ __("misc.button.login") }}
            </a>
        </div>
    @else
    <div class="side-login">
        <h1 class="title">{{ __("misc.text.application_title") }}</h1>
        <h2 class="title-form">{{ __("user.text.title.edit") }}</h2>
        <p class="description">{{ __("user.text.screen_form_description_back") }}</p>
        <br>
        <a href="{{ route('users.show', $user->id) }}" class="btn-a">
            {{ __("misc.button.back") }}
        </a>
    </div>
    @endif

        <form action="{{ $route }}" class="side-form" method="{{ $method }}">
            @csrf
            @if ($_method)
                @method($_method)
            @endif
            @if (!isset($user))
                <x-form.input type="text" name="name" icon="fa-user" placeholder="{{ __('misc.placeholder.name') }}"/>
                <x-form.input type="email" name="email" icon="fa-envelope-open-text" placeholder="{{ __('misc.placeholder.email') }}"  />
                <x-form.input type="password" name="password" icon="fa-key" placeholder="{{ __('misc.placeholder.password') }}" />
            @else
                <x-form.input type="text" name="name" icon="fa-user"  placeholder="{{ __('misc.placeholder.name') }}" value="{{ $user->name }}"/>
                <x-form.input type="email" name="email" icon="fa-envelope-open-text" placeholder="{{ __('misc.placeholder.email') }}" value="{{$user->email}}" />
                <x-form.input type="password" name="password" icon="fa-key" placeholder="{{ __('misc.placeholder.password') }}"  />
            @endif

            @if (!$onlyEdit)
            <label for="" class="label-input">
                <i class="fas fa-key icons"></i></i><input type="password" name="reppassword" id="reppassword" autocomplete="off" placeholder="{{ __('misc.placeholder.password_confirm') }}">
            </label>
            @endif

            <button class="btn submit">
                {{ $title }}
            </button>
        </form>
 </div>
@endsection
