<?php

namespace App\Http\Controllers;

class EstudianteController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			return "desde 'index' en EstudianteController";
		}
		public function store(){
			return "desde 'store' en EstudianteController";
		}
		public function show(){
			return "desde 'show' en EstudianteController";
		}
		public function update(){
			return "desde 'update' en EstudianteController";
		}
		public function destroy(){
			return "desde 'destroy' en EstudianteController";
		}

}
