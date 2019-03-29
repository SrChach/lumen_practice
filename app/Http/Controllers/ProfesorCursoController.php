<?php

namespace App\Http\Controllers;

use App\Profesor;
use App\Curso;
use Illuminate\Http\Request;

class ProfesorCursoController extends Controller
{
		public function __construct(){
				//
		}

		public function index($profesor_id){
			$profesor = Profesor::find($profesor_id);

			if(!$profesor)
				return $this->responder_error('No se pudo encontrar profesor con el id dado', 404);
	
			$cursos = $profesor->cursos;
			return $this->responder($cursos, 200);
		}

		// Crea un curso, dicho curso asignado a un profesor (recibe $profesor_id)
		public function store(Request $request, $profesor_id){

			$profesor = Profesor::find($profesor_id);
			if(!$profesor)
				return $this->responder_error("El profesor especificado no existe", 404);
		
			$this->validarCurso($request);

			$campos = $request->all();
			$campos['profesor_id'] = $profesor_id;
			Curso::create($campos);

			return $this->responder('Curso creado', 200);
		}

		public function update(Request $request, $profesor_id, $curso_id){
			
			$profesor = Profesor::find($profesor_id);
			if(!$profesor)
				return $this->responder_error("El profesor especificado no existe", 404);

			$curso = Curso::find($curso_id);
			if(!$curso)
				return $this->responder_error("El curso especificado no existe", 404);

			$this->validarCurso($request);

			$curso->titulo = $request->get('titulo');		
			$curso->descripcion = $request->get('descripcion');		
			$curso->valor = $request->get('valor');		
			$curso->profesor_id = $profesor_id;

			$curso->save();

			return $this->responder('Curso editado', 200);		
		}

		public function destroy(){
			return "desde 'destroy' en ProdesorCursoController";
		}

		public function validarCurso($request){
			$reglas = [
				'titulo' => 'required',
				'descripcion' => 'required',
				'valor' => 'required|numeric'
			];
			$this->validate($request, $reglas);
		}

}
