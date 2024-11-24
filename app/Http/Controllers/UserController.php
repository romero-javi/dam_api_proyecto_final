<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
 public function getUsers() {
    $users = User::all();

    if(count($users) !== 0) {
        return response()->json([
            'code' => 200, 
            'data' => $users
        ], 200);
    }

    return response()->json([
        'code' => 200,
        'message' => 'There are no users in the system yet'
    ], 200);
 }   

 public function updateUser(Request $request, $id_user)
    {
        $validacion = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'rol' => 'required|string|max:128'
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $user = User::find($id_user);

        if (!$user) {
            return response()->json([
                'code' => 404,
                'data' => "Usuario no encontrado"
            ], 404);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'rol' => $request->rol
        ]);

        return response()->json([
            'code' => 200,
            'data' => "Usuario actualizado"
        ], 200);
    }
}
