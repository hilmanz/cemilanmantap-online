<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class CategoriesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['categories'])) {
			$categories = Categories::paginate(20);
			return view('back.categories.index', compact('categories'));
		} else {
			return abort(403);
		}
	}
	public function select2(Request $request) {
		if (Sentinel::hasAnyAccess(['categories'])) {
			$term = $request->q;
			if ($term) {
				$categories = Categories::where('name', 'LIKE', '%'.$term.'%')->limit(5)->get();
			} else {
				$categories = Categories::limit(5)->get();
			}
			return response()->json($categories);
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
		if (Sentinel::hasAnyAccess(['categories'])) {
			$validator = Validator::make($request->all(), [
					'name'                => 'required|unique:categories,name,NULL,deleted_at,deleted_at,NULL',
					'short_text'          => 'required',
					'categories_abjad_id' => 'required',
					'long_text'           => 'required',
					'categories_abjad_id' => 'required',
					'file_id'             => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$categories = new Categories([
						'name'                => $request->name,
						'short_text'          => $request->short_text,
						'long_text'           => $request->long_text,
						'categories_abjad_id' => $request->categories_abjad_id,
						'media_id'            => $request->file_id,
						'meta_title'          => $request->meta_title,
						'meta_description'    => $request->meta_description,
						'meta_tags'           => $request->meta_tags,
						'created_by'          => Sentinel::getUser()->id,
						'status'              => $request->status,
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
		if (Sentinel::hasAnyAccess(['categories'])) {
			$category = Categories::find($id);
			return view('back.categories.data_edit', compact('category'));
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
		if (Sentinel::hasAnyAccess(['categories'])) {
			$validator = Validator::make($request->all(), [
					'name'                => 'required|unique:categories,name,'.$request->id.',id,deleted_at,NULL',
					'short_text'          => 'required',
					'categories_abjad_id' => 'required',
					'long_text'           => 'required',
					'categories_abjad_id' => 'required',
					'file_id'             => 'required|exists:media,id',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$categories                      = Categories::find($request->id);
				$categories->name                = $request->name;
				$categories->slug                = null;
				$categories->short_text          = $request->short_text;
				$categories->categories_abjad_id = $request->categories_abjad_id;
				$categories->long_text           = $request->long_text;
				$categories->media_id            = $request->file_id;
				$categories->meta_title          = $request->meta_title;
				$categories->meta_description    = $request->meta_description;
				$categories->meta_tags           = $request->meta_tags;
				$categories->created_by          = Sentinel::getUser()->id;
				$categories->status              = $request->status;
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
		if (Sentinel::hasAnyAccess(['categories'])) {
			$id         = $request->id;
			$categories = Categories::destroy($id);
			if ($categories) {
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
