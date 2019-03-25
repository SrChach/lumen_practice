<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Estudiante;
use App\Profesor;
use App\Curso;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UsersTableSeeder');

		// Truncamos los datos de los modelos y insertamos de nuevo en cada seed
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Estudiante::truncate();
		Curso::truncate();
		Profesor::truncate();
		DB::table('curso_estudiante')->truncate();

		factory(Profesor::class, 50)->create();
		factory(Estudiante::class, 500)->create();

		factory(Curso::class, 50)->create(['profesor_id' => mt_rand(1, 50)])->each(function($curso){
			$curso->estudiantes()->attach(array_rand(range(1, 500), 40));
		});

	}
}
