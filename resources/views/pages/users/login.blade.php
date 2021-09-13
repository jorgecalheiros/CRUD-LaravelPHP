@extends('templates/login-cadastro')

@section('title','Login')

@section('content-form')
    @if (Session::has("message"))
    <p>{!! Session::get("message") !!}</p>
    @endif
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
        <label for="" class="label-input">
            <i class="fas fa-envelope-open-text icons"></i><input type="email" name="email" id="email" placeholder="Digite seu email" autocomplete="off">
        </label>
        <label for="" class="label-input">
            <i class="fas fa-key icons"></i></i><input type="password" name="password" id="password" autocomplete="off"  placeholder="Digite a sua senha">
        </label>
        <button class="btn submit">
            Entrar
        </button>
       <div class="content-forgot-password">
        <a href="#" class="forgot-password">Esqueceu a senha?</a>
       </div>
    </form>
 </div>
@endsection
