<?php

namespace App\Http\Middleware;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Closure;
use Sentinel;

class AdminMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		if (Sentinel::check()) {
			$cek_role = Sentinel::getUser()->roles()->first()->id;
			$get_user = Sentinel::getUser();
			if ($get_user->status == 1) {
				return $next($request);
			} else {
				return redirect('/login')->with('error', "Account Disabled");
			}
		} else {
			if ($request->ajax()) {
				try {
					return abort(401);
				} catch (ThrottlingException $e) {
					return abort(401);
				} catch (NotActivatedException $e) {
					return abort(401);
				}
			} else {
				return redirect('/login');
			}
		}

	}
}
