<?php

namespace App\Http\Controllers;

use App\Models\Estatus;
use Illuminate\Http\Request;

class EstatusController extends Controller
{
    public function index()
    {
        $estatus = Estatus::all();
        return response()->json($estatus, 200);
    }

    // Obtener un estatus por ID
    public function show($id)
    {
        $estatus = Estatus::find($id);
        if ($estatus) {
            return response()->json($estatus, 200);
        } else {
            return response()->json(['error' => 'EstatusID no válido'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'registrado_por' => 'required|string',
            'v_fisica_1' => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'v_fisica_2' => 'required|file|mimes:jpg,png,jpeg|max:1024',
        ]);

        $imagePath1 = $request->file('v_fisica_1')->store('estatus', 'public');
        $imagePath2 = $request->file('v_fisica_2')->store('estatus', 'public');

        $estatus = new Estatus([
            'registrado_por' => $request->registrado_por,
            'v_fisica_1' => $imagePath1,
            'v_fisica_2' => $imagePath2
        ]);

        $estatus->save();

        return response()->json($estatus, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aprobado_por' => 'required|string',
            'observaciones' => 'string',
        ]);

        $estatus = Estatus::findOrFail($id);
        $estatus->update($request->all());

        return response()->json($estatus, 200);
    }

    public function destroy($id)
    {
        $estatus = Estatus::findOrFail($id);
        $estatus->delete();

        return response()->json(null, 204);
    }
}
