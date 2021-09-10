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
<div class="container-form">
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (!$onlyEdit)
        <div class="side-login">
            <h1 class="title">Mini gerenciador de conteudos</h1>
            <h2 class="title-form">Já tem uma conta ? </h2>
            <p class="description">Caso já tenha uma conta então fassa o seu login <br>
            clicando no botão abaixo</p>
            <br>
            <a href="{{ route('users.login') }}" class="btn-a">
                Login
            </a>
        </div>
        <form action="{{ $route }} " class="side-form" method="{{ $method }}">
            @csrf
            <label for="" class="label-input">
                <i class="fas fa-user icons"></i></i><input type="text" name="name" id="nome" placeholder="Digite o nome do seu usuário" autocomplete="off">
            </label>
            <label for="" class="label-input">
                <i class="fas fa-envelope-open-text icons"></i><input type="email" name="email" id="email" placeholder="Digite seu email" autocomplete="off">
            </label>
            <label for="" class="label-input">
                <i class="fas fa-key icons"></i></i><input type="password" name="password" id="password" autocomplete="off" placeholder="Digite a sua senha">
            </label>
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
            <label for="" class="label-input">
                <i class="fas fa-user icons"></i></i><input type="text" name="name" id="nome" placeholder="Digite o nome do seu usuário" autocomplete="off" value="{{ $user->name }}">
            </label>
            <label for="" class="label-input">
                <i class="fas fa-envelope-open-text icons"></i><input type="email" name="email" id="email" placeholder="Digite seu email" autocomplete="off" value="{{ $user->email }}">
            </label>
            <label for="" class="label-input">
                <i class="fas fa-key icons"></i></i><input type="password" name="password" id="password" autocomplete="off" placeholder="Confirme a sua senha" autocomplete="off">
            </label>
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
