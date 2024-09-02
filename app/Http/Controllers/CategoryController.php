<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $page = $request->input('limit', 5);
        $query = $request->input('q');
        $order = $request->input('o');
        $sort = $request->input('s');
        if ($query) {
            $category = Category::where('name', 'like', '%' . $query . '%')
                                ->orderBy($sort, $order)
                                ->paginate($page);
        } else if ($order) {
            $category = Category::orderBy($sort, $order)->paginate($page);
        } else {
            $category = Category::paginate($page);
        }
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        Category::create($validatedData);
        return response()->json([
            'message' => 'Category Created Successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);
        return response()->json([
            'message' => 'Category Updated Succesfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category Deleted Successfully'
        ], 200);
    }
}
