@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Services</h1>
    <a href="{{ route('services.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Add New Service
    </a>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($services as $service)
    <a href="{{ route('services.show', $service->id) }}" class="block p-4 bg-white shadow-md rounded-lg hover:bg-gray-100 transition duration-200">
      <h2 class="text-xl font-bold">{{ $service->name }}</h2>
    </a>
    @endforeach
  </div>
</div>
@endsection