<?php
// 23, s.5 mins 2:30
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

			if($curso){
				$estudiantes = $curso->estudiantes;
				return $this->responder($estudiantes, 200);
			}
			return $this->responder_error('No se pudo encontrar curso con el id dado', 404);
		}
		
		public function store($curso_id, $estudiante_id){
			$curso = Curso::find($curso_id);
			if($curso){
				
				$estudiante = Estudiante::find($estudiante_id);
				if($estudiante){
					
					$estudiantes = $curso->estudiantes();
					// el estudiante ya existe en el curso, no lo inserta de nuevo
					if($estudiantes->find($estudiante_id))
						return $this->responder_error('El estudiante ya se encuentra asignado al curso', 409);

					$estudiantes->attach($estudiante_id);
					return $this->responder("El estudiante $estudiante_id ha sido agregado al curso $curso_id", 201);
				}
				return $this->responder_error('El estudiante no existe', 404);
			}
			return $this->responder_error('El curso no existe', 404);
		}

		public function destroy(){
			return "desde 'destroy' en CursoEstudianteController";
		}

}
