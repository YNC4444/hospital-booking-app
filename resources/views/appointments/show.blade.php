@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Appointment Details</h1>
    <a href="{{ route('appointments.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Back to Appointments
    </a>
  </div>
  <div class="bg-white shadow-md rounded-lg p-4 mb-4 ">
    <h2 class="text-xl font-bold">Provider: Dr.{{ $appointment->provider->lname }}</h2>
    @if($appointment->patient)
    <p class="text-gray-700">Patient: {{ $appointment->patient->fname }} {{ $appointment->patient->lname }}</p>
    @else
    <p class="text-gray-700">Patient: Unbooked</p>
    @endif
    <p class="text-gray-700">Service: {{ $appointment->service->name }}</p>
    <p class="text-gray-700">Date: {{ $appointment->date }}</p>
    <p class="text-gray-700">Time: {{ $appointment->start_time }} - {{ $appointment->end_time }}</p>
  </div>
  <div class="flex items-center justify-between">
    <a href="{{ route('appointments.edit', $appointment->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Edit
    </a>
    <a href="{{ route('appointments.trash', $appointment->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Delete
    </a>
  </div>
</div>

@endsection