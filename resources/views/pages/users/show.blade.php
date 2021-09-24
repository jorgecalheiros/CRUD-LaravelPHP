@extends('layouts/default')


@section('title', "Laravel")
<x-system.message />
@section('content')
<div class="body-false" id="false">.</div>
    <div class="container-show shadow-md rounded-xl">
        <div class="header-welcome">
            <h1 class="title">{{ __("user.text.welcome") }} {{ $user->name }} !</h1>
            <p class="description">{{ __("user.text.screen_show_description") }}</p>
        </div>
        <div class="information-user">
            <div class="picture">
                <figure class="picture-user">

                </figure>
                <form action="#" method="POST" class="form-logout edit-photo">
                    <button>
                        {{ __("misc.button.edit-photo") }}
                    </button>
                </form>
            </div>
            <br>
            <hr>
            <br>
            <table>
                <tr>
                    <th> {{ __("misc.text.name") }}</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>{{ __("misc.text.email") }}</th>
                    <td>{{ $user->email }}</td>
                </tr>
            </table>
            <br>
            <hr>
        </div>
        <div class="footer-user">
            <form action="{{ route('auth.logout') }}" method="GET" class="form-logout">
                <button>
                    {{ __("misc.button.logout") }}
                </button>
            </form>
            <nav class="nav">
                <ul>
                    <a href="{{ route('users.edit',$user->id) }}">
                        <li class="item item-edit">
                            <p>{{ __("misc.button.edit") }}</p>
                        </li>
                    </a>

                    <li class="item item-excluir" id="excluir">
                        <p>{{ __("misc.button.delete") }}</p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="container-confirm" id="confirm">
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <hr>
            <h3 class="title-form">{{ __("misc.text.sure") }} </h3>
            <p class="description">{{ __("misc.text.irreversible_action") }}</p>
            <div class="btn-confirm">
                <button class="btn btn-cacelar" id="cacelar">
                    {{ __("misc.button.cancel") }}
                </button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="form-delete">
                    @csrf
                    @method("DELETE")

                    <button class="btn btn-excluir">
                        {{ __("misc.button.delete") }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
