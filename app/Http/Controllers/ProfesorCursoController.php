<?php

namespace App\Http\Controllers;

class ProfesorCursoController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			return "desde 'index' en ProdesorCursoController";
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
