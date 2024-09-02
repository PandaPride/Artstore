<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
            $supplier = Supplier::where('name', 'like', '%' . $query . '%')
                                ->orderBy($sort, $order)
                                ->paginate($page);
        } else if ($order) {
            $supplier = Supplier::orderBy($sort, $order)->paginate($page);
        } else {
            $supplier = Supplier::paginate($page);
        }
        return response()->json($supplier);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'contact' => 'required|numeric'
        ]);

        Supplier::create($validatedData);
        return response()->json([
            'message' => 'Supplier Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'contact' => 'required|numeric'
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);
        return response()->json([
            'message' => 'Supplier Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json([
            'message' => 'Supplier Deleted Successfully'
        ], 200);
    }
}
