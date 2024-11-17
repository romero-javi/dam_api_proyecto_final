<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use Illuminate\Http\Request;

class MaquinariaController extends Controller
{
    // Mostrar todas las maquinarias
    public function index()
    {
        $maquinarias = Maquinaria::all();
        return response()->json($maquinarias);
    }

    // Crear una nueva maquinaria
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'fecha_ultimo_mantenimiento' => 'required|date',
            'costo_diario' => 'required|numeric',
            'especializacion' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'ID_Proyecto' => 'required|exists:proyectos,id', // Asegúrate de que el ID de proyecto exista
        ]);

        // Crear la nueva maquinaria
        $maquinaria = Maquinaria::create($request->all());

        return response()->json($maquinaria, 201); // Devuelve la maquinaria creada con código 201
    }

    // Mostrar una maquinaria específica
    public function show($id)
    {
        $maquinaria = Maquinaria::findOrFail($id); // Buscar maquinaria por ID
        return response()->json($maquinaria);
    }

    // Actualizar una maquinaria existente
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|max:255',
            'fecha_ultimo_mantenimiento' => 'sometimes|date',
            'costo_diario' => 'sometimes|numeric',
            'especializacion' => 'sometimes|string|max:255',
            'fecha_registro' => 'sometimes|date',
            'ID_Proyecto' => 'sometimes|exists:proyectos,id', // Asegúrate de que el ID de proyecto exista
        ]);

        // Buscar la maquinaria
        $maquinaria = Maquinaria::findOrFail($id);

        // Actualizar la maquinaria
        $maquinaria->update($request->all());

        return response()->json($maquinaria);
    }

    // Eliminar una maquinaria
    public function destroy($id)
    {
        // Buscar y eliminar la maquinaria
        $maquinaria = Maquinaria::findOrFail($id);
        $maquinaria->delete();

        return response()->json(['message' => 'Maquinaria eliminada con éxito']);
    }
}
