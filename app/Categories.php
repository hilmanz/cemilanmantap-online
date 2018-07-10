<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model {
	use SoftDeletes, Sluggable;
	protected $table    = 'categories';
	protected $dates    = ['deleted_at'];
	protected $fillable = [
		'id',
		'name',
		'slug',
		'short_text',
		'long_text',
		'media_id',
		'categories_abjad_id',
		'meta_title',
		'meta_description',
		'meta_tags',
		'created_by',
		'status',
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
	public function categories_abjad() {
		return $this->belongsTo('App\CategoriesAbjad', 'categories_abjad_id')->withTrashed();
	}
}
