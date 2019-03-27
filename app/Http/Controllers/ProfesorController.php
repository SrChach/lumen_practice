<?php

namespace App\Http\Controllers;

use App\Profesor;

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
		
		public function store(){
			return "desde 'store' en ProfesorController";
		}
		public function update(){
			return "desde 'update' en ProfesorController";
		}
		public function destroy(){
			return "desde 'destroy' en ProfesorController";
		}

}
