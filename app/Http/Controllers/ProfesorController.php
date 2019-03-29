<?php

namespace App\Http\Controllers;

use App\Profesor;
use Illuminate\Http\Request;

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

		public function store(Request $request){
			$this->validar_profesor($request);
			
			// tomamos todos los campos de la petición
			Profesor::create($request->all());
			return $this->responder('El profesor ha sido creado', 201);
		}

		public function update(Request $request, $profesor_id){
			$profesor = Profesor::find($profesor_id);

			if($profesor){
				$this->validar_profesor($request);
	
				$nombre = $request->get('nombre');
				$direccion = $request->get('direccion');
				$telefono = $request->get('telefono');
				$profesion = $request->get('profesion');

				$profesor->nombre = $nombre;
				$profesor->direccion = $direccion;
				$profesor->telefono = $telefono;
				$profesor->profesion = $profesion;

				$profesor->save();

				return $this->responder("El profesor {$profesor->id} ha sido editado", 200); 
			}
			return $this->responder_error("El id proporcionado no corresponde a ningun profesor", 404);
		}

		public function destroy($profesor_id){
			$profesor = Profesor::find($profesor_id);

			if($profesor){
				// Para borrar dependencia de la tabla intermedia
				$profesor->cursos()->sync([]);
				
				$profesor->delete();
				return $this->responder('El profesor ha sido eliminado', 200);
			}
			return $this->responder_error('Profesor no encontrado', 404);
		}

		public function validar_profesor($request){
			// Validamos los datos en la petición. Si no cumplen, se retorna un error
			$reglas = [
				'nombre' => 'required',
				'direccion' => 'required',
				'telefono' => 'required|numeric',
				'profesion' => 'required|in:ingenieria,matematica,fisica'
			];

			// La validación retorna error si falla, si no no hace nada (por eso no hay return)
			$this->validate($request, $reglas);
		}

}
