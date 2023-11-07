<?php

use App\Http\Controllers\RolController;
use App\Http\Controllers\PrivilegioController;
use App\Http\Controllers\AsignacionPermisoController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\UnidadEconomicaPAController;
use App\Http\Controllers\DatosGeneralesPAController;
use App\Http\Controllers\PermisoPescaController;
use App\Http\Controllers\ArtePescaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    //return $request->user();
//});

//Ruta: http://siipo.test/api/nombre_ruta

Route::apiResource('roles', RolController::class);
Route::apiResource('privilegios', PrivilegioController::class);
Route::apiResource('asignacion_permisos', AsignacionPermisoController::class);
Route::apiResource('regiones', RegionController::class);
Route::apiResource('distritos', DistritoController::class);
Route::apiResource('municipios', MunicipioController::class);
Route::apiResource('localidades', LocalidadController::class);
Route::apiResource('oficinas', OficinaController::class);
Route::apiResource('unidadeconomica_pa', UnidadEconomicaPAController::class);
Route::apiResource('datosgenerales_pa', DatosGeneralesPAController::class);
Route::apiResource('permisos_pesca', PermisoPescaController::class);
Route::apiResource('artes_pesca', ArtePescaController::class);
