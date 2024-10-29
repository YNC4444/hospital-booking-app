<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;

// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function index()
    {
        return view('patients.index', [
            'patients' => Patient::all()
        ]);
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        Patient::create($request->validated());

        Session::flash('success', 'Patient created successfully.');
        return redirect()->route('patients.index');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient updated successfully.');
    }

    public function trash($id) 
    {
        Patient::destroy($id);
        Session::flash('success', 'Patient trashed successfully.');
        return redirect()->route('patients.index');
    }

    public function destroy($id)
    {
        $patient = Patient::withTrashed()->where('id', $id)->first();
        $patient->forceDelete();
        Session::flash('success', 'Patient deleted successfully.');
        return redirect()->route('patients.index');
    }

    public function restore($id)
    {
        $patient = Patient::withTrashed()->where('id', $id)->first();
        $patient->restore();
        Session::flash('success', 'Patient restored successfully.');
        return redirect()->route('patients.trashed');
    }
}
