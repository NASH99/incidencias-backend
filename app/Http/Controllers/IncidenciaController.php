<?php

namespace App\Http\Controllers;
use App\Models\Incidencia;
use App\Models\Detalle;
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
        $incidencia->estado = 2;
        $incidencia->save();
        return response()->json($incidencia);
    }

    public function obtenerIncidenciasAsignadasTecnico($idTecnico) {
        $incidencias = Incidencia::with(['trabajo.departamento'])->where('idTecnico', $idTecnico)->orderBy('created_at','asc')->get();
        return response()->json($incidencias);
    }

    public function cerrarIncidencia($idIncidencia) {
        $incidencia = Incidencia::findOrFail($idIncidencia);
        $incidencia->estado = 3;
        $incidencia->save();
        return response()->json($incidencia);
    }

    public function agregarDetalle(Request $request) {
        $detalle = Detalle::create($request->all());
        return response()->json($detalle);
    }

    public function show($idIncidencia) {
        $incidencia = Incidencia::with(['detalles', 'trabajo.departamento'])->findOrFail($idIncidencia);
        return response()->json($incidencia);
    }

    public function cambiarEstado(Request $request) {
        $incidencia = Incidencia::findOrFail($request->idIncidencia);
        $incidencia->estado = $request->estado;
        $incidencia->save();
        return response()->json($incidencia);
    }

    public function obtenerIncidenciasDeDepartamentoOtros() {
        $incidencias=Incidencia::with('trabajo')->get();
        $response = [];
        foreach($incidencias as $incidencia) {
            if ($incidencia->trabajo['idDepartamento'] === 7) {
                array_push($response, $incidencia);
            }
        }
        return response()->json($response);
    }

    public function asignarTrabajoAIncidencia(Request $request) {
        $incidencia = Incidencia::findOrFail($request->idIncidencia);
        $incidencia->idTrabajo = $request->idTrabajo;
        $incidencia->save();
        return response()->json($incidencia);
    }
}

//crear show e index
