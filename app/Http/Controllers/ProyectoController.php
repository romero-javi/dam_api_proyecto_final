<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\MateriaPrima;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    public function selectProyectos() {
        $proyectos = Proyecto::all();

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

        if(count($gastos_del_proyecto) !== 0) {
            return response()->json([
                'code' => 200,
                'data' => $gastos_del_proyecto
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'data' => 'Este proyecto no tiene gastos asignads'
        ], 404);
    }   

    public function assignMateriasPrimas(Request $request, $id)
    {
        $validacion = Validator::make($request->all(), [
            'id_materias_primas' => 'required|array',
            'id_materias_primas.*' => 'exists:materia_prima,id_materia_prima',
            'fecha_asignacion' => 'required|date'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404); 
        }
        
        // $proyecto->materias_primas()->attach($request->id_materias_primas, ['fecha_asignacion' => $request->fecha_asignacion]);
        $proyecto->materias_primas()->syncWithPivotValues($request->id_materias_primas, ['fecha_asignacion' => $request->fecha_asignacion]);

        return response()->json([
            'code' => 200,
            'message' => 'Materias primas asignadas con exito al proyecto'
        ], 200);    
    }

    public function deleteMateriaPrimaAsociada($proyecto_id, $materia_prima_id)
    {
        $proyecto = Proyecto::find($proyecto_id);

        if (!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404); 
        }

        $materia_prima = MateriaPrima::find($materia_prima_id);

        if (!$materia_prima) {
            return response()->json([
                'code' => 404,
                'data' => 'Materia prima no encontrada'
            ], 404); 
        }
        
        $result = $proyecto->materias_primas()->detach($materia_prima_id);

        return response()->json([
            'result' => $result
        ]);    
    }

    public function getMateriasPrimas($id) {
        $proyecto = Proyecto::find($id);

        if(!$proyecto) {
            return response()->json([
                'code' => 404,
                'data' => 'Proyecto no encontrado'
            ], 404);
        }

        $materias_primas_del_proyecto = $proyecto->materias_primas;

        if(count($materias_primas_del_proyecto) !== 0) {
            return response()->json([
                'code' => 200,
                'data' => $materias_primas_del_proyecto
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'data' => 'Este proyecto no tiene materias primas asignadas'
        ], 404);
    }   
}
