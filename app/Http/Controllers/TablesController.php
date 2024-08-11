<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTablesRequest;
use App\Http\Requests\UpdateTablesRequest;
use App\Models\Tables;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Tables::select(['id', 'name'])
            ->get();

        return view('tables.index', [
            'tables' => $tables,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTablesRequest $request)
    {
        Tables::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('tables.index')
            ->with('Exitoso', 'Mesa ha sido creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tables $tables)
    {
        return view('tables.show', [
            'tables' => $tables
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($table_id)
    {
        $table = Tables::find( $table_id);
        return view('tables.edit', [
            'table' => $table
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTablesRequest $request, $table_id)
    {
        $table = Tables::find( $table_id);
        $table->update([
            "name" => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('tables.index')
            ->with('Exitoso', 'Mesa fue actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($table_id)
    {
        $table = Tables::find( $table_id);
        $table->delete();

        return redirect()
            ->route('tables.index')
            ->with('Exitoso', 'Mesa fue eliminada!');
    }
}
