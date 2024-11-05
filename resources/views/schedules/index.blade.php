@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Schedules</h1>
    <a href="{{ route('schedules.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Add New Schedule
    </a>
  </div>

  <form action="{{ route('schedules.index') }}" method="get" class="mb-4">
    <div class="flex space-x-4">
      <div>
        <label for="provider" class="block text-gray-700">Provider</label>
        <select name="provider" id="provider" class="form-select">
          <option value="">All Providers</option>
          @foreach($providers as $provider)
          <option value="{{ $provider->id }}" {{ request('provider') == $provider->id ? 'selected' : '' }}>
            Dr.{{ $provider->lname }}
          </option>
          @endforeach
        </select>
      </div>
      <div>
        <label for="date" class="block text-gray-700">Date</label>
        <input type="date" name="date" id="date" class="form-input" value="{{ request('date') }}">
      </div>
      <div>
        <label for="status" class="block text-gray-700">Status</label>
        <select name="status" id="status" class="form-select">
          <option value="">All Statuses</option>
          <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
          <!-- <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option> -->
        </select>
      </div>
      <div class="flex items-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Filter
        </button>
      </div>
    </div>
  </form>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($schedules as $schedule)
    <a href="{{ route('schedules.show', $schedule->id) }}" class="block p-4 bg-white shadow-md rounded-lg hover:bg-gray-100 transition duration-200">
      <h2 class="text-xl font-bold">Dr.{{ $schedule->provider->lname }}</h2>
      <p class="text-gray-700">{{ $schedule->date }}</p>
      <p class="text-gray-700">{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
    </a>
    @endforeach
  </div>
</div>
@endsection