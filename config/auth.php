<?php

return [ 
	'defaults' => [
		'guard' => 'api',
		'passwords' => 'profesores',
	],
	'guards' => [
		'api' => [
			'driver' => 'passport',
			'provider' => 'profesores',
		],
	],
	'providers' => [
		'profesores' => [
			'driver' => 'eloquent',
			'model' => \App\Profesor::class
		]
	]
];

?>