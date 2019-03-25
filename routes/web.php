<?php

// Minuto 11 c:

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
	return $router->app->version();
});

$router->get('/profesores', 'ProfesorController@index');
$router->post('/profesores', 'ProfesorController@store');
$router->get('/profesores/{profesores}', 'ProfesorController@show');
$router->put('/profesores/{profesores}', 'ProfesorController@update');
$router->patch('/profesores/{profesores}', 'ProfesorController@update');
$router->delete('/profesores/{profesores}', 'ProfesorController@destroy');

$router->get('/estudiantes', 'EstudianteController@index');
$router->post('/estudiantes', 'EstudianteController@store');
$router->get('/estudiantes/{estudiantes}', 'EstudianteController@show');
$router->put('/estudiantes/{estudiantes}', 'EstudianteController@update');
$router->patch('/estudiantes/{estudiantes}', 'EstudianteController@update');
$router->delete('/estudiantes/{estudiantes}', 'EstudianteController@destroy');

$router->get('/cursos', 'CursoController@index');
$router->get('/cursos/{cursos}', 'CursoController@show');

$router->get('/profesores/{profesores}/cursos', 'ProfesorCursoController@index');
$router->post('/profesores/{profesores}/cursos', 'ProfesorCursoController@store');
$router->put('/profesores/{profesores}/cursos/{cursos}', 'ProfesorCursoController@update');
$router->patch('/profesores/{profesores}/cursos/{cursos}', 'ProfesorCursoController@update');
$router->delete('/profesores/{profesores}/cursos/{cursos}', 'ProfesorCursoController@update');


$router->get('/cursos/{cursos}/estudiantes', 'ProfesorCursoController@index');
$router->post('/cursos/{cursos}/estudiantes/{estudiantes}', 'ProfesorCursoController@store');
$router->delete('/cursos/{cursos}/cursos/{estudiantes}', 'ProfesorCursoController@update');