<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Http\Controllers\FoodsController;
use \App\Http\Controllers\FrontController;
use \App\Http\Controllers\ReportsController;

class Foods extends Model {
	use SoftDeletes, CascadeSoftDeletes, Sluggable;
	protected $table          = 'foods';
	protected $dates          = ['deleted_at'];
	protected $cascadeDeletes = ['food_role_categories', 'comment'];
	protected $fillable       = [
		'id',
		'media_id',
		'store_id',
		'title',
		'slug',
		'price',
		'text',
		'contributor',
		'short_text',
		'rating',
		'created_by',
		'status',
		'status_recomended',
		'meta_title',
		'meta_description',
		'meta_tags',
		'created_at',
		'updated_at',
	];
	public function sluggable() {
		return [
			'slug'    => [
				'source' => 'title'
			]
		];
	}
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
	public function user() {
		return $this->belongsTo('App\Users', 'created_by');
	}
	public function store() {
		return $this->belongsTo('App\Stores', 'store_id');
	}
	public function food_role_categories() {
		return $this->hasMany('App\FoodsRoleCategories', 'food_id');
	}
	public function comment() {
		return $this->hasMany('App\Comments', 'food_id');
	}
	public function firstComment() {
		return $this->hasOne('App\Comments', 'id', 'food_id');
	}
	public function get_rating($food_id) {
		return FoodsController::rating_food($food_id);
	}
	public function count_comments($food_id) {
		return FoodsController::count_comments($food_id);
	}
	public function similar($category_id, $food_id) {
		return FrontController::foods_similar($category_id, $food_id);
	}
	public function singleComent($food_id) {
		return FrontController::get_food_single_comments($food_id);
	}
	public function total_media($user_id) {
		return ReportsController::get_total_media($user_id);
	}
}
