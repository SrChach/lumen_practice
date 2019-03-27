<?php

namespace App\Http\Controllers;

use App\Estudiante;

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

		public function store(){
			return "desde 'store' en EstudianteController";
		}
		
		public function update(){
			return "desde 'update' en EstudianteController";
		}
		public function destroy(){
			return "desde 'destroy' en EstudianteController";
		}

}
