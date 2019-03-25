<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Curso extends Model implements AuthenticatableContract, AuthorizableContract
{
	use Authenticatable, Authorizable;
	protected $table = "cursos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'titulo', 'descripcion', 'valor'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];

	public function profesor(){
		return $this->belongsTo('App\Profesor');
	}

	public function estudiantes(){
		return $this->belongsToMany('App\Estudiante');
	}
}
