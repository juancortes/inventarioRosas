<?php

namespace App\Http\Controllers\SaldosRemisiones;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaldosRemisionesRequest;
use App\Http\Requests\UpdateSaldosRemisionesRequest;
use App\Models\SaldosRemisiones;
use App\Models\Remisiones;
use Illuminate\Support\Facades\DB;

class SaldosRemisionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saldosRemisiones = SaldosRemisiones::select(['produccion_freedom', 'produccion_color','devolucion_freedom','devolucion_color','valor_freedom','valor_color','valor_pagar_freedom','valor_pagar_color'])
            ->get();

        return view('saldosRemisiones.index', [
            'saldosRemisiones' => $saldosRemisiones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $lands = DB::table('remisiones')
                ->select('remisiones.id', DB::raw("date ||' - ' || lands.name as finca"))
                ->join('lands','remisiones.lands_id', '=', 'lands.id')
                ->get();

      return view('saldosRemisiones.create',[
        'lands' => $lands,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaldosRemisionesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SaldosRemisiones $saldosRemisiones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaldosRemisiones $saldosRemisiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaldosRemisionesRequest $request, SaldosRemisiones $saldosRemisiones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaldosRemisiones $saldosRemisiones)
    {
        //
    }

    public function getRemisionData()
    {
      $id = $_GET['id'];
      $detalle = DB::table('detalle_remisiones')
                    ->select('varieties.freedom',DB::raw('SUM(detalle_remisiones.quantity_stems) AS cantidad'))
                    ->join('varieties', 'varieties.id', '=', 'detalle_remisiones.variety_id')
                    ->groupBy('varieties.freedom')
                    ->whereRaw('detalle_remisiones.remision_id = ?',$id)
                    ->get();
     
      return response()->json($detalle);
    }
}
