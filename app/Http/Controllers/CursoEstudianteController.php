<?php

namespace App\Http\Controllers;

use App\Curso;

class CursoEstudianteController extends Controller
{
		public function __construct(){
				//
		}

		public function index($curso_id){
			$curso = Curso::find($curso_id);

			if($curso){
				$estudiantes = $curso->estudiantes;
				return $this->responder($estudiantes, 200);
			}
			return $this->responder_error('No se pudo encontrar curso con el id dado', 404);
		}
		
		public function store(){
			return "desde 'store' en CursoEstudianteController";
		}
		public function destroy(){
			return "desde 'destroy' en CursoEstudianteController";
		}

}
