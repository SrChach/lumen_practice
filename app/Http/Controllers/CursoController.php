<?php

namespace App\Http\Controllers;

use App\Curso;

class CursoController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			$cursos = Curso::all();
			//$cursos = Curso::with('profesor')->get();
			return $this->responder($cursos, 200);
		}
		public function show($id){
			$curso = Curso::find($id);

			if($curso)
				return $this->responder($curso, 200);
			return $this->responder_error('curso no encontrado', 404);
		}

}
