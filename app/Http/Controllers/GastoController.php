<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GastoController extends Controller
{
    public function selectGastos() {
        $proyectos = Gasto::all();

        if($proyectos->count() == 0) {
            return response()->json([
                'code' => 404,
                'data' => 'No existen gastos'
            ], 404);
        } 

        return response() -> json([
            'code' => 200,
            'data' => $proyectos
        ], 200);
    }

    public function findGasto($id) {
        $gasto = Gasto::find($id);

        if(!$gasto) {
            return response()->json([
                'code' => 404,
                'data' => 'Gasto no encontrado'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $gasto
        ], 200);
    }

    public function addGasto(Request $request) {
        $validacion = Validator::make($request->all(), [
            'monto' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'tipo_gasto' => 'required|string|max:255',
            'id_proyecto' => 'required|exists:proyecto,id_proyecto'
        ]);

        if(!$validacion->fails()) {
            $cliente = Gasto::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Gasto agregado"
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
        ], 400);
    }

    public function getProyecto($id) {
        $gasto = Gasto::find($id);

        if(!$gasto) {
            return response()->json([
                'code' => 404,
                'data' => 'Gasto no encontrado'
            ], 404);
        }

        $proyecto_del_gasto = $gasto->proyecto;

        return response()->json([
            'code' => 200,
            'data' => $proyecto_del_gasto
        ], 200);
    }

    public function updateGasto(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'monto' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'tipo_gasto' => 'required|string|max:255',
            'id_proyecto' => 'required|exists:proyecto,id_proyecto'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $proyecto = Gasto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => "Gasto no encontrado"
            ], 404);
        }
        
        $proyecto->update([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'tipo_gasto' => $request->tipo_gasto,
            'id_proyecto' => $request->id_proyecto,
        ]);

        return response()->json([
            'code' => 200,
            'data' => "Gasto actualizado"
        ], 200);
    }

    public function deleteGasto($id) {
        $gasto =  Gasto::find($id);

        if(!$gasto) {
            return response()->json([
                'code' => 404,
                'data' => 'Gasto no encontrado'
            ], 404);
        }
        
        $gasto->delete();

        return response()->json([
            'code' => 200,
            'data' => 'Gasto eliminado'
        ], 200);
    }
}
