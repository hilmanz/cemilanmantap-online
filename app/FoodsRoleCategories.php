<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Http\Controllers\FrontController;

class FoodsRoleCategories extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'foods_role_categories';
	public function categories() {
		return $this->belongsTo('App\Categories', 'category_id');
	}
	public function food() {
		return $this->belongsTo('App\Foods', 'food_id');
	}
	public function singleComent($food_id) {
		return FrontController::get_food_single_comments($food_id);
	}
}
