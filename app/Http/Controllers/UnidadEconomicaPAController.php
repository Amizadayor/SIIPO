<?php

namespace App\Http\Controllers;

use App\Models\UnidadEconomicaPA;
use App\Models\Oficina;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UnidadEconomicaPAController extends Controller
{
    /**
     * Función que obtener todos las unidades economicas.
     */
    public function index()
    {
        try {
            $unidadeconomica_pa = UnidadEconomicaPA::all();
            $result = $unidadeconomica_pa->map(function ($item) {
                return [
                    'id' => $item->id,
                    'Ofcid' => $item->oficina->NombreOficina,
                    'FechaRegistro' => $item->FechaRegistro,
                    'RNPA' => $item->RNPA,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
            return ApiResponse::success('Lista de unidades economicas', 200, $result);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de unidades economicas: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para crear una nueva unidad economica
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'Ofcid' => 'required|exists:oficinas,id',
                'FechaRegistro' => 'required|date',
                'RNPA' => 'required|string|max:50'
                //'RNPA' => 'required|string|max:50|unique:unidadeconomica_pa,RNPA,NULL,id,Ofcid,' . $request->input('Ofcid'),
            ]);

            $existeUnidadEconomica = UnidadEconomicaPA::where('Ofcid', $request->Ofcid)
                ->where('FechaRegistro', $request->FechaRegistro)
                ->where('RNPA', $request->RNPA)
                ->first();
            if ($existeUnidadEconomica) {
                return ApiResponse::error('La unidad economica ya existe en esta oficina', 422);
            }

            $unidadEconomicaPA = UnidadEconomicaPA::create($request->all());
            return ApiResponse::success('Unidad economica creada exitosamente', 201, $unidadEconomicaPA);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de validación: ' . $e->getMessage(), 422, $e->errors());
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear la unidad economica: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para obtener una unidad economica por id
     */
    public function show($id)
    {
        try {
            $unidadeconomica_pa = UnidadEconomicaPA::findOrFail($id);
            $result = [
                'id' => $unidadeconomica_pa->id,
                'Ofcid' => $unidadeconomica_pa->oficina->NombreOficina,
                'FechaRegistro' => $unidadeconomica_pa->FechaRegistro,
                'RNPA' => $unidadeconomica_pa->RNPA,
                'created_at' => $unidadeconomica_pa->created_at,
                'updated_at' => $unidadeconomica_pa->updated_at,
            ];
            return ApiResponse::success('Unidad Económica obtenida exitosamente', 200, $result);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Unidad Económica no encontrada', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la Unidad Económica: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para actualizar una unidad economica por id
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'Ofcid' => 'required|exists:oficinas,id',
                'FechaRegistro' => 'required|date',
                'RNPA' => 'required|string|max:50'
                //'RNPA' => 'required|string|max:50|unique:unidadeconomica_pa,RNPA,' . $id . ',id,Ofcid,' . $request->input('Ofcid')
            ]);

            $existeUnidadEconomica = UnidadEconomicaPA::where('Ofcid', $request->Ofcid)
                ->where('FechaRegistro', $request->FechaRegistro)
                ->where('RNPA', $request->RNPA)
                ->first();
            if ($existeUnidadEconomica) {
                return ApiResponse::error('La unidad economica ya existe en esta oficina', 422);
            }

            $unidadEconomicaPA = UnidadEconomicaPA::findOrFail($id);
            $unidadEconomicaPA->update($request->all());
            return ApiResponse::success('Unidad Económica actualizada exitosamente', 200, $unidadEconomicaPA);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Unidad Económica no encontrada', 404);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de validación: ' . $e->getMessage(), 422, $e->errors());
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar la Unidad Económica: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para eliminar una unidad economica por id
     */
    public function destroy($id)
    {
        try {
            $unidadEconomicaPA = UnidadEconomicaPA::findOrFail($id);
            $unidadEconomicaPA->delete();
            return ApiResponse::success('Unidad Económica eliminada exitosamente', 200, $unidadEconomicaPA);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Unidad Económica no encontrada', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar la Unidad Económica: ' . $e->getMessage(), 500);
        }
    }
}
