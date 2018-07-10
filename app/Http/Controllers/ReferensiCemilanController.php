<?php

namespace App\Http\Controllers;

use App\ReferensiCemilan;
use App\ReferensiCemilanRoleMedia;
use App\Foods;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FoodsController;
use App\Media;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Sentinel;
use Validator;

class ReferensiCemilanController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['referensiCemilan'])) {
			$referensi_cemilan = ReferensiCemilan::orderBy('created_at', 'DESC')->paginate(20);
			return view('back.referensi_cemilan.index', compact('referensi_cemilan'));
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
		if ($request->hasFile('filename')) {
			$validator = Validator::make($request->all(), [
					'name'      => 'required|',
					'lokasi'     => 'required',
					'filename.*' => 'required|mimes:jpeg,bmp,png,gif|max:1000|dimensions:min_width=150,min_height=150,max_width=10000,max_height=5000',
				]);
		} else {
			$validator = Validator::make($request->all(), [
					'name'   => 'required|',
					'lokasi'  => 'required',
				]);
		}
		if ($validator    ->fails()) {
			return response()->json([
					'status'  => 'errors',
					'message' => $validator->getMessageBag()->toArray()
				]);
		} else {

			$referensi_cemilan             = New ReferensiCemilan;
			$referensi_cemilan->name       = $request->name;
			$referensi_cemilan->lokasi = $request->lokasi;
			$referensi_cemilan->harga  = $request->harga;
			$referensi_cemilan->review_text   = $request->review_text;
			if(Sentinel::check()){
				$referensi_cemilan->created_by = Sentinel::getUser()->id;
			}else{
				$referensi_cemilan->created_by = null;
			}

			if ($referensi_cemilan->save()) {
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
						if(Sentinel::check()){
							$files->created_by = Sentinel::getUser()->id;
						}else{
							$files->created_by = null;
						}
						$files->save();

						$referensi_media             = new ReferensiCemilanRoleMedia;
						$referensi_media->referensi_cemilan_id = $referensi_cemilan->id;
						$referensi_media->media_id   = $files->id;
						$referensi_media->save();
					}
				}
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
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		if (Sentinel::hasAnyAccess(['referensiCemilan'])) {
			$referensi_cemilan = ReferensiCemilan::find($id);
			return view('back.referensi_cemilan.data_view', compact('referensi_cemilan'));
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

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['referensiCemilan'])) {
			$id       = $request->id;
			$referensi_cemilan = ReferensiCemilan::destroy($id);
			if ($referensi_cemilan) {
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
