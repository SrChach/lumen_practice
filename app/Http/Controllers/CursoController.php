<?php

namespace App\Http\Controllers;

class CursoController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			return "desde 'index' en CursoController";
		}
		public function show(){
			return "desde 'show' en CursoController";
		}

}
