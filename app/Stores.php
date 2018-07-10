<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stores extends Model {
	use Sluggable;
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $table    = 'stores';
	protected $fillable = [
		'id',
		'media_id',
		'name',
		'email',
		'latitude',
		'longtitude',
		'slug',
		'phone_number',
		'address',
		'place_id',
		'country_initial',
		'country',
		'city',
		'meta_title',
		'meta_description',
		'meta_tags',
		'url',
		'url_use',
		'created_by',
		'status',
		'created_at',
		'updated_at',
	];
	public function sluggable() {
		return [
			'slug'    => [
				'source' => 'name'
			]
		];
	}

	public function user() {
		return $this->belongsTo('App\Users', 'created_by');
	}
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
}
