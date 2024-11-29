@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Schedule Details</h1>
    <a href="{{ route('schedules.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Back to Schedules
    </a>
  </div>

  <div class="bg-white shadow-md rounded-lg p-4 mb-4">
    <h2 class="text-xl font-bold">Provider: Dr.{{ $schedule->provider->lname }}</h2>
    <p class="text-gray-700">Date: {{ $schedule->date }}</p>
    <p class="text-gray-700">Time: {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
  </div>
  <div class="flex items-center justify-between">
    <a href="{{ route('schedules.edit', $schedule->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Edit
    </a>
    <a href="{{ route('schedules.trash', $schedule->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Delete
    </a>
  </div>

  <div class="bg-white shadow-md rounded-lg p-4">
    <h2 class="text-xl font-bold mb-4">Appointments</h2>
    @if($schedule->appointments->isEmpty())
    <p class="text-gray-700">No appointments for this schedule.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach($schedule->appointments as $appointment)
      <div class="block p-4 bg-white shadow-md rounded-lg hover:bg-gray-100 transition duration-200">
        @if($appointment->patient)
          <h3 class="text-xl font-bold">Patient: {{ $appointment->patient->fname }} {{ $appointment->patient->lname }}</h3>
        @else
          <h3 class="text-xl font-bold">Patient: Unbooked</h3>
        @endif
        <p class="text-gray-700">Time: {{ $appointment->start_time }} - {{ $appointment->end_time }}</p>
        <p class="text-gray-700">Status: {{ $appointment->status }}</p>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
@endsection