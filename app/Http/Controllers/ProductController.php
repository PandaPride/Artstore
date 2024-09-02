<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
            $product = Product::where('name', 'like', '%' . $query . '%')
                            ->orderBy($sort, $order)
                            ->paginate($page);
        } else if ($order) {
            $product = Product::orderBy($sort, $order)->paginate($page);
        } else {
            $product = Product::paginate($page);
        }
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id'
        ]);
        
        Product::create($validatedData);
        return response()->json([
            'message' => 'Product Created Succesfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'numeric|required',
            'stock' => 'numeric|required',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id' 
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json([
            'message' => 'Product Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'message' => 'Product Deleted Successfully'
        ], 200);
    }
}
