<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where("user_id", auth()->id())->count();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            "user_id"  =>auth()->id(),
            "name"     => $request->name,
            "code"     => $request->code,
            "quantity" => $request->quantity,
            "slug"     => Str::slug($request->name)
        ]);

        return redirect()
            ->route('categories.index')
            ->with('Exitoso', 'Tipo de Empaque ha sido created!');
    }

    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            "name"     => $request->name,
            "code"     => $request->code,
            "quantity" => $request->quantity,
            "slug"     => Str::slug($request->name)
        ]);

        return redirect()
            ->route('categories.index')
            ->with('Exitoso', 'Tipo de Empaque ha sido updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('Exitoso', 'Tipo de Empaque ha sido deleted!');
    }
}
