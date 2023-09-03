<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::all();
        return $compras;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'usuario_id' => 'required|integer|exists:users,id',  // Asumiendo que la llave foránea hace referencia a la tabla 'users' y su columna 'id'
            'producto_id' => 'required|integer|exists:products,id',  // Asumiendo que la llave foránea hace referencia a la tabla 'products' y su columna 'id'
            'cantidad' => 'required|integer|min:1'
        ]);

        $validatedData['status'] = true;

        $compra = Compra::create($validatedData);

        return $compra;
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        return $compra;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id); 
    
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'usuario_id' => 'required|integer|exists:users,id',  
            'producto_id' => 'required|integer|exists:products,id',  
            'cantidad' => 'required|integer|min:1'
        ]);
        
        $compra->fill($validatedData);
        $compra->save();

        return $compra;
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->status = false;

        return $compra;
    }
}
