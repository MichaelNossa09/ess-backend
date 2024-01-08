<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['exito' => 0, 'error' => 'Revisa los campos por favor'], 422);
        }

        $credentials = $request->only('correo', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Token de acceso')->accessToken;

            return response()->json(['exito' => 1, 'token' => $token, 'user' => $user], 200);
        }

        return response()->json(['exito' => 0, 'error' => 'Credenciales Incorrectas.'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cargo' => 'required',
            'name' => 'required',
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['exito' => 0, 'error' => $validator->errors()], 422);
        }

        $credentials = $request->only('name', 'correo', 'password', 'cargo');

        try {
            $user = User::create($credentials);
            return response()->json(['exito' => 1, 'data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['exito' => 0, 'error' => 'Error al registrar usuario'], 500);
        }
    }

    public function getUsers()
    {
        try {
            $users = User::all();

            return response()->json(['exito' => 1, 'data' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['exito' => 0, 'error' => 'Error al obtener usuarios'], 500);
        }
    }


    public function getUserByID($correo)
    {
        try {
            $user = User::where('correo', $correo)->first();

            if (!$user) {
                return response()->json(['exito' => 0, 'error' => 'Usuario no encontrado'], 404);
            }
            return response()->json(['exito' => 1, 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['exito' => 0, 'error' => 'Error al obtener usuario'], 500);
        }
    }


    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json(['exito' => '1', 'mensaje' => 'Sesión cerrada correctamente']);
    }
}
