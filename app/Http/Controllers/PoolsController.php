<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoolsController extends Controller
{
    public function index()
    {
        $pools = Pool::all();
        return response()->json($pools);
    }

    public function show($id)
    {
        $pool = Pool::find($id);

        if ($pool) {
            return response()->json($pool);
        } else {
            return response()->json(['error' => 'PoolID no válido'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'capacidad_pool_a' => 'required|numeric|min:0',
            'capacidad_disponible_pool_a' => 'required|numeric|min:0',
            'capacidad_pool_b' => 'required|numeric|min:0',
            'capacidad_disponible_pool_b' => 'required|numeric|min:0',
            'v_fisica_1' => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'v_fisica_2' => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'registrado_por' => 'required|string',
        ]);

        try {
            $imagePath1 = $request->file('v_fisica_1')->store('pools', 'public');
            $imagePath2 = $request->file('v_fisica_2')->store('pools', 'public');

            $capacidadTotalA = $request->capacidad_pool_a;
            $capacidadDisponibleA = $request->capacidad_disponible_pool_a;

            if ($capacidadTotalA > 0) {
                $porcentajeDisponibleA = ($capacidadDisponibleA / $capacidadTotalA) * 100;
            } else {
                $porcentajeDisponibleA = 0;
            }

            $capacidadTotalB = $request->capacidad_pool_b;
            $capacidadDisponibleB = $request->capacidad_disponible_pool_b;

            if ($capacidadTotalB > 0) {
                $porcentajeDisponibleB = ($capacidadDisponibleB / $capacidadTotalB) * 100;
            } else {
                $porcentajeDisponibleB = 0;
            }

            $pool = new Pool([
                'capacidad_pool_a' => $capacidadTotalA,
                'capacidad_disponible_pool_a' => $capacidadDisponibleA,
                'porcentaje_disponible_pool_a' => $porcentajeDisponibleA,
                'capacidad_pool_b' => $capacidadTotalB,
                'capacidad_disponible_pool_b' => $capacidadDisponibleB,
                'porcentaje_disponible_pool_b' => $porcentajeDisponibleB,
                'v_fisica_1' => $imagePath1,
                'v_fisica_2' => $imagePath2,
                'registrado_por' => $request->registrado_por,
            ]);

            $pool->save();
            return response()->json($pool, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 400);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'aprobado_por' => 'required|string',
            'observaciones' => 'string',
        ]);

        $pool = Pool::findOrFail($id);

        $pool->update([
            'aprobado_por' => $request->aprobado_por,
            'observaciones' => $request->observaciones,
        ]);

        return response()->json($pool, 200);
    }

    public function destroy($id)
    {
        $pool = Pool::findOrFail($id);
        $pool->delete();

        return response()->json(null, 204);
    }
}
