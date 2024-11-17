<?php

namespace App\Http\Controllers;

use App\Models\RecursoHumano;
use Illuminate\Http\Request;

class RecursoHumanoController extends Controller
{
    // Mostrar todos los recursos
    public function index()
    {
        // Obtener todos los recursos de la base de datos
        $recursos = RecursoHumano::all();
        return response()->json($recursos);
    }

    // Crear un nuevo recurso
    public function store(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'especializacion' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
        ]);

        // Crear el recurso en la base de datos
        $recurso = RecursoHumano::create($request->all());

        // Retornar una respuesta con el recurso creado
        return response()->json($recurso, 201); // 201 es el código de respuesta para "creado"
    }

    // Mostrar un recurso específico
    public function show($id)
    {
        // Buscar el recurso por su ID
        $recurso = RecursoHumano::findOrFail($id);
        
        // Retornar una respuesta con los datos del recurso
        return response()->json($recurso);
    }

    // Actualizar un recurso
    public function update(Request $request, $id)
    {
        // Validar los datos del request
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'rol' => 'sometimes|string|max:255',
            'especializacion' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|max:255',
            'fecha_registro' => 'sometimes|date',
        ]);

        // Buscar el recurso en la base de datos
        $recurso = RecursoHumano::findOrFail($id);

        // Actualizar el recurso con los datos proporcionados
        $recurso->update($request->all());

        // Retornar una respuesta con el recurso actualizado
        return response()->json($recurso);
    }

    // Eliminar un recurso
    public function destroy($id)
    {
        // Buscar el recurso en la base de datos
        $recurso = RecursoHumano::findOrFail($id);
        
        // Eliminar el recurso
        $recurso->delete();

        // Retornar una respuesta de éxito
        return response()->json(['message' => 'Recurso eliminado con éxito']);
    }
}
