@extends('layouts/login-cadastro')

@php
    $onlyEdit = data_get($config,"onlyEdit");
    $title = data_get($config,"title");
    $method = data_get($config, "method");
    $_method = data_get($config,"_method");
    $route = data_get($config,"route");
    $postTitle = $post->title ?? "";
    $postContent = $post->content ?? "";
@endphp


@section('content-form')
<x-system.message />
<div class="container-form">
    @if (!$onlyEdit)
        <div class="side-post">
           {{ __("post.text.create_account") }}
        </div>
    @else
    <div class="side-post">
        {{ __("post.text.edit_account") }}
    </div>
    @endif
        <form action="{{ $route }}" class="side-form" method="{{ $method }}" id="postSaveForm">
            @csrf
            @if ($_method)
                @method($_method)
            @endif
                <x-form.input type="text" name="title" icon="none"  placeholder="{{ __('post.placeholder.title') }}" value="{{ $postTitle }}" />

                <div id="quillEditor">
                    {!! $postContent !!}
                </div>
                <x-form.textarea name="content"/>
            <button class="btn submit" type="button" id="savePost">
                {{ $title }}
            </button>
        </form>
 </div>
    <script type="text/javascript">
        document.getElementById('savePost').addEventListener('click', function() {
            var postContent = document.querySelector("#quillEditor div").innerHTML;
            document.getElementById('content').value = postContent;
            document.getElementById('postSaveForm').submit();
        });
    </script>
@endsection
