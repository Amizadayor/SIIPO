<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class EspecieController extends Controller
{
    /**
     * Función para mostrar la lista de especies.
     */
    public function index()
    {
        try {
            $especies = Especie::all();
            $result = $especies->map(function($item){
                return [
                    'id' => $item->id,
                    'NombreEspecie' => $item->NombreEspecie,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
            return ApiResponse::success('Lista de especies', 200, $result);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de especies: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para crear un nueva especie.
     */
    public function store(Request $request)
    {
        try {
            $request-> validate([
                'NombreEspecie' => 'required|string|max:50|unique:especies,NombreEspecie',
            ]);

            $especie = Especie::create($request->all());
            return ApiResponse::success('Especie creada exitosamente', 201, $especie);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error, la especie ya existe: ' . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear la especie: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para mostrar una especie por su id
     */
    public function show($id)
    {
        try {
            $especies = Especie::findOrFail($id);
            $result = [
                'id' => $especies->id,
                'NombreEspecie' => $especies->NombreEspecie,
                'created_at' => $especies->created_at,
                'updated_at' => $especies->updated_at,
            ];
            return ApiResponse::success('Especie obtenida exitosamente', 200, $result);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Especie no encontrada', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la especie: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para actualizar una especie por su id.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'NombreEspecie' => 'required|string|max:50|unique:especies,NombreEspecie,' . $id,
            ]);

            $especie = Especie::findOrFail($id);
            $especie->update($request->all());
            return ApiResponse::success('Especie actualizada exitosamente', 200, $especie);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Especie no encontrada', 404);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error, la especie ya existe: ' . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar la especie: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para eliminar una especie por su id.
     */
    public function destroy($id)
    {
        try {
            $especie = Especie::findOrFail($id);
            $especie->delete();
            return ApiResponse::success('Especie eliminada exitosamente', 200, $especie);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Especie no encontrada', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar la especie: ' . $e->getMessage(), 500);
        }
    }
}
