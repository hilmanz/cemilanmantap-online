<?php

namespace App\Http\Controllers;

use Activation;
use App\Http\Controllers\Controller;
use App\Users;
use DB;
use Illuminate\Http\Request;
use Sentinel;

class UsersController extends Controller {
	public function index(Request $request) {
		if (Sentinel::hasAnyAccess(['users'])) {
			$users = Users::paginate(50);
			return view('back.users.index', compact('users'));
		} else {
			return abort(403);
		}
	}
	public function create() {
		if (Sentinel::hasAnyAccess(['users'])) {
			return view('back.users.add');
		} else {
			return abort(403);
		}
	}
	private function sendEmail($user, $activationCode) {
		if (Sentinel::hasAnyAccess(['users'])) {
			Mail::send('back.emails.activate', [
					'user' => $user,
					'code' => $activationCode
				], function ($message) use ($user) {
					$message->to($user->email);
					$message->subject("Hello $user->name, Activate Your Account.");
				});
		} else {
			return abort(403);
		}
	}
	public function store(Request $request) {
		if (Sentinel::hasAnyAccess(['users'])) {

			$this->validate($request, [
					'password'              => 'confirmed|required|min:5|max:100',
					'password_confirmation' => 'required|min:5|max:100',
					'email'                 => 'required',
					'username'              => 'required|unique:users,username,NULL,deleted_at,deleted_at,NULL',
					'role_id'               => 'required',
					'status'                => 'required',
				]);
			// Using Sentinel Coy //
			$role_id    = $request->role_id;
			$user       = Sentinel::registerAndActivate($request->all());
			$activation = Activation::create($user);
			$role       = Sentinel::findRoleById($role_id);
			$role->users()->attach($user);
			$id_users = Users::where('email', '=', $request->email)->where('username', '=', $request->username)->first();
			//$this->sendEmail($user, $activation->code);
			return back()->with('success', 'Data Added successfully.');
			// End Sentinel //

		} else {
			return abort(403);
		}

	}
	public function update(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['users'])) {
			$this->validate($request, [
					'email'    => 'required',
					'username' => 'required|unique:users,username,'.$id.',id,deleted_at,NULL',
					'role_id'  => 'required',
					'status'   => 'required',
				]);
			$data           = Users::find($id);
			$data->name     = $request->name;
			$data->username = $request->username;
			$data->email    = $request->email;
			$data->status   = $request->status;
			if ($request->password) {
				$this->validate($request, [
						'password'              => 'confirmed|required|min:5|max:100',
						'password_confirmation' => 'required|min:5|max:100',
					]);
				$data->password = bcrypt($request->password);
			}

			DB::table('role_users')
				->where('user_id', $id)
				->update(['role_id' => $request->role_id]);

			$data->update();
			return back()->with('success', 'Data Updated successfully.');
		} else {
			return abort(403);
		}

	}
	public function delete(Request $request) {
		if (Sentinel::hasAnyAccess(['users'])) {
			$user_id   = $request->id;
			$data_user = Users::destroy($user_id);
			if ($data_user) {
				return back()->with('success', 'Data Delete successfully.');
			} else {
				return back()->with('Failed', 'Data Failed.');
			}
		} else {
			return abort(403);
		}

	}
	public function destroy($id) {
		if (Sentinel::hasAnyAccess(['users'])) {
			$users = Users::destroy($id);
			if ($users) {
				return redirect()->back()->with('success', 'Deleted');
			} else {
				return redirect()->back()->with('success', 'Failed');
			}
		} else {
			return abort(403);
		}
	}
	public function edit($id) {
		if (Sentinel::hasAnyAccess(['users'])) {
			$users = Users::find($id);
			return view('back.users.edit')->with([
					'users' => $users
				]);
		} else {
			return abort(403);
		}
	}
	public function view(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['users'])) {
			$users = Users::find($request->id);
			return view('back.users.view')->with([
					'users' => $users
				]);
		} else {
			return abort(403);
		}
	}
}
