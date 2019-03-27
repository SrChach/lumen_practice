<?php

namespace App\Http\Controllers;

use App\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			$profesores = Profesor::all();
			return $this->responder($profesores, 200);
		}

		public function show($id){
			$profesor = Profesor::find($id);

			if($profesor)
				return $this->responder($profesor, 200);
			return $this->responder_error('profesor no encontrado', 404);
		}

		public function store(Request $request){
			// Validamos los datos en la petición. Si no cumplen, se retorna un error
			$reglas = [
				'nombre' => 'required',
				'direccion' => 'required',
				'telefono' => 'required|numeric',
				'profesion' => 'required|in:ingenieria,matematica,fisica'
			];
			$this->validate($request, $reglas);

			// tomamos todos los campos de la petición
			Profesor::create($request->all());

			return $this->responder('El profesor ha sido creado', 201);
		}
		public function update(){
			return "desde 'update' en ProfesorController";
		}
		public function destroy(){
			return "desde 'destroy' en ProfesorController";
		}

}
