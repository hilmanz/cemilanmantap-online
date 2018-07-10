<?php

namespace App\Http\Controllers;
use App\Videos;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class VideosController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['videos'])) {
			$videos = Videos::paginate(15);
			return view('back.videos.index', compact('videos'));
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
		if (Sentinel::hasAnyAccess(['videos'])) {
			$validator = Validator::make($request->all(), [
					'name'    => 'required',
					'status'  => 'required',
					'text'    => 'required',
					'file_id' => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$videos = new Videos([
						'name'       => $request->name,
						'text'       => $request->text,
						'status'     => $request->status,
						'created_by' => Sentinel::getUser()->id,
						'media_id'   => $request->file_id,
					]);
				if ($videos       ->save()) {
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
		if (Sentinel::hasAnyAccess(['videos'])) {
			$videos = Videos::find($id);
			return view('back.videos.data_edit', compact('videos'));
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
		if (Sentinel::hasAnyAccess(['videos'])) {
			$validator = Validator::make($request->all(), [
					'name'    => 'required',
					'status'  => 'required',
					'text'    => 'required',
					'file_id' => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$videos             = Videos::find($id);
				$videos->name       = $request->name;
				$videos->text       = $request->text;
				$videos->status     = $request->status;
				$videos->media_id   = $request->file_id;
				$videos->created_by = Sentinel::getUser()->id;
				if ($videos       ->save()) {
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
		if (Sentinel::hasAnyAccess(['videos'])) {
			$home_sliders = Videos::destroy($id);
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
