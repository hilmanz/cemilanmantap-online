<?php

namespace App\Http\Controllers;

use App\Comments;
use App\CommentsRoleMedia;
use App\Foods;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FoodsController;
use App\Media;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Sentinel;
use Validator;

class CommentsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['comments'])) {
			$comments = Comments::orderBy('created_at', 'DESC')->paginate(20);
			return view('back.comments.index', compact('comments'));
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
		if (Sentinel::hasAnyAccess(['comments'])) {
			if ($request->hasFile('filename')) {
				$validator = Validator::make($request->all(), [
						'title'      => 'required|',
						'rating'     => 'required',
						'text'       => 'required',
						'status'     => 'required',
						'food_id'    => 'required|exists:foods,id',
						'filename.*' => 'required|mimes:jpeg,bmp,png,gif|max:1000|dimensions:min_width=150,min_height=150,max_width=10000,max_height=5000',
					]);
			} else {
				$validator = Validator::make($request->all(), [
						'title'   => 'required|',
						'rating'  => 'required',
						'text'    => 'required',
						'status'  => 'required',
						'food_id' => 'required|exists:foods,id',
					]);
			}
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {

				$comments = new Comments([
						'title'   => $request->title,
						'food_id' => $request->food_id,
						'rating'  => $request->rating,
						'text'    => $request->text,
						'user_id' => Sentinel::getUser()->id,
						'status'  => $request->status,
					]);
				if ($comments->save()) {
					if ($request->hasFile('filename')) {
						$jmlh_media = count($request->filename);
						for ($i = 0; $i < $jmlh_media; $i++) {
							$thumbnail = "media/thumbnail/";
							$originals = "media/originals/";

							$fileimage[$i] = $request['filename'][$i];
							//$filename  = $request->code.'_'.$fileimage->getClientOriginalName();
							$filename[$i] = date('Ymdhms').$i.'.'.$fileimage[$i]->extension();
							//Resize cover
							$image_thumbnail[$i] = Image::make($fileimage[$i]->getRealPath())->fit(500, 500);
							File::makeDirectory($thumbnail, $mode = 0777, true, true);
							$image_thumbnail[$i]->save($thumbnail.$filename[$i]);
							// originals Image
							$fileimage[$i]->move($originals, $filename[$i]);
							// save into library
							$files             = new Media;
							$files->filename   = $filename[$i];
							$files->cover      = $filename[$i];
							$files->name       = $filename[$i];
							$files->type       = 'image';
							$files->link       = null;
							$files->created_by = Sentinel::getUser()->id;
							$files->save();

							$comments_media             = new CommentsRoleMedia;
							$comments_media->comment_id = $comments->id;
							$comments_media->media_id   = $files->id;
							$comments_media->save();
						}
					}

					$foods         = Foods::find($request->food_id);
					$foods->rating = FoodsController::rating_food($request->food_id)['total_rating'];
					$foods->save();

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
		if (Sentinel::hasAnyAccess(['comments'])) {
			$comments = Comments::find($id);
			return view('back.comments.data_view', compact('comments'));
		} else {
			return abort(403);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	public function update_status(Request $request) {
		if (Sentinel::hasAnyAccess(['comments'])) {
			$comments         = Comments::find($request->id);
			$comments->status = $request->status;
			if ($comments     ->update()) {
				return redirect()->back()->with('success', 'Status Updated');
			} else {
				return redirect()->back()->with('errors', 'Failed Update Status');
			}
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
		if (Sentinel::hasAnyAccess(['comments'])) {
			$validator = Validator::make($request->all(), [
					'name'       => 'required|unique:categories,name,'.$request->id.',id,deleted_at,NULL',
					'short_text' => 'required',
					'long_text'  => 'required',
					'file_id'    => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$categories             = Categories::find($request->id);
				$categories->name       = $request->name;
				$categories->slug       = null;
				$categories->short_text = $request->short_text;
				$categories->long_text  = $request->long_text;
				$categories->media_id   = $request->file_id;
				$categories->created_by = Sentinel::getUser()->id;
				$categories->status     = $request->status;
				if ($categories   ->update()) {
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
	public function destroy(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['comments'])) {
			$id       = $request->id;
			$comments = Comments::destroy($id);
			if ($comments) {
				//$specifications = Specifications::whereIn('images_id', $id)->delete();
				return back()->with('success', 'Deleted');
			} else {
				return back()->with('Failed', 'Deleted');
			}
		} else {
			return abort(403);
		}
	}
}
