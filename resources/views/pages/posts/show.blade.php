@extends('layouts/default')


@section('title', "Laravel")
<x-system.message />
@section('content')
<div class="body-false" id="false">.</div>
    <div class="container-post-show">
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
          {{ $post->content }}
        </div>
        <div class="data-post">
            <span>{{ $post->created_at }}</span>
        </div>
    </div>
@endsection
