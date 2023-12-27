<?php

namespace App\Http\Controllers;

use App\Models\Nodo;
use App\Models\Servidor;
use Illuminate\Http\Request;

class ServidoresController extends Controller
{
    public function index()
    {
        $servidores = Servidor::all();
        return response()->json($servidores, 200);
    }

    // Obtener un servidor por ID
    public function show($id)
    {
        $servidor = Servidor::find($id);
        if ($servidor) {
            return response()->json($servidor, 200);
        } else {
            return response()->json(['error' => 'ServidorID no válido'], 404);
        }
    }

    // Crear un nuevo servidor
    public function store(Request $request)
    {
        $request->validate([
            'nodo_id' => 'required|exists:nodos,id',
            'encendido' => 'required|boolean',
            'nombre' => 'required|string',
            'almacenamiento_total' => 'required|numeric',
            'descripción' => 'nullable|string',
        ]);

        $servidor = Servidor::create($request->all());
        return response()->json($servidor, 201);
    }

    // Actualizar un servidor existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nodo_id' => 'exists:nodos,id',
            'encendido' => 'boolean',
            'nombre' => 'string',
            'almacenamiento_total' => 'numeric',
            'descripción' => 'nullable|string',
        ]);

        $servidor = Servidor::findOrFail($id);
        $servidor->update($request->all());

        return response()->json($servidor, 200);
    }

    // Eliminar un servidor
    public function destroy($id)
    {
        $servidor = Servidor::findOrFail($id);
        $servidor->delete();

        return response()->json(null, 204);
    }

    public function getNodoByServidor($servidorId)
    {
        $servidor = Servidor::findOrFail($servidorId);
        $nodoAsociado = $servidor->nodo;
        return response()->json($nodoAsociado, 200);
    }

    // Obtener los servidores asociados a un nodo
    public function getServidoresByNodo($nodoId)
    {
        $nodo = Nodo::findOrFail($nodoId);
        $servidoresAsociados = $nodo->servidores;
        return response()->json($servidoresAsociados, 200);
    }
}
