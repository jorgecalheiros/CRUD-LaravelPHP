@extends('layouts/default')

@section('title', "Laravel")

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
