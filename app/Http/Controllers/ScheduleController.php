<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $schedules = Schedule::with('provider')->get();
        return view('schedules.index', compact('schedules'));
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
