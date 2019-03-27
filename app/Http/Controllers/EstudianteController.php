<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			$estudiantes = Estudiante::all();
			return $this->responder($estudiantes, 200);
		}

		public function show($id){
			$estudiante = Estudiante::find($id);

			if($estudiante)
				return $this->responder($estudiante, 200);
			return $this->responder_error('estudiante no encontrado', 404);
		}

		public function store(Request $request){
			$reglas = [
				'nombre' => 'required',
				'direccion' => 'required',
				'telefono' => 'required|numeric',
				'carrera' => 'required|in:ingenieria,matematica,fisica'
			];
			$this->validate($request, $reglas);

			// El método 'create' es de Eloquent
			Estudiante::create($request->all());

			return $this->responder('El profesor ha sido creado', 201);
		}
		
		public function update(){
			return "desde 'update' en EstudianteController";
		}
		public function destroy(){
			return "desde 'destroy' en EstudianteController";
		}

}
