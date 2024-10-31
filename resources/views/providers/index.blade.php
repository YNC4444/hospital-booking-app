@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Providers</h1>
    <a href="{{ route('providers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Add New Provider
    </a>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($providers as $provider)
    <a href="{{ route('providers.show', $provider->id) }}" class="block p-4 bg-white shadow-md rounded-lg hover:bg-gray-100 transition duration-200">
      <h2 class="text-xl font-bold">{{ $provider->fname }} {{ $provider->lname }}</h2>
      <p class="text-gray-700">{{ $provider->specialization }}</p>
      <!-- if services is an array, join array elements into a list-->
      <p class="text-gray-700">Services: {{ is_array($provider->services->pluck('name')->toArray()) ? implode(', ', $provider->services->pluck('name')->toArray()) : 'Invalid services data' }}</p>
    </a>
    @endforeach
  </div>
</div>
@endsection