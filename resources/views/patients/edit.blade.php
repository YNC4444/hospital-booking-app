@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
  <h1 class="text-2xl font-bold mb-4">Edit Patient</h1>

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

  <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label for="fname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
      <input type="text" name="fname" id="fname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('fname', $patient->fname) }}" required>
      @error('fname')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="lname" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
      <input type="text" name="lname" id="lname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('lname', $patient->lname) }}" required>
      @error('lname')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
      <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $patient->email) }}" required>
      @error('email')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth</label>
      <input type="date" name="dob" id="dob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('dob', $patient->dob) }}" readonly>
      @error('dob')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
      <select name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
      </select>
      @error('gender')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
      <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('phone', $patient->phone) }}" required>
      @error('phone')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
      <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('address', $patient->address) }}" required>
      @error('address')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="emergency_contact_name" class="block text-gray-700 text-sm font-bold mb-2">Emergency Contact Name</label>
      <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}" required>
      @error('emergency_contact_name')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-4">
      <label for="emergency_contact_phone" class="block text-gray-700 text-sm font-bold mb-2">Emergency Contact Phone</label>
      <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}" required>
      @error('emergency_contact_phone')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Update Patient
      </button>
    </div>
  </form>
</div>
@endsection