<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
		public function __construct(){
				//
		}

		public function index(){
			$estudiantes = Estudiante::all();
			return $this->responder($estudiantes, 200);
		}

		public function show($id){
			$estudiante = Estudiante::find($id);

			if($estudiante)
				return $this->responder($estudiante, 200);
			return $this->responder_error('estudiante no encontrado', 404);
		}

		public function store(Request $request){
			$this->validar_estudiante($request);

			// El método 'create' es de Eloquent
			Estudiante::create($request->all());

			return $this->responder('El profesor ha sido creado', 201);
		}
		
		public function update(Request $request, $estudiante_id){
			$estudiante = Estudiante::find($estudiante_id);

			if($estudiante){
				$this->validar_estudiante($request);
	
				$nombre = $request->get('nombre');
				$direccion = $request->get('direccion');
				$telefono = $request->get('telefono');
				$carrera = $request->get('carrera');

				$estudiante->nombre = $nombre;
				$estudiante->direccion = $direccion;
				$estudiante->telefono = $telefono;
				$estudiante->carrera = $carrera;

				$estudiante->save();

				return $this->responder("El estudiante {$estudiante->id} ha sido editado", 200); 
			}
			return $this->responder_error("El id proporcionado no corresponde a ningun estudiante", 404);
		}

		public function destroy($estudiante_id){
			$estudiante = Estudiante::find($estudiante_id);

			if($estudiante){
				// Para borrar dependencia de la tabla intermedia
				$estudiante->cursos()->sync([]);
				
				$estudiante->delete();
				return $this->responder('El estudiante ha sido eliminado', 200);
			}
			return $this->responder_error('Estudiante no encontrado', 404);
		}

		public function validar_estudiante($request){
			$reglas = [
				'nombre' => 'required',
				'direccion' => 'required',
				'telefono' => 'required|numeric',
				'carrera' => 'required|in:ingenieria,matematica,fisica'
			];
			$this->validate($request, $reglas);
		}

}
