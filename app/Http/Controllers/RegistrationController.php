<?php
namespace App\Http\Controllers;
use Activation;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationEmail;
use App\Users;

use Illuminate\Http\Request;
use Mail;
use Sentinel;

class RegistrationController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct()
	// {
	//     $this->middleware('auth');
	// }

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('front.signup.index');
	}
	private function sendEmail($user, $activationCode) {
		Mail::send('front.email.activate', [
				'user' => $user,
				'code' => $activationCode
			], function ($message) use ($user) {
				$message->to($user->email);
				$message->subject("Hello $user->name, Activate Your Account.");
			});
	}
	public function add(Request $request) {
		$this->validate($request, [
				'password'              => 'confirmed|required|min:5',
				'password_confirmation' => 'required|min:5',
				'name'                  => 'required',
				'company'               => 'required',
				'email'                 => 'required|email|unique:users,email,NULL,deleted_at,deleted_at,NULL',
				'username'              => 'required|unique:users,username,NULL,deleted_at,deleted_at,NULL',
			]);
		$user_role = 2;
		$user      = Sentinel::register(
			array(
				'email'    => $request->email,
				'password' => $request->password,
				'name'     => $request->name,
				'company'  => $request->company,
				'username' => $request->username,
				'position' => $request->position,
				'status'   => 1,
			));
		$activation = Activation::create($user);
		$role       = Sentinel::findRoleById($user_role);
		$role->users()->attach($user);
		dispatch(new SendVerificationEmail($user, $activation->code));
		return redirect('/login')->with('success', 'Data Added successfully. Please Check Your Email For Activation');

		//$this->sendEmail($user, $activation->code);
	}
	public function re_send_activation($email) {
		$user = Users::whereEmail($email)->first();
		if (count($user) > 0) {
			$user_id       = $user->id;
			$user_sentinel = Sentinel::findById($user_id);
			$activation    = Activation::create($user_sentinel);
			dispatch(new SendVerificationEmail($user, $activation->code));
			return redirect('/login')->with('success', 'Data Added successfully. Please Check Your Email For Activation');

		}
	}
	public function reminder() {
		$user = Users::all();
		$date = date('d/M/Y');
		Mail::send('front.email.remainder', [
				'user' => $user
			], function ($message) use ($user, $date) {
				foreach ($user as $user) {
					$message->from('info@genjer.com', 'Timesheet Reminder ');
					$message->to($user->email);
					$message->subject("Timesheet Reminder $date");

				}
			});

	}
	public function activate($email, $activationCode) {
		$user         = users::whereEmail($email)->first();
		$sentinelUser = Sentinel::findById($user->id);
		if (Activation::complete($sentinelUser, $activationCode)) {
			return redirect('login')->with('success', 'Your account is active. Please Login');
		} else {
			return abort(404);
		}
	}
}
