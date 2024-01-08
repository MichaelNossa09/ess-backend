<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::all();
        return response()->json($notificaciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|string',
            'name' => 'required|string|max:40',
            'message' => 'required|string|max:255',
        ]);

        $notificacion = Notificacion::create([
            'photo' => $request->input('photo'),
            'name' => $request->input('name'),
            'message' => $request->input('message'),
        ]);

        return response()->json($notificacion, 201);
    }
}
