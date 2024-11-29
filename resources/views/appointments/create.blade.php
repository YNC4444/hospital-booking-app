@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Add New Appointment</h1>

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

  <form action="{{ route('appointments.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    <div class="mb-4">
      <label for="patient" class="block text-gray-700 text-sm font-bold mb-2">Patient</label>
      <select name="patient_id" id="patient" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @foreach($patients as $patient)
        <option value="{{ $patient->id }}">{{ $patient->fname }} {{ $patient->lname }}</option>
        @endforeach
      </select>
      @error('patient')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
      <!-- select date with only future dates possible -->
      <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}" required>
      @error('date')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="schedule" class="block text-gray-700 text-sm font-bold mb-2">Schedule</label>
      <select name="schedule_id" id="schedule" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <!-- Options will be dynamically loaded based on the selected date -->
      </select>
      @error('schedule_id')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="service" class="block text-gray-700 text-sm font-bold mb-2">Service</label>
      <select name="service_id" id="service" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <!-- @foreach($services as $service)
        <option value="{{ $service->id }}">{{ $service->name }}</option>
        @endforeach -->
        <!-- Options will be dynamically loaded based on the selected schedule and provider -->
      </select>
      @error('service_id')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Start Time</label>
      <select name="start_time" id="start_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <!-- Options will be dynamically loaded based on the selected schedule -->
      </select>
      @error('start_time')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">End Time</label>
      <select name="end_time" id="end_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <!-- Options will be dynamically loaded based on the selected schedule -->
      </select>
      @error('end_time')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Add Appointment
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const scheduleSelect = document.getElementById('schedule');
    const serviceSelect = document.getElementById('service');
    const startTimeSelect = document.getElementById('start_time');
    const endTimeSelect = document.getElementById('end_time');

    function loadSchedules(date) {
      if (date) {
        fetch(`/api/schedules?date=${date}`)
          .then(response => response.json())
          .then(data => {
            // Clear existing options
            scheduleSelect.innerHTML = '';
            startTimeSelect.innerHTML = '';
            endTimeSelect.innerHTML = '';

            // Populate schedule options with provider information
            data.schedules.forEach(schedule => {
              const option = document.createElement('option');
              option.value = schedule.id;
              option.textContent = `Provider: Dr. ${schedule.provider.lname}, Start: ${schedule.start_time}, End: ${schedule.end_time}`;
              scheduleSelect.appendChild(option);
            });

            // Trigger change event on the schedule dropdown to load start and end times for the first schedule
            if (scheduleSelect.options.length > 0) {
              scheduleSelect.selectedIndex = 0;
              scheduleSelect.dispatchEvent(new Event('change'));
            }
          });
      }
    }

    function loadServices(scheduleId) {
      if (scheduleId) {
        fetch(`/api/schedules/${scheduleId}/services`)
          .then(response => response.json())
          .then(data => {
            // Clear existing options
            serviceSelect.innerHTML = '';

            // Populate service options
            data.services.forEach(service => {
              const option = document.createElement('option');
              option.value = service.id;
              option.textContent = service.name;
              serviceSelect.appendChild(option);
            });
          });
      }
    }

    function loadTimes(scheduleId) {
      if (scheduleId) {
        fetch(`/api/schedules/${scheduleId}/times`)
          .then(response => response.json())
          .then(data => {
            // Clear existing options
            startTimeSelect.innerHTML = '';
            endTimeSelect.innerHTML = '';

            // Populate start time options
            data.start_times.forEach(time => {
              const option = document.createElement('option');
              option.value = time;
              option.textContent = time;
              startTimeSelect.appendChild(option);
            });

            // Populate end time options
            data.end_times.forEach(time => {
              const option = document.createElement('option');
              option.value = time;
              option.textContent = time;
              endTimeSelect.appendChild(option);
            });
          });
      }
    }

    dateInput.addEventListener('change', function() {
      const date = dateInput.value;
      loadSchedules(date);
    });

    scheduleSelect.addEventListener('change', function() {
      const scheduleId = scheduleSelect.value;
      loadServices(scheduleId);
      loadTimes(scheduleId);
    });

    // Trigger the change event on page load to load schedules for the default date
    dateInput.dispatchEvent(new Event('change'));
  });
</script>
@endsection