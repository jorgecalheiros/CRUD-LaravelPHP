@extends('layouts/default')

@section('title', "Laravel")

@section('header')
    <div class="show-user">
        <div class="icon">
            <i class="fas fa-user"></i>
        </div>
        <span>Ciclano</span>
    </div>
    <form action="{{ route('auth.logout') }}" method="GET" class="form-logout">
        <button>
            {{ __("misc.button.logout") }}
        </button>
    </form>
@endsection

@section('content')
<div class="container-max-user">
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
    {{ $users->links() }}
</div>
@endsection
