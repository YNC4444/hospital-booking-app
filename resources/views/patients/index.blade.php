@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Patients</h1>
        <a href="{{ route('patients.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Add New Patient
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($patients as $patient)
        <a href="{{ route('patients.show', $patient->id) }}" class="block p-4 bg-white shadow-md rounded-lg hover:bg-gray-100 transition duration-200">
            <h2 class="text-xl font-bold">{{ $patient->fname }} {{ $patient->lname }}</h2>
            <p class="text-gray-700">{{ $patient->address }}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection
