<?php

namespace App\Http\Controllers;

use App\Models\ArtePesca;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class ArtePescaController extends Controller
{
    /**
     * Obtiene la lista de los tipos de artes de pesca.
     */
    public function index()
    {
        try {
            $artespesca = ArtePesca::all();
            return ApiResponse::success('Lista de los tipos de artes de pesca', 200, $artespesca);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de artes de pesca: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Crea un nuevo tipo de arte de pesca.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NombreArtePesca' => 'required|string|unique:artes_pesca'
            ]);

            $artepesca = ArtePesca::create($request->all());
            return ApiResponse::success('Arte de pesca creado exitosamente', 201, $artepesca);
        } catch (ValidationException $e) {
            return ApiResponse::error('El arte de pesca ya existe: ' . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Obtiene un tipo de arte de pesca por su id.
     */
    public function show($id)
    {
        try{
            $artepesca = ArtePesca::findOrFail($id);
            return ApiResponse::success('Arte de pesca obtenido exitosamente', 200, $artepesca);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('Arte de pesca no encontrado',404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Actualiza un tipo de arte de pesca por su id.
     */
    public function update(Request $request, $id)
    {
        try {
            $artepesca = ArtePesca::findOrFail($id);
            $request->validate([
                'NombreArtePesca' => 'required|unique:artes_pesca,NombreArtePesca,' . $id,
            ]);

            $existeArtePesca = ArtePesca::where('NombreArtePesca', $request->NombreArtePesca)->first();
            if ($existeArtePesca) {
                return ApiResponse::error('El arte de pesca ya existe', 422);
            }

            $artepesca->update($request->all());
            return ApiResponse::success('Arte de pesca actualizado exitosamente', 200, $artepesca);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Arte de pesca no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }


    /**
     * función que elimina un tipo de arte de pesca por su id.
     */
    public function destroy($id)
    {
        try {
            $artepesca = ArtePesca::findOrFail($id);
            $artepesca->delete();
            return ApiResponse::success('Arte de pesca eliminado exitosamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Arte de pesca no encontrado',404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }
}
