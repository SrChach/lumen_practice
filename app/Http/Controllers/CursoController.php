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

			return $this->responder($cursos, 200);
		}
		public function show(){
			return "desde 'show' en CursoController";
		}

}
