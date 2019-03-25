<?php

namespace App\Http\Controllers;

class CursoEstudianteController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			return "desde 'index' en CursoEstudianteController";
		}
		public function store(){
			return "desde 'store' en CursoEstudianteController";
		}
		public function destroy(){
			return "desde 'destroy' en CursoEstudianteController";
		}

}
