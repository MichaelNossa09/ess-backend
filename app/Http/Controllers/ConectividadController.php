<?php

namespace App\Http\Controllers;

use App\Models\Conectividad;
use Illuminate\Http\Request;

class ConectividadController extends Controller
{
    public function index()
    {
        $conectividades = Conectividad::all();
        return response()->json($conectividades);
    }

    public function show($id)
    {
        $conectividad = Conectividad::find($id);

        if ($conectividad) {
            return response()->json($conectividad);
        } else {
            return response()->json(['error' => 'ConectividadID no válido'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'estado_conectate' => 'required|string',
            'velocidad_conectate' => 'required|numeric|min:0',
            'estado_itelkom' => 'required|string',
            'velocidad_itelkom' => 'required|numeric|min:0',
            'alertas_graves' => 'required|integer|min:0',
            'observaciones_graves' => 'nullable|string',
            'alertas_medias' => 'required|integer|min:0',
            'observaciones_medias' => 'nullable|string',
            'alertas_menores' => 'required|integer|min:0',
            'observaciones_menores' => 'nullable|string',
            'informacion_workspace' => 'required|string',
            'pico_entrante_max_itelkom' => 'required|numeric|min:0',
            'pico_salida_max_itelkom' => 'required|numeric|min:0',
            'pico_entrante_max_conectate' => 'required|numeric|min:0',
            'pico_salida_max_conectate' => 'required|numeric|min:0',
            'temperatura_datacenter' => 'required|numeric|min:0',
            'registrado_por' => 'required|string',
            'v_fisica_1' => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'v_fisica_2' => 'required|file|mimes:jpg,png,jpeg|max:1024',
        ]);

        $alertasTotales = $request->alertas_graves + $request->alertas_medias + $request->alertas_menores;

        $imagePath1 = $request->file('v_fisica_1')->store('conectividad', 'public');
        $imagePath2 = $request->file('v_fisica_2')->store('conectividad', 'public');

        $conectividad = new Conectividad([
            'estado_conectate' => $request->estado_conectate,
            'velocidad_conectate' => $request->velocidad_conectate,
            'estado_itelkom' => $request->estado_itelkom,
            'velocidad_itelkom' => $request->velocidad_itelkom,
            'alertas_graves' => $request->alertas_graves,
            'observaciones_graves' => $request->observaciones_graves,
            'alertas_medias' => $request->alertas_medias,
            'observaciones_medias' => $request->observaciones_medias,
            'alertas_menores' => $request->alertas_menores,
            'observaciones_menores' => $request->observaciones_menores,
            'alertas_totales' => $alertasTotales,
            'informacion_workspace' => $request->informacion_workspace,
            'pico_entrante_max_itelkom' => $request->pico_entrante_max_itelkom,
            'pico_salida_max_itelkom' => $request->pico_salida_max_itelkom,
            'pico_entrante_max_conectate' => $request->pico_entrante_max_conectate,
            'pico_salida_max_conectate' => $request->pico_salida_max_conectate,
            'temperatura_datacenter' => $request->temperatura_datacenter,
            'registrado_por' => $request->registrado_por,
            'v_fisica_1' => $imagePath1,
            'v_fisica_2' => $imagePath2,
        ]);

        $conectividad->save();

        return response()->json($conectividad, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aprobado_por' => 'required|string',
            'observaciones' => 'string',
        ]);

        $conectividad = Conectividad::findOrFail($id);

        $conectividad->update([
            'aprobado_por' => $request->aprobado_por,
            'observaciones' => $request->observaciones,
        ]);

        return response()->json($conectividad, 200);
    }

    public function destroy($id)
    {
        $conectividad = Conectividad::findOrFail($id);
        $conectividad->delete();

        return response()->json(null, 204);
    }
}
