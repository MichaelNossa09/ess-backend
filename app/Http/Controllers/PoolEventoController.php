<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Pool;
use App\Models\PoolEvento;
use Illuminate\Http\Request;

class PoolEventoController extends Controller
{
    public function index()
    {
        $poolEventos = PoolEvento::all();
        return response()->json($poolEventos, 200);
    }

    // Obtener un registro por ID
    public function show($id)
    {
        $poolEvento = PoolEvento::find($id);
        if ($poolEvento) {
            return response()->json($poolEvento, 200);
        } else {
            return response()->json(['error' => 'PoolsEventoID no válido'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'pool_id' => 'required|exists:pools,id',
            'evento_id' => 'required|exists:eventos,id',
        ]);

        $poolEvento = PoolEvento::create($request->all());
        return response()->json($poolEvento, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pool_id' => 'exists:pools,id',
            'evento_id' => 'exists:eventos,id',
        ]);

        $poolEvento = PoolEvento::findOrFail($id);
        $poolEvento->update($request->all());

        return response()->json($poolEvento, 200);
    }

    public function destroy($id)
    {
        $poolEvento = PoolEvento::findOrFail($id);
        $poolEvento->delete();

        return response()->json(null, 204);
    }

    public function getEventoByPool($poolId)
    {
        $pool = Pool::findOrFail($poolId);
        $evento = $pool->eventos;
        return response()->json($evento, 200);
    }

    public function getPoolsByEvento($eventoId)
    {
        $evento = Evento::findOrFail($eventoId);
        $pools = $evento->pools;
        return response()->json($pools, 200);
    }
}
