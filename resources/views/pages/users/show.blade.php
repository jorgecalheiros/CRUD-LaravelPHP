@extends('layouts/default')


@section('title', "Laravel")
<x-system.message />
@section('content')
<div class="body-false" id="false">.</div>
    <div class="container-max-user">
        <div class="container-user">
            <div class="side-right">
                <h1 class="title">{{ __("user.text.welcome") }} {{ $user->name }} !</h1>
                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
            </div>
            <figure class="picture-user">

            </figure>
        </div>
        <div class="info-person">
            <div class="container-button">
                <h2 class="title">{{ __("user.text.personal_information") }}</h2>
                <button class="btn-icons btn-icons-primary" id="btn-show-user">
                    <i class="fas fa-eye-slash"></i>
                </button>
                <div class="nav-bar">
                    <nav class="nav">
                        <ul>
                            <a href="{{ route('users.edit',$user->id) }}">
                                <li class="item edit">
                                    <p class="description">EDITAR CONTA</p>
                                </li>
                            </a>

                            <li class="item excluir" id="excluir">
                                <p class="description">DELETAR CONTA</p>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="container-info hidden" id="info">
                <div class="item">
                    Nome: {{ $user->name }}
                </div>
                <hr>
                <div class="item">
                    Email: {{ $user->email }}
                </div>
            </div>
        </div>
        <div class="container-confirm" id="confirm">
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <hr>
            <h3 class="title-form">Tem certeza ? </h3>
            <p class="description">Após fazer isso você não podera mais recuperar seus dados novamente</p>
            <div class="btn-confirm">
                <button class="btn btn-cacelar" id="cacelar">
                    Cancelar
                </button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="form-delete">
                    @csrf
                    @method("DELETE")

                    <button class="btn btn-excluir">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
        <form action="{{ route('auth.logout') }}" method="GET" class="form-logout">
            <button class="btn btn-logout">
                Logout
            </button>
        </form>
    </div>
@endsection
