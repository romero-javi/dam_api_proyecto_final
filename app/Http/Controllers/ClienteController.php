<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function selectClientes() {
        $clientes = Cliente::all();

        return response() -> json([
            'code' => 200,
            'data' => $clientes
        ], 200);
    }

    public function findCliente($id) {
        $cliente = Cliente::find($id);

        if(!$cliente) {
            return response()->json([
                'code' => 404,
                'data' => 'Cliente no encontrado'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $cliente
        ], 200);
    }

    public function addCliente(Request $request) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'in:Activo,Inactivo',
            'fecha_registro' => 'required|date'
        ]);

        if(!$validacion->fails()) {
            $cliente = Cliente::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Cliente agregado"
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => $validacion->messages()
        ], 400);
    }

    public function updateCliente(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_registro' => 'required|date'
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $cliente = Cliente::find($id);

        if(!$cliente) {
            return response()->json([
                'code' => 404,
                'data' => 'Cliente no encontrado'
            ], 404);
        }

        $cliente->update([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
            'fecha_ingreso' => $request->fecha_ingreso
        ]);
        return response()->json([
            'code' => 200,
            'data' => 'Cliente actualizado'
        ], 200);

    }

    public function deleteCliente($id) {
        $cliente =  Cliente::find($id);

        if(!$cliente) {
            return response()->json([
                'code' => 404,
                'data' => 'Cliente no encontrado'
            ], 404);
        }
        
        $cliente->delete();

        return response()->json([
            'code' => 200,
            'data' => 'Cliente eliminado'
        ], 200);
    }
}
