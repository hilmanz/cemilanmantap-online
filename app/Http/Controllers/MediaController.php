<?php

namespace App\Http\Controllers;

use App\Media;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Sentinel;
use Validator;

class MediaController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			if (Empty($request->q)) {
				$media = Media::paginate(16);
			} else {
				$media = Media::where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);
			}
			if ($request->ajax()) {
				return view('back.media.list', compact('media'));
			}
			return view('back.media.index', compact('media'));
		} else {
			return abort(403);
		}
	}
	public function modal_multiple_list(Request $request) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			if (Empty($request->q)) {
				if ($request->type) {
					$media = Media::where('type', $request->type)->paginate(16);
				} else {
					$media = Media::paginate(16);
				}
			} else {
				if ($request->type) {
					$media = Media::where('type', $request->type)->where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);
				} else {
					$media = Media::where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);
				}
			}
			if ($request->ajax()) {
				return view('back.media.list_multiple_modal', compact('media'));
			}
			return view('back.media.list_multiple_modal', compact('media'));
		} else {
			return abort(403);
		}
	}
	public function modal_list(Request $request) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			if (Empty($request->q)) {
				if ($request->type) {
					$media = Media::where('type', $request->type)->paginate(16);
				} else {
					$media = Media::paginate(16);
				}
			} else {
				if ($request->type) {
					$media = Media::where('type', $request->type)->where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);
				} else {
					$media = Media::where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);
				}
			}
			if ($request->ajax()) {
				return view('back.media.list_modal', compact('media'));
			}
			return view('back.media.list_modal', compact('media'));
		} else {
			return abort(403);
		}
	}
	public function choose_media($id, Request $request) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$media = Media::find($id);
			if ($request      ->ajax()) {
				return response()->json([
						'status'   => 'success',
						'filename' => $media->filename,
						'name'     => $media->name,
						'type'     => $media->type,
						'id'       => $media->id,
					]);
			}
		} else {
			return abort(403);
		}
	}
	public function choose_multiple_media(Request $request) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$get_media = Media::whereIn('id', $request->data)->get();
			$filename  = array();
			foreach ($get_media as $data) {
				$filename[] = $data->filename;
			}
			if ($request      ->ajax()) {
				return response()->json([
						'status'   => 'success',
						'filename' => $filename,
						'count'    => $get_media->count()
					]);
			}
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
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$validator = Validator::make($request->all(), [
					'type'     => 'required',
					'name'     => 'required',
					'link'     => 'required_if:type,video',
					'filename' => 'required|image|mimes:jpeg,bmp,png,gif|max:1000',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				//Cover
				$thumbnail = "media/thumbnail/";
				$originals = "media/originals/";

				$fileimage = $request->filename;
				//$filename  = $request->code.'_'.$fileimage->getClientOriginalName();
				$filename = $request->filename->hashName();
				//Resize cover
				$image_thumbnail = Image::make($fileimage->getRealPath())->fit(500, 500);
				File::makeDirectory($thumbnail, $mode = 0777, true, true);
				$image_thumbnail->save($thumbnail.$filename);
				// originals Image
				$fileimage->move($originals, $filename);
				// save into library
				$files             = new Media;
				$files->filename   = $filename;
				$files->cover      = $filename;
				$files->name       = $request->name;
				$files->type       = $request->type;
				$files->link       = $request->link;
				$files->created_by = Sentinel::getUser()->id;
				if ($files        ->save()) {
					return response()->json([
							'status'  => 'success',
							'message' => 'Data Added successfully.',
						]);
				} else {
					return response()->json([
							'status'  => 'Failed',
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
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$media = Media::find($id);
			return view('back.media.data_edit', compact('media'));
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
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$validator = Validator::make($request->all(), [
					'type' => 'required',
					'name' => 'required',
					'link' => 'required_if:type,video',
				]);
			if ($request->filename) {
				$validator = Validator::make($request->all(), [
						'filename' => 'required|mimes:jpeg,bmp,png|max:1000',
					]);
			}
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$files = Media::find($id);
				if ($request->filename) {
					$thumbnail = "media/thumbnail/";
					$originals = "media/originals/";

					$fileimage = $request->filename;
					//$filename  = $request->code.'_'.$fileimage->getClientOriginalName();
					$filename = $request->filename->hashName();
					//Resize cover
					$image_thumbnail = Image::make($fileimage->getRealPath())->fit(500, 500);
					File::makeDirectory($thumbnail, $mode = 0777, true, true);
					$image_thumbnail->save($thumbnail.$filename);
					// originals Image
					$fileimage->move($originals, $filename);
					// save into library
					$files->filename = $filename;
					$files->cover    = $filename;
				}
				$files->name = $request->name;
				$files->type = $request->type;
				$files->link = $request->link;
				if ($files        ->update()) {
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

	public function multi_delete(Request $request) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$id    = $request->id;
			$media = Media::destroy($id);
			if ($media) {
				//$specifications = Specifications::whereIn('images_id', $id)->delete();
				return back()->with('success', 'Deleted');
			} else {
				return back()->with('Failed', 'Failed');
			}
		} else {
			return abort(403);
		}
	}
	public function destroy($id) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$id    = $request->id;
			$media = Media::destroy($id);
			if ($media) {
				//$specifications = Specifications::whereIn('images_id', $id)->delete();
				return back()->with('success', 'Deleted');
			} else {
				return back()->with('Failed', 'Failed');
			}
		} else {
			return abort(403);
		}
	}
}
