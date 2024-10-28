@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Patient Details</h1>
    <div class="bg-white shadow-md rounded p-6">
        <div class="mb-4">
            <h2 class="text-xl font-bold">Personal Information</h2>
            <p><strong>First Name:</strong> {{ $patient->fname }}</p>
            <p><strong>Last Name:</strong> {{ $patient->lname }}</p>
            <p><strong>Email:</strong> {{ $patient->email }}</p>
            <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
            <p><strong>Gender:</strong> {{ $patient->gender }}</p>
            <p><strong>Phone:</strong> {{ $patient->phone }}</p>
            <p><strong>Address:</strong> {{ $patient->address }}</p>
        </div>
        <div class="mb-4">
            <h2 class="text-xl font-bold">Emergency Contact</h2>
            <p><strong>Emergency Contact Name:</strong> {{ $patient->emergency_contact_name }}</p>
            <p><strong>Emergency Contact Phone:</strong> {{ $patient->emergency_contact_phone }}</p>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('patients.edit', $patient->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Edit
            </a>
            <form action="{{ route('patients.trash', $patient->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this patient?');">
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
