<?php
	error_reporting(E_ALL); ini_set('display_errors', '1');

	
	define("BASE_DIRECTORY", dirname(__FILE__) . DIRECTORY_SEPARATOR);
	$time_last_exec = microtime(true);

	function base_include($including_file){
		return BASE_DIRECTORY . $including_file;
	}

	include_once base_include('funciones/fun_manejo_json.php');
	include_once base_include('funciones/fun_manejo_urls.php');

	include_once base_include('funciones/fun_debugging.php');


	tiempo_memoria($time_last_exec);

	// Redireccion al archivo al que iba inicialmente. (Solo se puede acceder a archivos dentro de "controladores")
	if(file_exists( base_include('controladores/' . $_GET['__arch_req__']) ))
		include_once base_include('controladores/' . $_GET['__arch_req__']);
	else
		echo "404 hijo de perra";

?>
