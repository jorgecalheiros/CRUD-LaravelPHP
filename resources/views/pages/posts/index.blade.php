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
    <form action="{{ route('posts.create') }}" method="GET" class="form-logout">
        <button>
            {{ __("misc.button.create_post") }}
        </button>
    </form>
@endsection

@section('content')
<div class="container-max-user">
    <ul>
        @foreach ($posts as $post)
        <div class="container-post rounded-xl shadow-md hover:shadow-xl">
            <div class="user-post">
                <figure class="picture-user">

                </figure>
                <span>
                    {{ $post->user->name}}
                </span>
            </div>
            <div class="title-post">
                <h1>{{ $post->title }}</h1>
            </div>
            <div class="content-post">
              {!! $post->content !!}
            </div>
            <div class="data-post">
                <span>{{ $post->created_at }}</span>
            </div>
        </div>
        @endforeach
    </ul>
    {{ $posts->links() }}
</div>
@endsection
