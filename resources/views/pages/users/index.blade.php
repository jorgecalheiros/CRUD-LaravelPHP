@extends('templates/default')

@section('title', "Laravel")

@section('content')
 <h1>Ola mundo!</h1>
 <p>com Laravel</p>

<div class="container-max-user">
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
</div>
@endsection
