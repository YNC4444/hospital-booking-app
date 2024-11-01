@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Service Details</h1>
  <div class="bg-white shadow-md rounded p-6">
    <div class="mb-4">
      <h2 class="text-xl font-bold">{{ $service->name }}</h2>
      <!-- <p><strong>Description:</strong> {{ $service->description }}</p> -->
    </div>
    <div class="flex items-center justify-between">
      <a href="{{ route('services.edit', $service->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Edit
      </a>
      <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Delete
        </button>
      </form>
    </div>
  </div>
</div>
@endsection