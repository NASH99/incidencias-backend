<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Usuario::orderBy('idUsuario')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = Usuario::create($request->all());
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idUsuario)
    {
        $usuario = Usuario::findOrFail($idUsuario);
        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario=Usuario::findOrFail($id);
        $usuario->nombreUsuario=$request->nombreUsuario;
        $usuario->nombre=$request->nombre;
        $usuario->apellido=$request->apellido;
        $usuario->correo=$request->correo;
        $usuario->clave=$request->clave;
        $usuario->fono=$request->fono;
        $usuario->idCargo=$request->idCargo;
        $usuario->idDepartamento=$request->idDepartamento;
        $usuario->save();
        return response()->json($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUsuario)
    {
        $usuario = Usuario::findOrFail($idUsuario);
        $usuario->delete();
        return response()->json($usuario);
    }
}
