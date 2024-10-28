@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Patients</h1>
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
