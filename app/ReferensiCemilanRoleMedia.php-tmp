<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferensiCemilanRoleMedia extends Model {
	use SoftDeletes;
	protected $table = 'referensi_cemilan_role_media';
	protected $dates = ['deleted_at'];
	public function media() {
		return $this->belongsTo('App\Media', 'media_id');
	}
	public function referensi_cemilan() {
		return $this->belongsTo('App\ReferensiCemilan', 'referensi_cemilan_id');
	}
}
