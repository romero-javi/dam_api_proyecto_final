<?php

namespace App\Http\Controllers;

use App\Models\RecursoHumano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecursoHumanoController extends Controller
{
    public function selectRecursosHumanos() {
        $recursos_humanos = RecursoHumano::all();

        if($recursos_humanos->count() == 0) {
            return response()->json([
                'code' => 404,
                'data' => 'No existen recursos humanos'
            ], 404);
        } 

        return response() -> json([
            'code' => 200,
            'data' => $recursos_humanos
        ], 200);
    }

    public function findRecursoHumano($id) {
        $recurso_humano = RecursoHumano::find($id);

        if(!$recurso_humano) {
            return response()->json([
                'code' => 404,
                'data' => 'Recurso Humano no encontrado'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $recurso_humano
        ], 200);
    }

    public function addRecursoHumano(Request $request) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'especializacion' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'estado' => 'in:Activo,Inactivo'
        ]);

        if(!$validacion->fails()) {
            $recurso_humano = RecursoHumano::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Recurso Humano agregado"
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
        ], 400);
    }

    public function updateRecursoHumano(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'especializacion' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'estado' => 'in:Activo,Inactivo'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $recurso_humano = RecursoHumano::find($id);

        if(!$recurso_humano) {
            return response()->json([
                'code' => 404,
                'data' => 'Recurso Humano no encontrado'
            ], 404);
        }

        $recurso_humano->update([
            'nombre' => $request->nombre,
            'rol' => $request->rol,
            'especializacion' => $request->especializacion,
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado' => $request->estado
        ]);
        return response()->json([
            'code' => 200,
            'data' => 'Recurso Humano actualizado'
        ], 200);

    }

    public function deleteRecursoHumano($id) {
        $recurso_humano =  RecursoHumano::find($id);

        if(!$recurso_humano) {
            return response()->json([
                'code' => 404,
                'data' => 'Recurso Humano no encontrado'
            ], 404);
        }
        
        $recurso_humano->delete();

        return response()->json([
            'code' => 200,
            'data' => 'Recurso Humano eliminado'
        ], 200);
    }
}
