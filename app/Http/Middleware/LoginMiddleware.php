<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Closure;
use Sentinel;

class LoginMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		//Sentinel::disableCheckpoints();
		$cek_role   = Sentinel::check() && Sentinel::getUser()->roles()->first()->id;
		$cek_status = Sentinel::getUser();
		try {
			if (!Sentinel::check()) {
				return $next($request);
			} elseif (Sentinel::check()) {
				if ($cek_status->status == '1') {
					return redirect('/');
				} else {
					return $next($request);
				}
			}
		} catch (ThrottlingException $e) {
			$delay = $e->getDelay();
			return redirect('/login')->with('error', "Sorry, Banned for $delay seconds. Suck It!");
		} catch (NotActivatedException $e) {
			return redirect('/login')->with('error', "Your Account Is Not Active!. Check Your Mail Box For Activate ");
		}
	}
}
