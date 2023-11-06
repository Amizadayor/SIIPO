<?php

namespace App\Http\Controllers;

use App\Models\DatosGeneralesPA;
use App\Models\UnidadEconomicaPA;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class DatosGeneralesPAController extends Controller
{
    /**
     * Función para obtener los datos generales de una unidad economica
     */
    public function index()
    {
        try{
            $datogeneralespa = DatosGeneralesPA::all();
            $result = $datogeneralespa->map(function($item){
                $tipoPersona = $item->TipoPersona == 1 ? 'Física' : 'Moral';
                return [
                    'id' => $item->id,
                    'TipoPersona' => $tipoPersona,
                    'CURP' => $item->CURP,
                    'RFC' => $item->RFC,
                    'Nombres' => $item->Nombres,
                    'ApPaterno' => $item->ApPaterno,
                    'ApMaterno' => $item->ApMaterno,
                    'FechaNacimiento' => $item->FechaNacimiento,
                    'Sexo' => $item->Sexo,
                    'GrupoSanguineo' => $item->GrupoSanguineo,
                    'Email' => $item->Email,
                    'UEPAid' => $item->unidadEconomicaPA->RNPA,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
            return ApiResponse::success('Lista de datos generales', 200, $result);
        }  catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de datos generales: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para crear un nuevo dato general
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'TipoPersona' => 'required|boolean',
                'CURP' => 'required|string|nullable|max:18|unique:datosgenerales_pa,CURP,NULL,id,TipoPersona,1',
                'RFC' => 'required|string|nullable|max:13',
                'Nombres' => 'required|string|nullable|max:50',
                'ApPaterno' => 'required|string|nullable|max:50',
                'ApMaterno' => 'required|string|nullable|max:50',
                'FechaNacimiento' => 'required|nullable|date',
                'Sexo' => 'required|in:M,F|nullable|max:1',
                'GrupoSanguineo' => 'required|string|nullable|max:3',
                'Email' => 'required|email|nullable|max:50',
                'UEPAid' => 'required|exists:unidadeconomica_pa,id'
            ]);

            $datogeneralpa = DatosGeneralesPA::create($request->all());
            return ApiResponse::success('Dato general creado exitosamente', 201, $datogeneralpa);
        } catch (ValidationException $e) {
            if ($e->errors()['CURP']) {
                return ApiResponse::error('La CURP ya existe para un usuario de tipo persona física.', 422);
            }
            return ApiResponse::error('Error de validación: ' . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error('Error al crear el dato general: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para obtener un dato general por id
     */
    public function show($id)
    {
        try{
            $datogeneralpa = DatosGeneralesPA::findOrFail($id);
            $tipoPersona = $datogeneralpa->TipoPersona == 1 ? 'Física' : 'Moral';
            $result = [
                'id' => $datogeneralpa->id,
                'TipoPersona' => $tipoPersona,
                'CURP' => $datogeneralpa->CURP,
                'RFC' => $datogeneralpa->RFC,
                'Nombres' => $datogeneralpa->Nombres,
                'ApPaterno' => $datogeneralpa->ApPaterno,
                'ApMaterno' => $datogeneralpa->ApMaterno,
                'FechaNacimiento' => $datogeneralpa->FechaNacimiento,
                'Sexo' => $datogeneralpa->Sexo,
                'GrupoSanguineo' => $datogeneralpa->GrupoSanguineo,
                'Email' => $datogeneralpa->Email,
                'UEPAid' => $datogeneralpa->unidadEconomicaPA->RNPA,
                'created_at' => $datogeneralpa->created_at,
                'updated_at' => $datogeneralpa->updated_at,
            ];
            return ApiResponse::success('Dato general obtenido exitosamente', 200, $result);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Dato general no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener el dato general: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para actualizar un dato general por id
     */
    public function update(Request $request, $id)
    {
        try {
            $datogeneralpa = DatosGeneralesPA::findOrFail($id);
            $request->validate([
                'TipoPersona' => 'required|boolean',
                'CURP' => 'required|string|nullable|max:18',
                'RFC' => 'required|string|nullable|max:13',
                'Nombres' => 'required|string|nullable|max:50',
                'ApPaterno' => 'required|string|nullable|max:30',
                'ApMaterno' => 'required|string|nullable|max:30',
                'FechaNacimiento' => 'required|date|nullable',
                'Sexo' => 'required|in:M,F|nullable',
                'GrupoSanguineo' => 'required|string|nullable|max:4',
                'Email' => 'required|string|nullable|max:40',
                'UEPAid' => 'required|integer'
            ]);

            $datogeneralpa->update($request->all());
            return ApiResponse::success('Dato general actualizado exitosamente', 200, $datogeneralpa);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Dato general no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error al actualizar el dato general: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Función para eliminar un dato general por id
     */
    public function destroy(DatosGeneralesPA $datosGeneralesPA)
    {
        try {
            $datosGeneralesPA->delete();
            return ApiResponse::success('Dato general eliminado exitosamente', 200);
        } catch (Exception $e) {
            return ApiResponse::error('Error al eliminar el dato general: ' . $e->getMessage(), 500);
        }
    }
}
