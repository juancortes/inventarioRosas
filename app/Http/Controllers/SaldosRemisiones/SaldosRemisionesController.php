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
      $remisiones = DB::table('remisiones')
                    ->select('remisiones.id', DB::raw("date ||' - ' || lands.name as finca"))
                    ->join('lands','remisiones.lands_id', '=', 'lands.id')
                    ->get();

      return view('saldosRemisiones.create',[
        'remisiones' => $remisiones,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaldosRemisionesRequest $request)
    {
      SaldosRemisiones::create([
          'remision_id'         => $request->remision_id,
          'produccion_freedom'  => $request->produccion_freedom,
          'produccion_color'    => $request->produccion_color,
          'devolucion_freedom'  => $request->devolucion_freedom,
          'devolucion_color'    => $request->devolucion_color,
          'valor_freedom'       => $request->valor_freedom,
          'valor_color'         => $request->valor_color,
          'valor_pagar_freedom' => $request->valor_pagar_freedom,
          'valor_pagar_color'   => $request->valor_pagar_color,
      ]);

      return redirect()
          ->route('saldosRemisiones.index')
          ->with('Exitoso', 'Saldos creados!');
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
    public function edit( $id)
    {
        $saldosRemision = SaldosRemisiones::find( $id);
        $remisiones = DB::table('remisiones')
                    ->select('remisiones.id', DB::raw("date ||' - ' || lands.name as finca"))
                    ->join('lands','remisiones.lands_id', '=', 'lands.id')
                    ->get();
        return view('saldosRemisiones.edit', [
            'saldosRemision' => $saldosRemision,
            'remisiones'     => $remisiones,
            'editar'     => $remisiones,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaldosRemisionesRequest $request, $id)
    {
        $saldosRemision = SaldosRemisiones::find( $id);
        $saldosRemision->update([
          'remision_id'         => $request->remision_id,
          'produccion_freedom'  => $request->produccion_freedom,
          'produccion_color'    => $request->produccion_color,
          'devolucion_freedom'  => $request->devolucion_freedom,
          'devolucion_color'    => $request->devolucion_color,
          'valor_freedom'       => $request->valor_freedom,
          'valor_color'         => $request->valor_color,
          'valor_pagar_freedom' => $request->valor_pagar_freedom,
          'valor_pagar_color'   => $request->valor_pagar_color,
        ]);

        return redirect()
            ->route('saldosRemisiones.index')
            ->with('Exitoso', 'Saldos fue actualizada!');
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
      $id      = $_GET['id'];
      $data    = [];
      $detalle = DB::table('detalle_remisiones')
                    ->select('varieties.freedom',DB::raw('SUM(detalle_remisiones.quantity_stems) AS cantidad'))
                    ->join('varieties', 'varieties.id', '=', 'detalle_remisiones.variety_id')
                    ->groupBy('varieties.freedom')
                    ->whereRaw('detalle_remisiones.remision_id = ?',$id)
                    ->get();
        
        $data["detalle"] = $detalle;

        if($_GET['editar'] == "1")
        {
            $saldosRemision = SaldosRemisiones::where('saldos_remisiones.remision_id',$_GET['id'])->first();
            $data["produccion_freedom"]  = $saldosRemision->produccion_freedom;
            $data["produccion_color"]    = $saldosRemision->produccion_color;
            $data["devolucion_freedom"]  = $saldosRemision->devolucion_freedom;
            $data["devolucion_color"]    = $saldosRemision->devolucion_color;
            $data["valor_freedom"]       = $saldosRemision->valor_freedom;
            $data["valor_color"]         = $saldosRemision->valor_color;
            $data["valor_pagar_freedom"] = $saldosRemision->valor_pagar_freedom;
            $data["valor_pagar_color"]   = $saldosRemision->valor_pagar_color;
        }
     
      return response()->json($data);
    }
}
