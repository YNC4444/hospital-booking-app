@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Provider Details</h1>
  <div class="bg-white shadow-md rounded p-6">
    <div class="mb-4">
      <h2 class="text-xl font-bold">Personal Information</h2>
      <p><strong>First Name:</strong> {{ $provider->fname }}</p>
      <p><strong>Last Name:</strong> {{ $provider->lname }}</p>
      <p><strong>Email:</strong> {{ $provider->email }}</p>
      <p><strong>Phone:</strong> {{ $provider->phone }}</p>
    </div>
    <div class="mb-4">
      <h2 class="text-xl font-bold">Professional Information</h2>
      <p><strong>Specialization:</strong> {{ $provider->specialization }}</p>
      <!-- join the elements of the array into a string -->
      <p><strong>Services offered:</strong> {{ implode(', ', $provider->services) }}</p>
    </div>
    <div class="flex items-center justify-between">
      <a href="{{ route('providers.edit', $provider->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Edit
      </a>
      <a href="{{ route('providers.trash', $provider->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Delete
      </a>
    </div>
  </div>
</div>
@endsection