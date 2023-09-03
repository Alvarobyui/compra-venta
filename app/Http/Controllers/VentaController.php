<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::all();
        return $ventas;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'usuario_id' => 'required|integer|exists:users,id', 
            'producto_id' => 'required|integer|exists:products,id',  
            'cantidad' => 'required|integer|min:1'
        ]);

        $validatedData['status'] = true;

        $venta = Venta::create($validatedData);

        return $venta;
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        return $venta;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id); 
    
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'usuario_id' => 'required|integer|exists:users,id',  // Suponiendo que la llave foránea hace referencia a la tabla 'users' y su columna 'id'
            'producto_id' => 'required|integer|exists:products,id',  // Suponiendo que la llave foránea hace referencia a la tabla 'products' y su columna 'id'
            'cantidad' => 'required|integer|min:1'
        ]);
        
        $venta->fill($validatedData);
        $venta->save();

        return $venta;
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->status = false;

        return $venta;
    }
}
