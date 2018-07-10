<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodsRoleMedia extends Model {
	protected $table = 'foods_role_media';
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
}
