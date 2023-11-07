<?php

namespace App\Http\Controllers;

use App\Models\PermisoPesca;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class PermisoPescaController extends Controller
{
    /**
     * Función que obtiene la lista de los permisos de pesca.
     */
    public function index()
    {
        try{
            $permisospesca = PermisoPesca::all();
            $result = $permisospesca->map(function($item){
                return [
                    'id' => $item->id,
                    'NombrePermiso' => $item->NombrePermiso,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
            return ApiResponse::success('Lista de permisos de pesca', 200, $result);
        }   catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de permisos de pesca: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función que crea un nuevo permiso de pesca.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NombrePermiso' => 'required|string|max:50|unique:permisos_pesca,NombrePermiso',
            ]);

            $permisopesca = PermisoPesca::create($request->all());
            return ApiResponse::success('Permiso de pesca creado exitosamente', 201, $permisopesca);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error, el permiso ya existe: ' . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear el permiso de pesca: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para mostrar un permiso de pesca por su id
     */
    public function show($id)
    {
        try {
            $permisopesca = PermisoPesca::findOrFail($id);
            $result = [
                'id' => $permisopesca->id,
                'NombrePermiso' => $permisopesca->NombrePermiso,
                'created_at' => $permisopesca->created_at,
                'updated_at' => $permisopesca->updated_at,
            ];
            return ApiResponse::success('Permiso de pesca encontrado', 200, $result);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Permiso de pesca no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener el permiso de pesca: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función que actualiza un permiso de pesca.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'NombrePermiso' => 'required|string|max:50|unique:permisos_pesca,NombrePermiso,' . $id,
            ]);

            $permisopesca = PermisoPesca::findOrFail($id);
            $permisopesca->update($request->all());
            return ApiResponse::success('Permiso de pesca actualizado exitosamente', 200, $permisopesca);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error, el permiso ya existe ' . $e->getMessage(), 422);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Permiso de pesca no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar el permiso de pesca: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para borrar un permiso de pesca.
     */
    public function destroy($id)
    {
        try {
            $permisopesca = PermisoPesca::findOrFail($id);
            $permisopesca->delete();
            return ApiResponse::success('Permiso de pesca eliminado exitosamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Permiso de pesca no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar el permiso de pesca: ' . $e->getMessage(), 500);
        }
    }
}
