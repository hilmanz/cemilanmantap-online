<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videos extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $table    = 'videos';
	protected $fillable = [
		'id',
		'name',
		'text',
		'status',
		'media_id',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
	public function categories() {
		return $this->belongsTo('App\Categories', 'category_id');
	}
}
