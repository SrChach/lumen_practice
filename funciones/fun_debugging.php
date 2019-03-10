<?php 

	function tiempo_memoria(&$time_last_exec){
		$time = microtime(true) - $time_last_exec;
		echo "[time: {$time}][memory: " . memory_get_usage() . "][fecha: " . date("Y-m-d H:i:s") . "]" . PHP_EOL;
		$time_last_exec = microtime(true);

		// printf("Execution took %.2f seconds, maximum memory used %.3f KB\n",
		// 	microtime(TRUE) - $start_proc_time, memory_get_peak_usage()/1024);
	}

?>