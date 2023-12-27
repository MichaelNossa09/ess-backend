<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return response()->json($eventos);
    }

    public function show($id)
    {
        $evento = Evento::find($id);

        if ($evento) {
            return response()->json($evento);
        } else {
            return response()->json(['error' => 'EventoID no válido'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'observación' => 'string',
        ]);

        $evento = new Evento([
            'nombre' => $request->nombre,
            'observación' => $request->observación,
        ]);

        $evento->save();

        return response()->json($evento, 201);
    }

    public function update(Request $request, $id)
    {

        $evento = Evento::findOrFail($id);

        $data = $request->only(['nombre', 'observación']);
        $evento->update($data);

        return response()->json($evento, 200);
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return response()->json(null, 204);
    }
}
