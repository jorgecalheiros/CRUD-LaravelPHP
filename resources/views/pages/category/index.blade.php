@extends('layouts/admindefault')

@section('title', 'Categorys')

@section('content')
<div class="container-add-category--">
    <a href="{{ route('category.create') }}" class="add_category--">{{ __("category.text.title.add") }}</a>
</div>
<div class="md:px-32 py-8 w-full">
    <div class="shadow overflow-hidden rounded border-b border-gray-200">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Id</th>
            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">{{ __("category.text.title.category") }}</th>
            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Slug</th>
          </tr>
        </thead>
      <tbody class="text-gray-700">
       @foreach ($categories as $category)
        <tr>
            <td class="w-1/3 text-left py-3 px-4">{{ $category->id }}</td>
            <td class="w-1/3 text-left py-3 px-4">{{ $category->title }}</td>
            <td class="text-left py-3 px-4">{{ $category->slug }}</td>
        </tr>
       @endforeach
      </tbody>
      </table>
    </div>
  </div>
@endsection
