<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\AuthenticationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('cargos',CargoController::class);
Route::resource('departamentos',DepartamentoController::class);
Route::resource('trabajos',TrabajoController::class);
Route::resource('usuarios',UsuarioController::class);
Route::resource('detalles',DetalleController::class);
Route::post('incidencias',[IncidenciaController::class,'store']);
Route::get('incidencias',[IncidenciaController::class,'index']);
Route::post('login',[AuthenticationController::class,'login']);
Route::get('incidencias/mis-incidencias-creadas/{idUsuario}',[IncidenciaController::class,'obtenerMisIncidenciasCreadas']);
Route::get('incidencias/incidencias-no-asignadas/{idDepartamento}',[IncidenciaController::class,'obtenerIncidenciasNoAsignadas']);
Route::get('usuarios/obtener-tecnicos-por-departamento/{idDepartamento}', [UsuarioController::class, 'obtenerTecnicosPorDepartamento']);
Route::put('incidencias/asignar-tecnico', [IncidenciaController::class, 'asignarTecnico']);
