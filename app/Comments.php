<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Http\Controllers\FrontController;

class Comments extends Model {
	use SoftDeletes, CascadeSoftDeletes;
	protected $dates          = ['deleted_at'];
	protected $table          = 'comments';
	protected $cascadeDeletes = ['comments_role_media'];
	protected $fillable       = [
		'id',
		'user_id',
		'food_id',
		'title',
		'rating',
		'text',
		'status',
		'created_at',
		'updated_at',
		'deleted_at',
	];
	public function food() {
		return $this->belongsTo('App\Foods', 'food_id');
	}
	public function user() {
		return $this->belongsTo('App\Users', 'user_id');
	}
	public function comments_role_media() {
		return $this->hasMany('App\CommentsRoleMedia', 'comment_id');
	}
	public function photos_comment($comment_id) {
		return FrontController::photos_comments($comment_id);
	}
}
