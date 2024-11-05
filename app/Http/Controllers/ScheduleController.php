<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Provider;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Request used because I need to access query parameters
    public function index(Request $request)
    {
        // query schedules with optional filtering
        $query = Schedule::with('provider');

        // check if request has provider and provider is not empty
        if ($request->has('provider') && $request->provider) {
            $query->where('provider_id', $request->provider);
        }

        if ($request->has('date') && $request->date) {
            $query->where('date', $request->date);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $schedules = $query->get();
        
        // get all providers to populate the filter dropdown
        $providers = Provider::all();

        // $schedules = Schedule::with('provider')->get();
        return view('schedules.index', compact('schedules', 'providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        Schedule::create($request->validated());

        Session::flash('success', 'Schedule created successfully.');
        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $appointments = Appointment::all()->where('schedule_id', $schedule->id);
        // fetch schedule with provider and appointments
        $schedule->load('provider', 'appointments.patient');
        return view('schedules.show', compact('schedule')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());

        return redirect()->route('schedules.show', $schedule->id)->with('success', 'Schedule updated successfully.');
    }

    public function trash($id)
    {
        Schedule::destroy($id);
        Session::flash('success', 'Schedule trashed successfully.');
        return redirect()->route('schedules.index');
    }

    public function destroy($id)
    {
        $schedule = Schedule::withTrashed()->where('id', $id)->first();
        $schedule->forceDelete();
        Session::flash('success', 'Schedule deleted successfully.');
        return redirect()->route('schedules.index');
    }

    public function restore($id)
    {
        $schedule = Schedule::withTrashed()->where('id', $id)->first();
        $schedule->restore();
        Session::flash('success', 'Schedule restored successfully.');
        return redirect()->route('schedules.trashed');
    }
}
