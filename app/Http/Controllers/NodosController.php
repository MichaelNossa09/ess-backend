<?php

namespace App\Http\Controllers;

use App\Models\Nodo;
use Illuminate\Http\Request;

class NodosController extends Controller
{
    public function index()
    {
        $nodos = Nodo::all();
        return response()->json($nodos);
    }

    public function show($id)
    {
        $nodo = Nodo::find($id);

        if ($nodo) {
            return response()->json($nodo);
        } else {
            return response()->json(['error' => 'NodoID no válido'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripción' => 'string',
        ]);

        $nodo = new Nodo([
            'nombre' => $request->nombre,
            'descripción' => $request->observación,
        ]);

        $nodo->save();

        return response()->json($nodo, 201);
    }

    public function update(Request $request, $id)
    {

        $nodo = Nodo::findOrFail($id);

        $data = $request->only(['nombre', 'descripción']);
        $nodo->update($data);

        return response()->json($nodo, 200);
    }

    public function destroy($id)
    {
        $nodo = Nodo::findOrFail($id);
        $nodo->delete();

        return response()->json(null, 204);
    }
}
