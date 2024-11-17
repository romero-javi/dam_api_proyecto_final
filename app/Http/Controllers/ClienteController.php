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

        if($clientes->count() > 0) {
            return response() -> json([
                    'code' => 200,
                    'data' => $clientes
                ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data' => 'No hay registros'
            ], 404);
        }
    }

    public function findCliente($id) {
        $cliente = Cliente::find($id);
        if($cliente) {
            return response()->json([
                'code' => 200,
                'data' => $cliente
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'data' => 'Cliente no encotrado'
        ], 404);
    }

    public function addCliente(Request $request) {
        $validacion = Validator::make($request->all(), [
            'Nombre' => 'required|string|max:255',
            'Contacto' => 'required|string|max:255',
            'Direccion' => 'required|string|max:255',
            'Estado' => 'required',
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $cliente = Cliente::create($request->all());

            return response()->json([
                'code' => 200,
                'data' => "Cliente agregado"
            ], 200);
        }
    }

    public function updateCliente(Request $request, $id) {
        $validacion = Validator::make($request->all(), [
            'Nombre' => 'required',
            'Contacto' => 'required',
            'Direccion' => 'required',
            'Estado' => 'required',
        ]);

        if($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $cliente = Cliente::find($id);

        if($cliente) {
            $cliente->update([
                'Nombre' => $request->nombre,
                'Contacto' => $request->contacto,
                'Direccion' => $request->direccion,
                'Estado' => $request->estado,
            ]);
            return response()->json([
                'code' => 200,
                'data' => 'Cliente actualizado'
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'data' => 'Cliente no encotrado'
        ], 404);
    }

    public function deleteCliente($id) {
        $cliente =  Cliente::find($id);

        if($cliente) {
            $cliente->delete();

            return response()->json([
                'code' => 200,
                'data' => 'Cliente eliminado'
            ], 200);
        }

        return response()->json([
            'code' => 404,
            'data' => 'No hay registros'
        ], 404);
    }
}
