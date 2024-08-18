<?php

namespace App\Http\Controllers\Lands;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandsRequest;
use App\Http\Requests\UpdateLandsRequest;
use App\Models\Lands;

class LandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lands = Lands::select(['id', 'name'])
            ->get();

        return view('lands.index', [
            'lands' => $lands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLandsRequest $request)
    {
        Lands::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('lands.index')
            ->with('Exitoso', 'Finca a sido creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lands $lands)
    {

        return view('lands.show', [
            'lands' => $lands
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($lands_id)
    {
        $lands = Lands::find( $lands_id);
        return view('lands.edit', [
            'lands' => $lands
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLandsRequest $request,  $lands_id)
    {
        $lands = Lands::find( $lands_id);
        $lands->update([
            "name" => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('lands.index')
            ->with('Exitoso', 'Finca fue actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($lands_id)
    {
        $lands = Lands::find( $lands_id);
        $lands->delete();

        return redirect()
            ->route('lands.index')
            ->with('Exitoso', 'Finca fue eliminada!');
    }
}
