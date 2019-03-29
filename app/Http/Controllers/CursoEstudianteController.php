<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Estudiante;

class CursoEstudianteController extends Controller
{
		public function __construct(){
				//
		}

		public function index($curso_id){
			$curso = Curso::find($curso_id);
			if(!$curso)
				return $this->responder_error('No se pudo encontrar curso con el id dado', 404);

			$estudiantes = $curso->estudiantes;
			return $this->responder($estudiantes, 200);
		}
		
		public function store($curso_id, $estudiante_id){
			$curso = Curso::find($curso_id);
			if(!$curso)
				return $this->responder_error('El curso no existe', 404);
				
			$estudiante = Estudiante::find($estudiante_id);
			if(!$estudiante)
				return $this->responder_error('El estudiante no existe', 404);
				
			$estudiantes = $curso->estudiantes();
			if($estudiantes->find($estudiante_id)) // si el estudiante existe en el curso, no lo inserta de nuevo
				return $this->responder_error('El estudiante ya se encuentra asignado al curso', 409);

			$estudiantes->attach($estudiante_id);
			return $this->responder("El estudiante $estudiante_id ha sido agregado al curso $curso_id", 201);
		
		}

		public function destroy($curso_id, $estudiante_id){
			$curso = Curso::find($curso_id);
			if(!$curso)
				return $this->responder_error('El curso no existe', 404);

			$estudiantes = $curso->estudiantes();
			if(!$estudiantes->find($estudiante_id))
				return $this->responder_error('No existe el estudiante solicitado', 404);
			
			$estudiantes->detach($estudiante_id);
			return $this->responder('Estudiante eliminado del curso', 200);
		}

}
