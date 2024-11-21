<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MateriaPrimaController extends Controller
{
    public function selectMateriasPrimas() {
        $materias_primas = MateriaPrima::all();

        if($materias_primas->count() == 0) {
            return response()->json([
                'code' => 404,
                'data' => 'No existen materias primas'
            ], 404);
        } 

        return response() -> json([
            'code' => 200,
            'data' => $materias_primas
        ], 200);
    }

    public function findMateriaPrima($id) {
        $materia_prima = MateriaPrima::find($id);

        if(!$materia_prima) {
            return response()->json([
                'code' => 404,
                'data' => 'Materia prima no encontrada'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $materia_prima
        ], 200);
    }

    public function addMateriaPrima(Request $request) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'costo' => 'required|numeric',
            // 'id_proyecto' => 'required|exists:proyecto,id_proyecto'
        ]);

        if(!$validacion->fails()) {
            $materia_prima = MateriaPrima::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Materia prima agregada"
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
        ], 400);
    }

    public function getProyecto($id) {
        $materia_prima = MateriaPrima::find($id);

        if(!$materia_prima) {
            return response()->json([
                'code' => 404,
                'data' => 'Materia prima no encontrada'
            ], 404);
        }

        $proyecto_de_la_materia_prima = $materia_prima->proyectos;

        if(count($proyecto_de_la_materia_prima) !== 0) {
            return response()->json([
                'code' => 200,
                'data' => $proyecto_de_la_materia_prima
            ], 200);
        }
        
        return response()->json([
            'code' => 404,
            'data' => 'Esta materia prima no se encuentra asignada'
        ], 404);
    }

    public function updateMateriaPrima(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'costo' => 'required|numeric',
            // 'id_proyecto' => 'required|exists:proyecto,id_proyecto'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $materia_prima = MateriaPrima::find($id);

        if(!$materia_prima) {
            return response()->json([
                'code' => 404,
                'data' => "Materia prima no encontrada"
            ], 404);
        }
        
        $materia_prima->update([
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
            'costo' => $request->costo,
            // 'id_proyecto' => $request->id_proyecto,
        ]);

        return response()->json([
            'code' => 200,
            'data' => "Materia prima actualizada"
        ], 200);
    }

    public function deleteMateriaPrima($id) {
        $materia_prima =  MateriaPrima::find($id);

        if(!$materia_prima) {
            return response()->json([
                'code' => 404,
                'data' => 'Materia prima no encontrada'
            ], 404);
        }
        
        $materia_prima->delete();

        return response()->json([
            'code' => 200,
            'data' => 'Materia prima eliminado'
        ], 200);
    }
}
