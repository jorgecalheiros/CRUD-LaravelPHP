@extends('templates/login-cadastro')

@section('title','Login')

@section('content-form')
    @if (Session::has("message"))
    <p>{!! Session::get("message") !!}</p>
    @endif
    <x-system.message />
 <div class="container-form">
    <div class="side-login">
        <h1 class="title">Mini gerenciador de conteudos</h1>
        <h2 class="title-form">Logins recentes</h2>
        <p class="description">Fassa login em uma de suas contas</p>
        <div class="card">
            <figure class="picture-user">

            </figure>
            <p class="name-user">Fulano</p>
        </div>
        <div class="card">
            <figure class="picture-user">

            </figure>
            <p class="name-user">Fulano</p>
        </div>
        <br>
        <br>
        <h2 class="title-form">Não tem conta?</h2>
        <p class="description">Caso não tenha uma conta clique no botão abaixo para se cadastrar</p>
        <br>
        <a href="{{ route('auth.create') }}" class="btn-a">
            Criar conta
        </a>
    </div>
    <form action="{{ route('auth.auth') }}" class="side-form" method="POST">
        @csrf
        <x-form.input  type="email" name="email" icon="fa-envelope-open-text" placeholder="Digite seu email"/>
        <x-form.input  type="password" name="password" icon="fa-key" placeholder="Digite a sua senha"/>

        <button class="btn submit">
            Entrar
        </button>
       <div class="content-forgot-password">
        <a href="#" class="forgot-password">Esqueceu a senha?</a>
       </div>
    </form>
 </div>
@endsection
