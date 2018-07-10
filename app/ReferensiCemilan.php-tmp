<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferensiCemilan extends Model {
	use SoftDeletes, CascadeSoftDeletes;
	protected $dates          = ['deleted_at'];
	protected $table          = 'referensi_cemilan';
	protected $cascadeDeletes = ['referensi_cemilan_role_media'];
	protected $fillable       = [
		'id',
		'name',
		'lokasi',
		'harga',
		'no_telp',
		'review_text',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];
	public function referensi_cemilan_role_media() {
		return $this->hasMany('App\ReferensiCemilanRoleMedia', 'referensi_cemilan_id');
	}
	public function user() {
		return $this->belongsTo('App\Users', 'created_by');
	}
}
