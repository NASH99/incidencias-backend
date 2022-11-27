<?php

namespace App\Http\Controllers;
use App\Models\Incidencia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

    public function obtenerIncidenciasNoAsignadas($idDepartamento){
        $incidencias=Incidencia::where('idTecnico',null)->with('trabajo')->orderBy('fecha','asc')->get();
        Log::debug($incidencias);
        $response=[];
        foreach($incidencias as $incidencia){
            if($incidencia->trabajo['idDepartamento']==$idDepartamento){
                array_push($response,$incidencia);
            }
        }

        return response()->json($response);
    }

    public function asignarTecnico(Request $request) {
        $incidencia = Incidencia::findOrFail($request->idIncidencia);
        $incidencia->idTecnico = $request->idTecnico;
        $incidencia->save();
        return response()->json($incidencia);
    }
}

//crear show e index
