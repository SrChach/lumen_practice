<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Profesor extends Model implements AuthenticatableContract, AuthorizableContract
{
	use Authenticatable, Authorizable;


	protected $table = "profesores";
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nombre', 'direccion', 'telefono', 'profesion'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];

	public function cursos(){
		return $this->hasMany('App\Curso');
	}
}
