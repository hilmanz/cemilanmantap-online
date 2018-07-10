<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSliders extends Model {
	use SoftDeletes;
	protected $table    = 'home_sliders';
	protected $dates    = ['deleted_at'];
	protected $fillable = [
		'id',
		'name',
		'status',
		'media_id',
		'mobile_media_id',
	];
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
	public function mobile_media() {
		return $this->belongsTo('App\Media', 'mobile_media_id');
	}
}
