<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function index()
    {
        // $patients = Patient::all();
        // return view('patients.index', compact('patients'));
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
        // $validated = $request->validate([
        //     'fname' => 'required|string|max:255',
        //     'lname' => 'required|string|max:255',
        //     'email' => 'required|email|unique:patients,email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'dob' => 'required|date|before:today',
        //     'gender' => 'required|string|in:male,female',
        //     'phone' => 'required|string|max:15',
        //     'address' => 'required|string|max:255',
        //     'emergency_contact_name' => 'required|string|max:255',
        //     'emergency_contact_phone' => 'required|string|max:15',
        // ]);

        Patient::create($request->validated());

        Session::flash('success', 'Patient created successfully.');
        // Patient::create($validated);

        // return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
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

    public function trash($id) // used to be called destroy
    {
        Patient::destroy($id);
        Session::flash('success', 'Patient trashed successfully.');
        return redirect()->route('patients.index');
        // $patient->delete();
        // return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
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
