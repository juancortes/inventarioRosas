<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradesRequest;
use App\Http\Requests\UpdateGradesRequest;
use Illuminate\Support\Facades\Gate;
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

        if (Gate::allows('isAdmin')) {
            return view('grades.index', [
                'grades' => $grades,
            ]);
        } else {
            abort(401);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin'))
        {
            return view('grades.create');
        } else {
            abort(401);
        }
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
        if (Gate::allows('isAdmin'))
        {
            $grade = Grades::find( $grades_id);
            return view('grades.edit', [
                'grade' => $grade
            ]);
        } else {
            abort(401);
        }
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
        if (Gate::allows('isAdmin')) 
        {
            $grade = Grades::find( $grades_id);
            $grade->delete();

            return redirect()
                ->route('grades.index')
                ->with('Exitoso', 'Grado fue eliminada!');
        } else {
            abort(401);
        }
    }
}
