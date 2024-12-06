@extends('layouts.admin')

@section('content')

<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Edit Schedule</h1>

  <!-- Display All Errors -->
  @if ($errors->any())
  <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
    <strong class="font-bold">Whoops! Something went wrong.</strong>
    <ul class="mt-3 list-disc list-inside text-sm">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('schedules.update', $schedule->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
      <!-- select date with only future dates possible -->
      <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('date', $schedule->date) }}" min="{{ now()->toDateString() }}" required>
      @error('date')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Start time:</label>
      <select name="start_time" id="start_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <!-- need to add the :00 at the end because  the value stored in the db has seconds -->
        <option value="07:00" {{ old('start_time', $schedule->start_time) == '07:00:00' ? 'selected' : '' }}>07:00</option>
        <option value="13:00" {{ old('start_time', $schedule->start_time) == '13:00:00' ? 'selected' : '' }}>13:00</option>
        <option value="15:00" {{ old('start_time', $schedule->start_time) == '15:00:00' ? 'selected' : '' }}>15:00</option>
      </select>
      @error('start_time')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">Start time:</label>
      <select name="end_time" id="end_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <option value="13:00" {{ old('end_time', $schedule->end_time) == '13:00:00' ? 'selected' : '' }}>13:00</option>
      <option value="15:00" {{ old('end_time', $schedule->end_time) == '15:00:00' ? 'selected' : '' }}>15:00</option>
      <option value="20:00" {{ old('end_time', $schedule->end_time) == '20:00:00' ? 'selected' : '' }}>20:00</option>
      </select>
      @error('end_time')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="provider" class="block text-gray-700 text-sm font-bold mb-2">Provider</label>
      <select name="provider_id" id="provider" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @foreach($providers as $provider)
        @if($provider->status == 'Active')
        <option value="{{ $provider->id }}" {{ $provider->id == old('provider_id', $schedule->provider_id) ? 'selected' : '' }}>Dr. {{ $provider->lname }}</option>
        @endif
        @endforeach
      </select>
      @error('provider')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Add Schedule
      </button>
    </div>
  </form>
</div>
@endsection