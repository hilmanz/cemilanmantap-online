<?php

namespace App\Http\Controllers;

use App\CategoriesAbjad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class CategoriesAbjadController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['categories_abjad'])) {
			$categories_abjad = CategoriesAbjad::paginate(20);
			return view('back.categoriesAbjad.index', compact('categories_abjad'));
		} else {
			return abort(403);
		}
	}
	public function select2(Request $request) {
		if (Sentinel::hasAnyAccess(['categories_abjad'])) {
			$term = $request->q;
			if ($term) {
				$categories_abjad = CategoriesAbjad::where('name', 'LIKE', '%'.$term.'%')->limit(5)->get();
			} else {
				$categories_abjad = CategoriesAbjad::limit(5)->get();
			}
			return response()->json($categories_abjad);
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
		if (Sentinel::hasAnyAccess(['categories_abjad'])) {
			$validator = Validator::make($request->all(), [
					'name'            => 'required|alpha|max:1|unique:categories_abjad,name,NULL,deleted_at,deleted_at,NULL',
					'mobile_media_id' => 'required|exists:media,id',
					'file_id'         => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$categories = new CategoriesAbjad([
						'name'             => $request->name,
						'media_id'         => $request->file_id,
						'mobile_media_id'  => $request->mobile_media_id,
						'meta_title'       => $request->meta_title,
						'meta_description' => $request->meta_description,
						'meta_tags'        => $request->meta_tags,
						'created_by'       => Sentinel::getUser()->id,
					]);
				if ($categories   ->save()) {
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
		if (Sentinel::hasAnyAccess(['categories_abjad'])) {
			$category_abjad = CategoriesAbjad::find($id);
			return view('back.categoriesAbjad.data_edit', compact('category_abjad'));
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
	public function update(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['categories_abjad'])) {
			$validator = Validator::make($request->all(), [
					'name'            => 'required|alpha|max:1|unique:categories_abjad,name,'.$request->id.',id,deleted_at,NULL',
					'mobile_media_id' => 'required|exists:media,id',
					'file_id'         => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$categories_abjad                   = CategoriesAbjad::find($request->id);
				$categories_abjad->name             = $request->name;
				$categories_abjad->meta_title       = $request->meta_title;
				$categories_abjad->meta_description = $request->meta_description;
				$categories_abjad->meta_tags        = $request->meta_tags;
				$categories_abjad->media_id         = $request->file_id;
				$categories_abjad->mobile_media_id  = $request->mobile_media_id;
				$categories_abjad->created_by       = Sentinel::getUser()->id;
				if ($categories_abjad->update()) {
					return response()   ->json([
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
		if (Sentinel::hasAnyAccess(['categories_abjad'])) {
			$id               = $request->id;
			$categories_abjad = CategoriesAbjad::destroy($id);
			if ($categories_abjad) {
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
