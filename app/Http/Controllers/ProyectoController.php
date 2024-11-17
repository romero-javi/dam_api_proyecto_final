<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    public function selectProyectos() {
        $proyectos = Proyecto::all();

        if($proyectos->count() == 0) {
            return response()->json([
                'code' => 404,
                'data' => 'No existen proyectos'
            ], 404);
        } 

        return response() -> json([
            'code' => 200,
            'data' => $proyectos
        ], 200);
    }

    public function findProyecto($id) {
        $proyecto = Proyecto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $proyecto
        ], 200);
    }

    public function addProyecto(Request $request) {
        $validacion = Validator::make($request->all(), [
            'ubicacion' => 'required|string|max:255',
            'estado' => 'in:Activo,Inactivo',
            'porcentaje_avance' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'inversion_inicial' => 'required|numeric',
            'inversion_final' => 'required|numeric',
            'costo_diario' => 'required|numeric',
            'tipo_proyecto' => 'required|string|max:255',
            'imagen_url' => 'required|string|max:255',
            'inconvenientes' => 'required|string|max:255',
            'id_cliente' => 'required|exists:cliente,id_cliente'
        ]);

        if(!$validacion->fails()) {
            $cliente = Proyecto::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Proyecto agregado"
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
        ], 400);
    }

    public function getCliente($id) {
        $proyecto = Proyecto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404);
        }

        $cliente = $proyecto->cliente;

        return response()->json([
            'code' => 200,
            'data' => $cliente
        ], 200);
    }

    public function updateProyecto(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
            'porcentaje_avance' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'inversion_inicial' => 'required|numeric',
            'inversion_final' => 'required|numeric',
            'costo_diario' => 'required|numeric',
            'tipo_proyecto' => 'required|string|max:255',
            'imagen_url' => 'required|string|max:255',
            'inconvenientes' => 'required|string|max:255',
            'id_cliente' => 'required|exists:cliente,id_cliente'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $proyecto = Proyecto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => "Proyecto no encontrado"
            ], 404);
        }
        
        $proyecto->update([
            'ubicacion' => $request->ubicacion,
            'estado' => $request->estado,
            'porcentaje_avance' => $request->porcentaje_avance,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'inversion_inicial' => $request->inversion_inicial,
            'inversion_final' => $request->inversion_final,
            'costo_diario' => $request->costo_diario,
            'tipo_proyecto' => $request->tipo_proyecto,
            'imagen_url' => $request->imagen_url,
            'inconvenientes' => $request->inconvenientes,
            'id_cliente' => $request->id_cliente
        ]);

        return response()->json([
            'code' => 200,
            'data' => "Proyecto actualizado"
        ], 200);
    }

    public function deleteProyecto($id) {
        $proyecto =  Proyecto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404);
        }
        
        $proyecto->delete();

        return response()->json([
            'code' => 200,
            'data' => 'Proyecto eliminado'
        ], 200);
    }

    public function getGastos($id) {
        $proyecto = Proyecto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404);
        }

        $gastos_del_proyecto = $proyecto->gastos;

        return response()->json([
            'code' => 200,
            'data' => $gastos_del_proyecto
        ], 200);
    }
}
