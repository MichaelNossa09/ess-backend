<?php

namespace App\Http\Controllers;

use App\Models\Estatus;
use App\Models\EstatusServidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstatusServidoresController extends Controller
{
    public function index()
    {
        $estatusServidores = EstatusServidor::all();
        return response()->json($estatusServidores, 200);
    }

    public function show($id)
    {
        $estatusServidor = EstatusServidor::find($id);

        if ($estatusServidor) {
            return response()->json($estatusServidor, 200);
        } else {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'estatus_id' => 'required|exists:estatus,id',
            'servidor_id' => 'required|exists:servidores,id',
            'almacenamiento_disponible' => 'required|numeric',
            'almacenamiento_ocupado' => 'required|numeric',
            'cpu' => 'required|numeric',
            'memoria' => 'required|numeric',
            'consumo_de_red' => 'required|numeric',
        ]);
        $almacenamientoDisponible = $request->almacenamiento_disponible;
        $almacenamientoOcupado = $request->almacenamiento_ocupado;
        $porcentajeDisponible = ($almacenamientoDisponible / ($almacenamientoDisponible + $almacenamientoOcupado)) * 100;

        $estatusServidor = EstatusServidor::create([
            'estatus_id' => $request->estatus_id,
            'servidor_id' => $request->servidor_id,
            'almacenamiento_disponible' => $request->almacenamiento_disponible,
            'almacenamiento_ocupado' => $request->almacenamiento_ocupado,
            'porcentaje_disponible' => $porcentajeDisponible,
            'cpu' => $request->cpu,
            'memoria' => $request->memoria,
            'consumo_de_red' => $request->consumo_de_red,
        ]);
        return response()->json($estatusServidor, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'almacenamiento_disponible' => 'sometimes|numeric',
            'almacenamiento_ocupado' => 'sometimes|numeric',
            'cpu' => 'sometimes|numeric',
            'memoria' => 'sometimes|numeric',
            'consumo_de_red' => 'sometimes|numeric',
        ]);
        $estatusServidor = EstatusServidor::findOrFail($id);

        // Actualizar solo los campos proporcionados en la solicitud
        $estatusServidor->update($request->only([
            'almacenamiento_disponible',
            'almacenamiento_ocupado',
            'cpu',
            'memoria',
            'consumo_de_red',
        ]));

        $almacenamientoDisponible = $estatusServidor->almacenamiento_disponible;
        $almacenamientoOcupado = $estatusServidor->almacenamiento_ocupado;
        $porcentajeDisponible = ($almacenamientoDisponible / ($almacenamientoDisponible + $almacenamientoOcupado)) * 100;

        $estatusServidor->update(['porcentaje_disponible' => $porcentajeDisponible]);

        return response()->json($estatusServidor, 200);
    }


    public function destroy($id)
    {
        $estatusServidor = EstatusServidor::findOrFail($id);
        $estatusServidor->delete();

        return response()->json(null, 204);
    }

    public function getServersByEstatus($estatusId)
    {
        $estatus = Estatus::findOrFail($estatusId);
        $servers = $estatus->servidores;
        return response()->json($servers, 200);
    }

    public function getServersWithStatus($estatusId)
    {
        $servers = DB::table('estatus_servidor')
            ->select('*')
            ->where('estatus_id', $estatusId)
            ->get();

        return response()->json(['servers' => $servers]);
    }
}
