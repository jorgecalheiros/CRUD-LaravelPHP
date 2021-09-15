@extends('templates/login-cadastro')

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
            <h1 class="title">Mini gerenciador de conteudos</h1>
            <h2 class="title-form">Já tem uma conta ? </h2>
            <p class="description">Caso já tenha uma conta então fassa o seu login <br>
            clicando no botão abaixo</p>
            <br>
            <a href="{{ route('auth.login') }}" class="btn-a">
                Login
            </a>
        </div>
        <form action="{{ $route }} " class="side-form" method="{{ $method }}">
            @csrf
            <x-form.input type="text" name="name" icon="fa-user" placeholder="Insira o seu nome" />

            <x-form.input type="email" name="email" icon="fa-envelope-open-text" placeholder="Digite seu email" />

            <x-form.input type="password" name="password" icon="fa-key" placeholder="Digite a sua senha" />

            <label for="" class="label-input">
                <i class="fas fa-key icons"></i></i><input type="password" name="reppassword" id="reppassword" autocomplete="off" placeholder="Repita a senha">
            </label>
            <button class="btn submit">
                Criar conta
            </button>
        </form>
    @else
        <form action="{{ $route }}" class="side-form v2" method="{{ $method }}">
            @csrf
            @if ($_method)
                @method($_method)
            @endif
            <x-form.input type="text" name="name" icon="fa-user" placeholder="Insira o seu nome" value="{{ $user->name }}"/>

            <x-form.input type="email" name="email" icon="fa-envelope-open-text" placeholder="Digite seu email" value="{{$user->email}}" />

            <x-form.input type="password" name="password" icon="fa-key" placeholder="Digite a sua senha" />
            <button class="btn submit">
                Editar conta
            </button>
        </form>
        <div class="side-login">
            <h1 class="title">Mini gerenciador de conteudos</h1>
            <h2 class="title-form">Editar conta</h2>
            <p class="description">Caso não queira editar informações da sua conta clique no botão abaixo</p>
            <br>
            <a href="{{ route('users.show', $user->id) }}" class="btn-a">
                Voltar
            </a>
        </div>
    @endif
 </div>
@endsection
