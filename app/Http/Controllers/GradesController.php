<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradesRequest;
use App\Http\Requests\UpdateGradesRequest;
use App\Models\Grades;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grades::select(['id', 'name'])
            ->get();

        return view('grades.index', [
            'grades' => $grades,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradesRequest $request)
    {
        Grades::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('grades.index')
            ->with('Exitoso', 'Grado ha sido creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grades $grades)
    {
        return view('grades.show', [
            'grades' => $grades
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($grades_id)
    {
        $grade = Grades::find( $grades_id);
        return view('grades.edit', [
            'grade' => $grade
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradesRequest $request,  $grades_id)
    {
        $grade = Grades::find( $grades_id);
        $grade->update([
            "name" => $request->name,
            'code' => $request->code,
        ]);

        return redirect()
            ->route('grades.index')
            ->with('Exitoso', 'Grado fue actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($grades_id)
    {
        $grade = Grades::find( $grades_id);
        $grade->delete();

        return redirect()
            ->route('grades.index')
            ->with('Exitoso', 'Grado fue eliminada!');
    }
}
