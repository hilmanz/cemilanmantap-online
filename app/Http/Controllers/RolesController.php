<?php

namespace App\Http\Controllers;

use App\Roles;
use App\Role_users;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class RolesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['roles'])) {
			$roles = Roles::paginate(20);
			return view('back.roles.index', compact('roles'));
		} else {
			return abort(403);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Sentinel::hasAnyAccess(['roles'])) {
			return view('back.roles.add');
		} else {
			return abort(403);
		}
	}
	public function select2(Request $request) {
		$term = $request->q;
		if ($term) {
			$roles = Roles::where('name', 'LIKE', '%'.$term.'%')->limit(5)->get();
		} else {
			$roles = Roles::limit(5)->get();
		}
		return response()->json($roles);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if (Sentinel::hasAnyAccess(['roles'])) {
			$validator = Validator::make($request->all(), [
					'name' => 'required|unique:roles,name,NULL,deleted_at,deleted_at,NULL',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$arrayPermissions = implode(',', $request->get('permissions'));
				$roles            = new Roles([
						'name'        => $request->name,
						'permissions' => '{'.$arrayPermissions.'}',
					]);
				if ($roles        ->save()) {
					return response()->json([
							'status'  => 'success',
							'message' => 'Data Added successfully.',
						]);
				} else {
					return response()->json([
							'status'  => 'errors',
							'message' => 'Data Failed.',
						]);
				}
			}
		} else {
			return abort(403);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		if (Sentinel::hasAnyAccess(['roles'])) {
			$roles = Roles::findOrFail($id);
			$no    = 1;
			return view('back.roles.edit', compact('roles', 'id'));
		} else {
			return abort(403);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['roles'])) {
			$this->validate($request, [
					'name' => 'required|unique:roles,name,'.$id.',id,deleted_at,NULL',
				]);

			$arrayPermissions   = implode(',', $request->get('permissions'));
			$roles              = Roles::findOrFail($id);
			$roles->name        = $request->name;
			$roles->permissions = '{'.$arrayPermissions.'}';
			$roles->slug        = null;
			$roles->update();

			if ($roles) {
				return back()->with('success', 'Data updated');
			} else {
				return back()->with('error', 'Failed');
			}
		} else {
			return abort(403);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['roles'])) {
			$cek = Role_users::where('role_id', '=', $id)->count();
			if ($cek > 0) {
				return redirect()->back()->with('Failed', 'Role used By another user. Please make a change');
			} else {
				$roles = Roles::destroy($id);
				if ($roles) {
					return redirect()->back()->with('success', 'Deleted');
				} else {
					return redirect()->back()->with('Failed', 'Failed');
				}
			}
		} else {
			return abort(403);
		}
	}
}
