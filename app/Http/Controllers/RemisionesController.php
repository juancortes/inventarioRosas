<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreremisionesRequest;
use App\Http\Requests\UpdateremisionesRequest;
use App\Models\Remisiones;
use App\Models\Lands;
use Illuminate\Http\Request;

class RemisionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $remisiones = Remisiones::count();

        return view('remisiones.index', [
            'remisiones' => $remisiones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $lands         = Lands::get(['id', 'name']);

      if ($request->has('lands')) {
          $lands = Lands::get();
      }

      return view('remisiones.create',[
        'lands'         => $lands,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreremisionesRequest $request)
    {
      /**
       * Handle upload file
       */
      $support = "";
      if ($request->hasFile('support')) {
        $support = $request->file('support')->store('remisiones', 'public');
      }

      Remisiones::create([
        'support'        => $support,
        'date'           => $request->date,
        'lands_id'       => $request->lands_id,
        'variety'        => $request->variety,
        'quantity_stems' => $request->quantity_stems,
        'observations'   => $request->observations,
        'user_id'        => auth()->id()
      ]);
      return to_route('remisiones.index')->with('success', 'Remisión ha sido creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $remision_id)
    {
        $remisiones = Remisiones::find($remision_id);

        return view('remisiones.show', [
            'remisiones' => $remisiones
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($remision_id)
    {
        $remision = Remisiones::find( $remision_id);
        
        return view('remisiones.edit', [
            'remision' => $remision,
            'lands'      => Lands::get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateremisionesRequest $request, $remision_id)
    {
        $remision = Remisiones::find( $remision_id);
        $remision->update($request->except('support'));

        $image = $remision->support;
        if ($request->hasFile('support')) {

            // Delete Old Photo
            if ($remision->support) {
                unlink(public_path('storage/') . $remision->support);
            }
            $image = $request->file('support')->store('remisiones', 'public');
        }

        $remision->support        = $image;
        $remision->date           = $request->date;
        $remision->lands_id       = $request->lands_id;
        $remision->variety        = $request->variety    ;
        $remision->quantity_stems = $request->quantity_stems;
        $remision->observations   = $request->observations;
        $remision->save();

        return redirect()
            ->route('remisiones.index')
            ->with('success', 'Remision ha sido actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($remision_id)
    {
        $remision = Remisiones::find( $remision_id);
        $remision->delete();

        return redirect()
            ->route('remisiones.index')
            ->with('success', 'Remision fue eliminada!');
    }
}
