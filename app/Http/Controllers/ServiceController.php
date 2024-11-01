<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        // dd($services);
        // return view('services.index', [
        //     'services' => Service::all()
        // ]);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());

        Session::flash('success', 'Service created successfully');
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        Session::flash('success', 'Service updated successfully');
        return redirect()->route('services.show', $service->id)->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->forceDelete();
        Session::flash('success', 'Service deleted successfully');
        return redirect()->route('services.index');
    }
}
