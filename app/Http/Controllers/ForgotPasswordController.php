<?php
namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;
use Mail;
use Reminder;
use Sentinel;

class ForgotPasswordController extends Controller {
	public function index() {
		return view('front.forgotPassword.forgotPassword');
	}
	private function sendEmail($user, $code) {
		Mail::send('front.email.forgot-password', [
				'user' => $user,
				'code' => $code
			], function ($message) use ($user) {
				$message->to($user->email);
				$message->subject("Hello $user->name, Reset Your Password.");
			});
	}
	public function postForgotPassword(Request $request) {
		//dd($request->email);
		try {
			$user = Users::whereEmail($request->email)->first();
			if (count($user) > 0) {
				//dd($user_sentinel);
				//return redirect()->back()->with('success', "Reset Code was Sent to Your Email ");
				$user_id       = $user->id;
				$user_sentinel = Sentinel::findById($user_id);
				$reminder      = Reminder::exists($user_sentinel)?:Reminder::create($user_sentinel);
				$this->sendEmail($user, $reminder->code);
				return redirect()->back()->with('success', "Reset Code was Sent to Your Email ");
			} else {
				return redirect()->back()->with('error', "Wrong Email!. Please Type Right Email ");
			}
		} catch (ErrorException $e) {
			return redirect()->back()->with('error', "Wrong Email!. Please Type Right Email ");
		}

	}
	public function resetPassword($email, $resetCode) {
		$this->validate($request, [
				'password'              => 'confirmed|required|min:5',
				'password_confirmation' => 'required|min:5',
			]);
		$user = Users::byEmail($email);
		if (count($user) == 0) {
			abort(404);
		} else {
			$user_id       = $user->id;
			$user_sentinel = Sentinel::findById($user_id);
			$reminder      = Reminder::exists($user_sentinel)?:Reminder::create($user_sentinel);
			if ($resetCode == $reminder->code) {
				return view('front.forgotPassword.reset-password');
			} else {
				return abort(404);
			}
		}
	}
	public function postResetPassword(Request $request, $email, $resetCode) {
		$this->validate($request, [
				'password'              => 'confirmed|required|min:5',
				'password_confirmation' => 'required|min:5',
			]);
		$user = Users::byEmail($email);

		if (count($user) == 0) {
			abort(404);
		} else {
			$user_id       = $user->id;
			$user_sentinel = Sentinel::findById($user_id);
			$reminder      = Reminder::exists($user_sentinel)?:Reminder::create($user_sentinel);
			if ($resetCode == $reminder->code) {
				Reminder::complete($user_sentinel, $resetCode, $request->password);
				return redirect('/login')->with('success', 'Please Login With Your New Password');
			} else {
				return 'Fuck';
			}
		}
	}
}
