<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function addUser(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:128'
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        $user = User::create($request->all());

        return response()->json([
            'code' => 200,
            'data' => $user,
            'token' => $user->createToken('token', ['*'])->plainTextToken
        ], 200);
    }

    public function login(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:128'
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'code' => 200,
                'data' => $user,
                'token' => $user->createToken('token', ['*'])->plainTextToken
            ], 200);
        }
        
        return response()->json([
            'code' => 401,
            'data' => 'Email o contraseña incorrecta, intente nuevamente.',
        ], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if($user) {
            $tokens = $user->tokens;
            
            $user->tokens->each(function ($token){
                $token->delete();
            });

            return response()->json([
                'code' => 200,
                'data' => 'Cession cerrada con exito',
            ], 200);
        }
        
        return response()->json([
            'code' => 400,
            'data' => 'No fue posible cerrar sesion',
        ], 400);
    }

    public function getPerfil(Request $request)
    {
        return Auth::user();
    }
}
