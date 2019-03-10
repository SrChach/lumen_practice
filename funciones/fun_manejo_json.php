<?php 

	//	Funcion para mostrar error y salir si una variable no existe, es 0 o "false"
	//	Cambiar nombre a chack_variable_inexistente o algo así
	function die_variable_inexistente($msj_error = "hubo un error", $variable = false, $isJson = true){
		if(!$variable){
			if($isJson){
				header('Content-Type: application/json');
				echo json_encode(["error" => $msj_error]);
			} else
				echo $msj_error;
			die();
		}
	}
	function json_success_print($variable = null, $isJson = true){
		if($isJson)
			header('Content-Type: application/json');
		echo json_encode([
			"content" => $variable,
			"error" => null
		]);
		die();
	}

?>