<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_users extends Model {
	protected $table    = 'role_users';
	protected $fillable = [
		'user_id',
		'role_id',
	];
	public function roles() {
		return $this->belongsTo('App\Roles', 'role_id');
	}
	public function user() {
		return $this->belongsTo('App\Users', 'user_id');
	}
}
