<?php
namespace App;
use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends SentinelUser {
	use SoftDeletes;
	protected $hidden = [
		'password',
	];
	protected $dates    = ['deleted_at'];
	protected $fillable = [
		'id',
		'email',
		'provider',
		'provider_url',
		'client_id',
		'client_secret',
		'avatar',
		'jenis_kelamin',
		'password',
		'name',
		'username',
		'status',
	];
	protected $table      = 'users';
	protected $loginNames = ['email', 'username', 'client_id'];
	public function role_user() {
		return $this->hasOne('App\Role_users', 'user_id');
	}
	public static function byEmail($email) {
		return static ::whereEmail($email)->first();
	}
}
