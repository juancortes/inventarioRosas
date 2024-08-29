<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreremisionesRequest;
use App\Http\Requests\UpdateremisionesRequest;
use App\Models\Remisiones;
use App\Models\Lands;
use App\Models\Varieties;
use App\Models\DetalleRemisiones;
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
      $varieties     = Varieties::get(['id', 'name']);

      if ($request->has('lands')) {
          $lands = Lands::get();
      }

      if ($request->has('varieties')) {
          $varieties = Lands::get();
      }

      return view('remisiones.create',[
        'lands'     => $lands,
        'varieties' => $varieties,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreremisionesRequest $request)
    {
      $val = true;
      $variety = "";

      foreach ($request->variety as $key => $value) {
        if($variety != $request->variety)
        {
          $variety = $request->variety;
        }
        else
        {
            if($variety == $value)
                $val = false;
        }
      }

      if(!$val)
      {
        return redirect()
            ->route('remisiones.create')
            ->with('Error', 'Variedad no puede estar duplicada!');
      }
      /**
       * Handle upload file
       */
      $support = "";
      if ($request->hasFile('support')) {
        $support = $request->file('support')->store('remisiones', 'public');
      }

      $remision = Remisiones::create([
        'support'        => $support,
        'date'           => $request->date,
        'lands_id'       => $request->lands_id,
        'observations'   => $request->observations,
        'user_id'        => auth()->id()
      ]);

      foreach ($request->variety as $key => $value) {
        DetalleRemisiones::create([
          'remision_id'    => $remision->id,
          'variety_id'     => $value,
          'quantity_stems' => $request->quantity_stems[$key]
        ]);
      }

      return to_route('remisiones.index')->with('Exitoso', 'Remisión ha sido creado!');
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
        $remision   = Remisiones::find( $remision_id);
        $varieties  = Varieties::get(['id', 'name']);
        $detalleRem = DetalleRemisiones::where('remision_id', $remision_id)
                                    ->get();
        return view('remisiones.edit', [
            'remision'   => $remision,
            'varieties'  => $varieties,
            'detalleRem' => $detalleRem,
            'lands'      => Lands::get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateremisionesRequest $request, $remision_id)
    {
        $remision = Remisiones::find( $remision_id);
        

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
        $remision->observations   = $request->observations;
        $remision->save();

        $detalleRem = DetalleRemisiones::where('remision_id', $remision->id)->delete();

        foreach ($request->variety as $key => $value) {
            DetalleRemisiones::create([
              'remision_id'    => $remision->id,
              'variety_id'     => $value,
              'quantity_stems' => $request->quantity_stems[$key]
            ]);
        }

        return redirect()
            ->route('remisiones.index')
            ->with('Exitoso', 'Remision ha sido actualizado!');
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
            ->with('Exitoso', 'Remision fue eliminada!');
    }
}
