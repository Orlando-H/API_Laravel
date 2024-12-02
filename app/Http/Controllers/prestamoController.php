<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Validator;

class prestamoController extends Controller
{
    function index()
    {
        $prestamos = Prestamo::all();

        $data = [
            'prestamos' => $prestamos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreCliente' => 'required',
            'tarifa' => 'required',
            'car_id' => 'required|exists:cars,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $prestamo = Prestamo::create([
            'nombreCliente' => $request->nombreCliente,
            'tarifa' => $request->tarifa,
            'car_id' => $request->car_id,
        ]);

        if (!$prestamo) {
            $data = [
                'message' => 'Error al crear el préstamo',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'prestamo' => $prestamo,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $prestamo = Prestamo::find($id);

        if (!$prestamo) {
            $data = [
                'message' => 'Préstamo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'prestamo' => $prestamo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $prestamo = Prestamo::find($id);

        if (!$prestamo) {
            $data = [
                'message' => 'Préstamo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombreCliente' => 'required',
            'tarifa' => 'required',
            'car_id' => 'required|exists:cars,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $prestamo->nombreCliente = $request->nombreCliente;
        $prestamo->tarifa = $request->tarifa;
        $prestamo->car_id = $request->car_id;

        $prestamo->save();

        $data = [
            'message' => 'Préstamo actualizado',
            'prestamo' => $prestamo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $prestamo = Prestamo::find($id);

        if (!$prestamo) {
            $data = [
                'message' => 'Préstamo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombreCliente' => '',
            'tarifa' => '',
            'car_id' => 'exists:cars,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombreCliente')) {
            $prestamo->nombreCliente = $request->nombreCliente;
        }

        if ($request->has('tarifa')) {
            $prestamo->tarifa = $request->tarifa;
        }

        if ($request->has('car_id')) {
            $prestamo->car_id = $request->car_id;
        }

        $prestamo->save();

        $data = [
            'message' => 'Préstamo actualizado',
            'prestamo' => $prestamo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);

        if (!$prestamo) {
            $data = [
                'message' => 'Préstamo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $prestamo->delete();

        $data = [
            'message' => 'Préstamo eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}