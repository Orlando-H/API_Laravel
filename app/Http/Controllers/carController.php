<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Validator;


class carController extends Controller
{
    function index(){

        $cars = Car::all();

        $data = [
            'cars' => $cars,
            'status' => 200
        ];

        return response()->json($data ,200);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'model' => 'required',
            'brand' => 'required',
            'year' => 'required',
            'price' => 'required',
            'color' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $car = Car::create([
            'name' => $request->name,
            'model' => $request->model,
            'brand' => $request->brand,
            'year' => $request->year,
            'price' => $request->price,
            'color' => $request->color,
        ]);

        if(!$car){
            $data = [
                'message' => 'Error al crear el carro',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'car' => $car,
            'status' => 201
        ];
        
        return response()->json($data, 201);
    }

    public function show($id){
            
            $car = Car::find($id);
    
            if(!$car){
                $data = [
                    'message' => 'Carro no encontrado',
                    'status' => 404
                ];
                return response()->json($data, 404);
            }
    
            $data = [
                'car' => $car,
                'status' => 200
            ];
    
            return response()->json($data, 200);
    }

    public function destroy($id){
        
        $car = Car::find($id);

        if(!$car){
            $data = [
                'message' => 'Carro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $car->delete();

        $data = [
            'message' => 'Carro eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
            
            $car = Car::find($id);
    
            if(!$car){
                $data = [
                    'message' => 'Carro no encontrado',
                    'status' => 404
                ];
                return response()->json($data, 404);
            }
    
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'model' => 'required',
                'brand' => 'required',
                'year' => 'required',
                'price' => 'required',
                'color' => 'required',
            ]);

            if($validator->fails()){
                $data = [
                    'message' => 'Error de validación',
                    'errors' => $validator->errors(),
                    'status' => 400
                ];
                return response()->json($data, 400);
            }

            $car->name = $request->name;
            $car->model = $request->model;
            $car->brand = $request->brand;
            $car->year = $request->year;
            $car->price = $request->price;
            $car->color = $request->color;

            $car->save();

            $data = [
                'message' => 'Carro actualizado',
                'car' => $car,
                'status' => 200
            ];

            return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id){

        $car = Car::find($id); 

        if(!$car){
            $data = [
                'message' => 'Carro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => '',
            'model' => '',
            'brand' => '',
            'year' => '',
            'price' => '',
            'color' => '',
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('name')){
            $car->name = $request->name;
        }

        if($request->has('model')){
            $car->model = $request->model;
        }

        if($request->has('brand')){
            $car->brand = $request->brand;
        }

        if($request->has('year')){
            $car->year = $request->year;
        }

        if($request->has('price')){
            $car->price = $request->price;
        }

        if($request->has('color')){
            $car->color = $request->color;
        }

        $car->save();

        $data = [
            'message' => 'Carro actualizado',
            'car' => $car,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
