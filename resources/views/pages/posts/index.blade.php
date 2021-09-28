@extends('layouts/default')

@section('title', "Laravel")
<x-system.message />
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
@foreach ($posts as $post)
<section class="text-blueGray-700 bg-white mt-20">
    <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row lg:px-28">
        <div class="flex flex-col items-start mb-16 text-left lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:mb-0">
            <h2 class="mb-8 text-xs font-semibold tracking-widest text-black uppercase title-font">  {{ $post->user->name}}</h2>
            <h1 class="mb-8 text-2xl font-black tracking-tighter text-black md:text-5xl title-font"> {{ $post->title }} </h1>
            <p class="mb-8 text-base leading-relaxed text-left text-blueGray-600 "> {!! $post->content !!} </p>
            <div class="flex flex-col justify-center lg:flex-row">
                <form action="{{ route('posts.show', $post->id) }}" method="GET">
                    <button class="flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-lg hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2"> {{ __("post.text.title.show") }} </button>
                </form>
            </div>
        </div>
        <div class="w-full lg:w-1/3 lg:max-w-lg md:w-1/2">
            <img class="object-cover object-center rounded-lg " alt="hero" src="https://dummyimage.com/720x600/F3F4F7/8693ac">
        </div>
    </div>
</section>
@endforeach
    {{ $posts->links() }}
@endsection
