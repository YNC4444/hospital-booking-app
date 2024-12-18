<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Provider;
use App\Models\Schedule;
use App\Models\Service;
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
        $appointments = Appointment::all();
        $providers = Provider::all();
        $services = Service::all();
        
        return view('appointments.index', compact('appointments', 'providers', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $providers = Provider::all();
        $schedules = Schedule::all();
        $services = Service::all();

        return view('appointments.create', compact('patients', 'providers', 'schedules', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();
        
        // get provider_id from schedule_id
        $schedule = Schedule::findorFail($data['schedule_id']);
        $data['provider_id'] = $schedule->provider_id;

        // set status to booked
        $data['status'] = 'booked';

        Appointment::create($data);

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
        $patients = Patient::all();
        $providers = Provider::all();
        $schedules = Schedule::all();
        $services = Service::all();

        return view('appointments.edit', compact('appointment', 'patients', 'providers', 'schedules', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $data = $request->validated();

        // get schedule_id from appointment
        $schedule = Schedule::findorFail($data['schedule_id']);
        // get provider_id from schedule_id
        $data['provider_id'] = $schedule->provider_id;

        // update appointment with new data
        $appointment->update($data);

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
