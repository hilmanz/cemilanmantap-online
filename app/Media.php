<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model {
	use SoftDeletes;
	protected $table    = 'media';
	protected $dates    = ['deleted_at'];
	protected $fillable = [
		'id',
		'name',
		'text',
		'cover',
		'filename',
		'link',
		'type'
	];
}
