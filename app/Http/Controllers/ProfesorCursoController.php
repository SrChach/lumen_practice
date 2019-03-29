<?php

namespace App\Http\Controllers;

use App\Profesor;

class ProfesorCursoController extends Controller
{
		public function __construct(){
				//
		}

		public function index($profesor_id){
			$profesor = Profesor::find($profesor_id);

			if($profesor){
				$cursos = $profesor->cursos;
				return $this->responder($cursos, 200);
			}
			return $this->responder_error('No se pudo encontrar profesor con el id dado', 404);
		}

		public function store(){
			return "desde 'store' en ProdesorCursoController";
		}
		public function update(){
			return "desde 'update' en ProdesorCursoController";
		}
		public function destroy(){
			return "desde 'destroy' en ProdesorCursoController";
		}

}
