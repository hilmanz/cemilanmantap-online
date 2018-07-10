<?php

namespace App\Http\Controllers;
use App\HomeSliders;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class HomeSlidersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['homeSliders'])) {
			$home_sliders = HomeSliders::paginate(2);
			return view('back.home_sliders.index', compact('home_sliders'));
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if (Sentinel::hasAnyAccess(['homeSliders'])) {
			$validator = Validator::make($request->all(), [
					'name'            => 'required',
					'status'          => 'required',
					'file_id'         => 'required|exists:media,id',
					'mobile_media_id' => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$home_sliders = new HomeSliders([
						'name'            => $request->name,
						'status'          => $request->status,
						'media_id'        => $request->file_id,
						'mobile_media_id' => $request->mobile_media_id,
						'created_by'      => Sentinel::getUser()->id,
					]);
				if ($home_sliders ->save()) {
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
		if (Sentinel::hasAnyAccess(['homeSliders'])) {
			$home_sliders = HomeSliders::find($id);
			return view('back.home_sliders.data_edit', compact('home_sliders'));
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
		if (Sentinel::hasAnyAccess(['homeSliders'])) {
			$validator = Validator::make($request->all(), [
					'name'            => 'required',
					'status'          => 'required',
					'file_id'         => 'required|exists:media,id',
					'mobile_media_id' => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$home_sliders                  = HomeSliders::find($id);
				$home_sliders->name            = $request->name;
				$home_sliders->status          = $request->status;
				$home_sliders->media_id        = $request->file_id;
				$home_sliders->mobile_media_id = $request->mobile_media_id;
				$home_sliders->created_by      = Sentinel::getUser()->id;
				if ($home_sliders ->save()) {
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		if (Sentinel::hasAnyAccess(['homeSliders'])) {
			$home_sliders = HomeSliders::destroy($id);
			if ($home_sliders) {
				return redirect()->back()->with('success', 'Deleted');
			} else {
				return redirect()->back()->with('success', 'Failed');
			}
		} else {
			return abort(403);
		}
	}
}
