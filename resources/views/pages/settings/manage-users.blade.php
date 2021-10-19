@extends('layouts/default')

@section('title', 'Settings')

@section('content')
<x-system.message />
<div>
    <p>Settings</p>

    <div class="flex justify-between">
        <div class="w-2/4 border-2 rounded-md">
            <form method="POST" action="{{ route('system.admin.settings.import-users') }}" enctype="multipart/form-data" class="w-full flex flex-col">
                @csrf
                <label for="">Import users</label>
                <x-form.input name="users-file" type="file" class="inline-block" />
                <button class="bg-green-300 p-3 rounded-md inline-block mt-3 mb-3 m-auto">Import</button>
            </form>
        </div>

        <div class="w-2/4 border-2 rounded-md ml-5">
            <form method="GET" action="{{ route('system.admin.settings.export-users') }}" class="w-full flex flex-col">
                <label for="">Export users</label>
                <button class="bg-green-300 p-3 rounded-md inline-block mt-3 mb-3 m-auto">Export</button>
            </form>
        </div>
    </div>
</div>
@endsection
