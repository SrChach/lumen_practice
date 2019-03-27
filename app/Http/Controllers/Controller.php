<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request; // Importante para sobreescribir la respuesta

class Controller extends BaseController
{

	public function responder($data, $code){
		return response()->json(['data' => $data], $code);
	}

	public function responder_error($message, $code){
		return response()->json(['message' => $message, 'code' => $code], $code);
	}

	// Metodo para sobreescribir los errores y forzarlos a ser JSON siempre (no redirect allowed)
	protected function buildFailedValidationResponse(Request $request, array $errors){
		return $this->responder_error($errors, 422);
	}

}
