@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Add New Provider</h1>

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

  <form action="{{ route('providers.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    <div class="mb-4">
      <label for="fname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
      <input type="text" name="fname" id="fname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fname') }}" required>
      @error('fname')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="lname" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
      <input type="text" name="lname" id="lname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('lname') }}" required>
      @error('lname')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
      <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
      @error('email')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
      <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      @error('password')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="mb-4">
      <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth</label>
      <input type="date" name="dob" id="dob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('dob') }}" required>
      @error('dob')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
      <select name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
      </select>
      @error('gender')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
      <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('phone') }}" required>
      @error('phone')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
      <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('address') }}" required>
      @error('address')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="specialization" class="block text-gray-700 text-sm font-bold mb-2">Specialization</label>
      <select name="specialization" id="specialization" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <option value="">Select Specialization</option>
        @foreach(['General Practitioner', 'Cardiologist', 'Dermatologist', 'Pediatrician', 'Neurologist'] as $specialization)
        <option value="{{ $specialization }}" {{ old('specialization') == $specialization ? 'selected' : '' }}>{{ $specialization }}</option>
        @endforeach
      </select>
      @error('specialization')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="services" class="block text-gray-700 text-sm font-bold mb-2">Services</label>
      @foreach(['Consultation', 'Diagnosis', 'Treatment', 'Prescription', 'Referral'] as $service)
      <div class="flex items-center">
        <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service, old('services', [])) ? 'checked' : '' }} class="mr-2 leading-tight">
        <span class="text-gray-700">{{ $service }}</span>
      </div>
      @endforeach
      @error('services')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="license_number" class="block text-gray-700 text-sm font-bold mb-2">License Number</label>
      <input type="text" name="license_number" id="license_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('license_number') }}" required>
      @error('license_number')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <input type="hidden" name="employment_date" value="{{ now()->toDateString() }}">


    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Add Provider
      </button>
    </div>
  </form>
</div>
@endsection