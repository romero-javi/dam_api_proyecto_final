<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaquinariaController extends Controller
{
    public function selectMaquinarias()
    {
        $maquinarias = Maquinaria::all();

        return response() -> json([
            'code' => 200,
            'data' => $maquinarias
        ], 200);
    }

    public function findMaquinaria($id) {
        $maquinaria = Maquinaria::find($id);

        if(!$maquinaria) {
            return response()->json([
                'code' => 404,
                'data' => 'Maquinaria no encontrada'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $maquinaria
        ], 200);
    }

    public function addMaquinaria(Request $request) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'estado' => 'in:Disponible,En mantenimiento,Asignada',
            'fecha_ultimo_mantenimiento' => 'required|date',
            'fecha_adquisicion' => 'required|date',
            'tipo' => 'required|string|max:255',
            'costo_diario' => 'required|numeric'
        ]);

        if(!$validacion->fails()) {
            $cliente = Maquinaria::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Maquinaria agregada"
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
        ], 400);
    }

    public function updateMaquinaria(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'estado' => 'required|in:Disponible,En mantenimiento,Asignada',
            'fecha_ultimo_mantenimiento' => 'required|date',
            'fecha_adquisicion' => 'required|date',
            'tipo' => 'required|string|max:255',
            'costo_diario' => 'required|numeric'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $maquinaria = Maquinaria::find($id);

        if(!$maquinaria) {
            return response()->json([
                'code' => 404,
                'data' => 'Maquinaria no encontrada'
            ], 404);
        }

        $maquinaria->update([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
            'fecha_ingreso' => $request->fecha_ingreso
        ]);
        return response()->json([
            'code' => 200,
            'data' => 'Maquinaria actualizada'
        ], 200);

    }

    public function deleteMaquinaria($id) {
        $maquinaria =  Maquinaria::find($id);

        if(!$maquinaria) {
            return response()->json([
                'code' => 404,
                'data' => 'Maquinaria no encontrada'
            ], 404);
        }
        
        $maquinaria->delete();

        return response()->json([
            'code' => 200,
            'data' => 'Maquinaria eliminada'
        ], 200);
    }
}
