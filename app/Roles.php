<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model {
	use Sluggable;
	use SoftDeletes, CascadeSoftDeletes;
	protected $cascadeDeletes = ['role_user'];
	protected $dates          = ['deleted_at'];
	protected $fillable       = [
		'id',
		'name',
		'slug', /* i added this */
		'permissions',
	];
	protected $table = 'roles';
	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug'    => [
				'source' => 'name'
			]
		];
	}
	public function role_user() {
		return $this->hasMany('App\Role_users', 'role_id');
	}

}
