<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeBranchesRequest;
use App\Http\Requests\UpdateTypeBranchesRequest;
use App\Models\TypeBranches;

class TypeBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeBranches = TypeBranches::select(['id', 'name'])
            ->get();

        return view('typeBranches.index', [
            'typeBranches' => $typeBranches,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('typeBranches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeBranchesRequest $request)
    {
        TypeBranches::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('typeBranches.index')
            ->with('success', 'Tipo de Ramo ha sido creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeBranches $typeBranches)
    {
        return view('typeBranches.show', [
            'typeBranches' => $typeBranches
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($typeBranche_id)
    {
        $typeBranche = TypeBranches::find( $typeBranche_id);
        return view('typeBranches.edit', [
            'typeBranche' => $typeBranche
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeBranchesRequest $request, $typeBranche_id)
    {
        $typeBranche = TypeBranches::find( $typeBranche_id);
        $typeBranche->update([
            "name" => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('typeBranches.index')
            ->with('success', 'Tipo Ramo fue actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($typeBranche_id)
    {
        $typeBranche = TypeBranches::find( $typeBranche_id);
        $typeBranche->delete();

        return redirect()
            ->route('typeBranches.index')
            ->with('success', 'Tipo Ramo fue eliminada!');
    }
}
