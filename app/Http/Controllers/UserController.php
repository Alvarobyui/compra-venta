<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return $usuarios;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['status'] = true;

        $usuario = User::create($data);

        return $usuario;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $usuario = User::findOrFail($id);
    return $usuario;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
    
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);
    
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
    
        $usuario->update($data);
    
        return redirect()->route('usuarios.show', ['usuario' => $usuario]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $usuario = User::findOrFail($id);
    $usuario->status = false;

    return redirect()->route('nombre-de-tu-ruta');
    }
}
