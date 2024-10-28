@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Patients</h1>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200">First Name</th>
                <th class="py-2 px-4 border-b border-gray-200">Last Name</th>
                <th class="py-2 px-4 border-b border-gray-200">Email</th>
                <th class="py-2 px-4 border-b border-gray-200">Date of Birth</th>
                <th class="py-2 px-4 border-b border-gray-200">Gender</th>
                <th class="py-2 px-4 border-b border-gray-200">Phone</th>
                <th class="py-2 px-4 border-b border-gray-200">Address</th>
                <th class="py-2 px-4 border-b border-gray-200">Emergency Contact Name</th>
                <th class="py-2 px-4 border-b border-gray-200">Emergency Contact Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->fname }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->lname }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->email }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->dob }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->gender }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->phone }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->address }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->emergency_contact_name }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ $patient->emergency_contact_phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
