<?php

namespace App\Http\Controllers;

use App\Models\Estatus;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use Exception;
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
            'v_fisica_1' => 'required|file|mimes:jpg,png,jpeg|max:2040',
            'v_fisica_2' => 'required|file|mimes:jpg,png,jpeg|max:2040',
            'estado' => 'required|string'
        ]);
        try {
            $awsAccessKeyId = env('AWS_ACCESS_KEY_ID');
            $awsSecretAccessKey = env('AWS_SECRET_ACCESS_KEY');

            if (empty($awsAccessKeyId) || empty($awsSecretAccessKey)) {
                throw new Exception('Missing AWS credentials in environment variables!');
            }
            $s3Client = new S3Client([
                'region' => 'us-east-2',
                'version' => 'latest',
                'credentials' => [
                    'key' => $awsAccessKeyId,
                    'secret' => $awsSecretAccessKey,
                ],
            ]);

            $imagePath1 = $request->file('v_fisica_1');
            $imagePath2 = $request->file('v_fisica_2');

            $name1 = 'estatus/' . uniqid() . $imagePath1->getClientOriginalName();
            $name2 = 'estatus/' . uniqid() . $imagePath2->getClientOriginalName();

            $s3Client->putObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => $name1,
                'Body' => fopen($imagePath1->getPathname(), 'r'),
            ]);

            $s3Client->putObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => $name2,
                'Body' => fopen($imagePath2->getPathname(), 'r'),
            ]);

            $estatus = new Estatus([
                'registrado_por' => $request->registrado_por,
                'v_fisica_1' => $name1,
                'v_fisica_2' => $name2,
                'estado' => $request->estado
            ]);

            $estatus->save();
            return response()->json($estatus, 201);
        } catch (AwsException $e) {
            return response()->json(['errorAws' => $e->getMessage()], 400);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'sometimes|string',
            'aprobado_por' => 'sometimes|string',
            'observaciones' => 'sometimes|string',
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
