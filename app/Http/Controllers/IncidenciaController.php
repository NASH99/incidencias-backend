<?php

namespace App\Http\Controllers;
use App\Models\Incidencia;
use Carbon\Carbon;

use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function store(Request $request){
        $incidencia = new Incidencia();
        $incidencia->estado=1;
        $incidencia->fecha=Carbon::now()->format('Y-m-d');
        $incidencia->idTrabajo=$request->idTrabajo;
        $incidencia->idSolicitante=$request->idSolicitante;
        $incidencia->comentario=$request->comentario;
        $incidencia->save();
        return response()->json($incidencia);
    }

    public function index(){
        $incidencias=Incidencia::with('trabajo')->get();

        return response()->json($incidencias);
    }

    public function obtenerMisIncidenciasCreadas($idUsuario){
        $incidencias=Incidencia::where('idSolicitante',$idUsuario)->with('trabajo')->orderBy('fecha','desc')->get();
        return response()->json($incidencias);
    }

    public function obtenerIncidenciasNoAsignadas(){
        $incidencias=Incidencia::where('idTecnico',null)->with('trabajo')->orderBy('fecha','asc')->get();
        return response()->json($incidencias);
    }
}

//crear show e index
