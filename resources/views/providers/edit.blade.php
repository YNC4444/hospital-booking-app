@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Edit Provider</h1>

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

  <form action="{{ route('providers.update', $provider->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label for="fname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
      <input type="text" name="fname" id="fname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fname', $provider->fname) }}" required>
      @error('fname')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="lname" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
      <input type="text" name="lname" id="lname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('lname', $provider->lname) }}" required>
      @error('lname')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
      <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $provider->email) }}" required>
      @error('email')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth</label>
      <input type="date" name="dob" id="dob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('dob', $provider->dob) }}" readonly>
      @error('dob')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
      <select name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <option value="male" {{ old('gender', $provider->gender) == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender', $provider->gender) == 'female' ? 'selected' : '' }}>Female</option>
      </select>
      @error('gender')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
      <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('phone', $provider->phone) }}" required>
      @error('phone')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
      <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('address', $provider->address) }}" required>
      @error('address')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="specialization" class="block text-gray-700 text-sm font-bold mb-2">Specialization</label>
      <select name="specialization" id="specialization" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" disabled>
        <option value="">Select Specialization</option>
        @foreach(['General Practitioner', 'Cardiologist', 'Dermatologist', 'Pediatrician', 'Neurologist'] as $specialization)
        <option value="{{ $specialization }}" {{ $provider->specialization == $specialization ? 'selected' : '' }}>{{ $specialization }}</option>
        @endforeach
      </select>
      <input type="hidden" name="specialization" value="{{ $provider->specialization }}">
      @error('specialization')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="services" class="block text-gray-700 text-sm font-bold mb-2">Services</label>
      @foreach(['Consultation', 'Diagnosis', 'Treatment', 'Prescription', 'Referral'] as $service)
      <div class="flex items-center">
        <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service, old('services', $provider->services)) ? 'checked' : '' }} class="mr-2 leading-tight">
        <span class="text-gray-700">{{ $service }}</span>
      </div>
      @endforeach
      @error('services')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Update Provider
      </button>
    </div>
  </form>
</div>
@endsection