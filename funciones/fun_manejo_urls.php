<?php 

	//	Funcion que convierte un arreglo tipo llave/valor en los parámetros de una URL
	function array_to_url_parameters($arreglo){
		$separador = '?';
		$parametros_url = '';
		foreach($arreglo as $parametro => $valor){
			$parametros_url .= $separador . $parametro . "=" . urlencode($valor);
			$separador = '&';
		}
		return $parametros_url;
	}

?>