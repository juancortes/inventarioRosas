<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVarietiesRequest;
use App\Http\Requests\UpdateVarietiesRequest;
use App\Models\Varieties;

class VarietiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $varieties = Varieties::select(['id', 'name'])
            ->get();

        return view('varieties.index', [
            'varieties' => $varieties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('varieties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVarietiesRequest $request)
    {
        Varieties::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('varieties.index')
            ->with('success', 'Variedad a sido creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Varieties $varieties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($variety_id)
    {
        $varieties = Varieties::find( $variety_id);
        return view('varieties.edit', [
            'varieties' => $varieties
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVarietiesRequest $request,  $variety_id)
    {
        $varieties = Varieties::find( $variety_id);
        $varieties->update([
            "name" => $request->name,
        ]);

        return redirect()
            ->route('varieties.index')
            ->with('success', 'Variedad fue actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $variety_id)
    {
        $varieties = Varieties::find( $variety_id);
        $varieties->delete();

        return redirect()
            ->route('varieties.index')
            ->with('success', 'Variedad fue eliminada!');
    }
}
