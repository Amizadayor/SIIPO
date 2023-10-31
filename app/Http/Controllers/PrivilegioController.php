<?php

namespace App\Http\Controllers;

use App\Models\Privilegio;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class PrivilegioController extends Controller
{
    /**
     * Función que obtiene la lista de los privilegios.
     */
    public function index()
    {
        try {
            $privilegios = Privilegio::all();
            return ApiResponse::success('Lista de los permisos', 200, $privilegios);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de permisos: ' . $e->getMessage(), 500);
        }
    }

    /**
     * función que crea un nuevo privilegio.S
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NombrePermiso' => 'required|string|unique:privilegios',
            ]);
            $privilegio = Privilegio::create($request->all());
            return ApiResponse::success('Permiso creado exitosamente', 201, $privilegio);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de validacion: ' . $e->getMessage(), 422);
        }
    }

    /**
     * Función que obtiene un privilegio por su id.
     */
    public function show($id)
    {
        try {
            $privilegio = Privilegio::findOrFail($id);
            return ApiResponse::success('Permiso obtenido exitosamente', 200, $privilegio);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Permiso no encontrado', 404);
        }
    }

    /**
     * Función que actualiza un privilegio por su id.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'NombrePermiso' => 'required|string|unique:privilegios',
            ]);
            $privilegio = Privilegio::findOrFail($id);
            $privilegio->update($request->all());
            return ApiResponse::success('Permiso actualizado exitosamente', 200, $privilegio);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Permiso no encontrado', 404);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de validacion: ' . $e->getMessage(), 422);
        }
    }

    /**
     * Función que elimina un privilegio por su id.
     */
    public function destroy($id)
    {
        try {
            $privilegio = Privilegio::findOrFail($id);
            $privilegio->delete();
            return ApiResponse::success('Permiso eliminado exitosamente', 200, $privilegio);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Permiso no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 422);
        }
    }
}
