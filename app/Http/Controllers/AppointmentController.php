<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('appointments.index', [
            'appointments' => Appointment::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        Appointment::create($request->validated());

        Session::flash('success', 'Appointment created successfully!');
        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        Session::flash('success', 'Appointment updated successfully!');
        return redirect()->route('appointments.show', $appointment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash($id)
    {
        Appointment::destroy($id);
        Session::flash('success', 'Appointment trashed successfully.');
        return redirect()->route('appointments.index');
    }

    public function destroy($id)
    {
        $appointment = Appointment::withTrashed()->where('id', $id)->first();
        $appointment->forceDelete();
        Session::flash('success', 'Appointment deleted successfully.');
        return redirect()->route('appointments.index');
    }

    public function restore($id)
    {
        $appointment = Appointment::withTrashed()->where('id', $id)->first();
        $appointment->restore();
        Session::flash('success', 'Appointment restored successfully.');
        return redirect()->route('appointments.trashed');
    }
}
