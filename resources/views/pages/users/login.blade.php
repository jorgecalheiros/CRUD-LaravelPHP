@extends('layouts/login-cadastro')

@section('title','Login')

@section('content-form')
    <x-system.message />
 <div class="container-form">
    <div class="side-login">
        <h1 class="title">{{ __("misc.text.application_title") }}</h1>
        <h2 class="title-form">{{ __("user.text.dont_have_account") }}</h2>
        <p class="description">{{ __("user.text.do_account") }}</p>
        <br>
        <a href="{{ route('auth.create') }}" class="btn-a">
            {{ __("user.text.create_account") }}
        </a>
    </div>
    <form action="{{ route('auth.auth') }}" class="side-form" method="POST">
        @csrf
        <x-form.input  type="email" name="email" icon="fa-envelope-open-text" placeholder="{{ __('misc.placeholder.email') }}"/>
        <x-form.input  type="password" name="password" icon="fa-key" placeholder="{{ __('misc.placeholder.password') }}"/>

        <button class="btn submit">
            {{ __("misc.button.login") }}
        </button>
       <div class="content-forgot-password">
        <a href="#" class="forgot-password"> {{ __("passwords.forgot-your-password") }} </a>
       </div>
    </form>
 </div>
@endsection
