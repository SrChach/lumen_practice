<?php

namespace App\Http\Controllers;

class ProfesorController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			return "desde 'index' en ProfesorController";
		}
		public function store(){
			return "desde 'store' en ProfesorController";
		}
		public function show(){
			return "desde 'show' en ProfesorController";
		}
		public function update(){
			return "desde 'update' en ProfesorController";
		}
		public function destroy(){
			return "desde 'destroy' en ProfesorController";
		}

}
