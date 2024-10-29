<?php

namespace App\Http\Controllers;

use App\Models\provider;
use App\Http\Requests\StoreproviderRequest;
use App\Http\Requests\UpdateproviderRequest;

use Illuminate\Support\Facades\Session;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('providers.index', [
            'providers' => provider::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproviderRequest $request)
    {
        // dd($request->all());
        provider::create($request->validated());

        Session::flash('success', 'Provider created successfully.');
        return redirect()->route('providers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproviderRequest $request, provider $provider)
    {
        $provider->update($request->validated());

        return redirect()->route('providers.show', $provider->id)->with('success', 'Provider updated successfully.');
    }

    public function trash($id)
    {
        provider::destroy($id);
        Session::flash('success', 'Provider trashed successfully.');
        return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(provider $provider)
    {
        $provider = provider::withTrashed()->where('id', $provider->id)->first();
        $provider->forceDelete();
        Session::flash('success', 'Provider deleted successfully.');
        return redirect()->route('providers.index');
    }

    public function restore($id)
    {
        $provider = provider::withTrashed()->where('id', $id)->first();
        $provider->restore();
        Session::flash('success', 'Provider restored successfully.');
        return redirect()->route('providers.trashed');
    }
}
