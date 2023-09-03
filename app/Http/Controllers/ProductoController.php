<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return $productos;
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'detalle' => 'required|string|max:255'
        ]);

        $data['status'] = true;

        $producto = Producto::create($data);

        return $producto;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'detalle' => 'required|string|max:255'  
        ]);

        $producto->fill($validatedData);
        $producto->save();

        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->status = false;

        return $producto;
    }
}
