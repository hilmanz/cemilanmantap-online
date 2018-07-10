<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentsRoleMedia extends Model {
	use SoftDeletes;
	protected $table = 'comments_role_media';
	protected $dates = ['deleted_at'];
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
	public function comments() {
		return $this->belongsTo('App\Comments', 'comment_id');
	}
}
