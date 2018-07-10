<?php

namespace App\Http\Controllers;

use Activation;
use App\Users;
use Sentinel;

class ActivationController extends Controller {
	public function activate($email, $activationCode) {
		$user         = users::whereEmail($email)->first();
		$sentinelUser = Sentinel::findById($user->id);
		if (Activation::complete($sentinelUser, $activationCode)) {
			return redirect('login');
		} else {
			return abort(404);
		}
	}
}
