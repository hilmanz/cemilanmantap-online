<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Foods;
use App\FoodsRoleCategories;
use App\FoodsRoleMedia;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class FoodsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $keyword = null) {
		if (Sentinel::hasAnyAccess(['foods'])) {
			$term = $request->keyword;
			if ($term) {
				$foods      = Foods::where('title', 'LIKE', '%'.$term.'%')->orWhere('contributor', 'LIKE', '%'.$term.'%')->paginate(10);
				$categories = FoodsRoleCategories::selectRaw('foods_role_categories.*, count(category_id) as count')
					->groupBy('foods_role_categories.category_id')
					->get();
				$comments = Comments::limit(5)->orderBy('created_at', 'DESC')->get();
				$foods->appends($request->only('keyword'));
				return view('back.foods.index', compact('foods', 'categories', 'comments', 'rating_food', 'term'));
			} else {
				$foods      = Foods::paginate(10);
				$categories = FoodsRoleCategories::selectRaw('foods_role_categories.*, count(category_id) as count')
					->groupBy('foods_role_categories.category_id')
					->get();
				$comments = Comments::limit(5)->orderBy('created_at', 'DESC')->get();
				return view('back.foods.index', compact('foods', 'categories', 'comments', 'rating_food'));
			}
		} else {
			return abort(403);
		}
	}
	public function select2(Request $request) {
		if (Sentinel::hasAnyAccess(['foods'])) {
			$term = $request->q;
			if ($term) {
				$foods = Foods::where('title', 'LIKE', '%'.$term.'%')->limit(5)->get();
			} else {
				$foods = Foods::limit(5)->get();
			}
			return response()->json($foods);
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
		if (Sentinel::hasAnyAccess(['foods'])) {
			$validator = Validator::make($request->all(), [
					'title'             => 'required|unique:foods,title,NULL,deleted_at,deleted_at,NULL',
					'media_id'          => 'required|exists:media,id',
					'store_id'          => 'required|exists:stores,id',
					'short_text'        => 'required|max:300',
					'text'              => 'required',
					'price'             => 'required|numeric',
					'status'            => 'required',
					'status_recomended' => 'required',
					'contributor'       => 'required',
					'category_id.*'     => 'required',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$foods                    = new Foods;
				$foods->title             = $request->title;
				$foods->price             = $request->price;
				$foods->short_text        = $request->short_text;
				$foods->text              = $request->text;
				$foods->media_id          = $request->media_id;
				$foods->store_id          = $request->store_id;
				$foods->status            = $request->status;
				$foods->contributor       = $request->contributor;
				$foods->status_recomended = $request->status_recomended;
				$foods->meta_title        = $request->meta_title;
				$foods->meta_description  = $request->meta_description;
				$foods->meta_tags         = $request->meta_tags;
				$foods->created_by        = Sentinel::getUser()->id;
				if ($foods->save()) {
					if ($request->category_id) {
						$jmlh = count($request->category_id);
						for ($i = 0; $i < $jmlh; $i++) {
							$categories              = new FoodsRoleCategories;
							$categories->category_id = $request['category_id'][$i];
							$categories->food_id     = $foods->id;
							$categories->save();
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
		} else {
			return abort(403);
		}
	}

	public function food_photos(Request $request) {
		if (Sentinel::hasAnyAccess(['foods'])) {
			$this->validate($request, [
					'media_id' => 'required|exists:media,id',
					'food_id'  => 'required|exists:foods,id',
				]);
			$jmlh = count($request->media_id);
			for ($i = 0; $i < $jmlh; $i++) {
				$photos           = new FoodsRoleMedia;
				$photos->media_id = $request['media_id'][$i];
				$photos->food_id  = $request->food_id;
				$photos->save();
			}
			return redirect()->back()->with('success', 'Updated');
		} else {
			return abort(403);
		}

	}
	public function get_food_photos(Request $request, $food_id) {
		if (Sentinel::hasAnyAccess(['mediaLibrary'])) {
			$photos = FoodsRoleMedia::where('food_id', $food_id)->paginate(10);
			if ($request->ajax()) {
				return view('back.foods.food_photos', compact('photos'));
			}
			return view('back.foods.food_photos', compact('photos'));
		} else {
			return abort(403);
		}
	}
	public function get_food_comments(Request $request, $food_id) {
		if (Sentinel::hasAnyAccess(['comments'])) {
			$comments = Comments::where('food_id', $food_id)->orderBy('created_at', 'DESC')->paginate(10);
			if ($request->ajax()) {
				return view('back.foods.food_comments', compact('comments', 'comments_media'));
			}
			return view('back.foods.food_comments', compact('comments'));
		} else {
			return abort(403);
		}
	}
	public function get_food_rating(Request $request, $food_id) {
		if (Sentinel::hasAnyAccess(['foods'])) {
			$count_comments = Comments::where('food_id', $food_id)->count();
			$one_stars      = Comments::where('food_id', $food_id)->where('rating', '1')->count();
			$two_stars      = Comments::where('food_id', $food_id)->where('rating', '2')->count();
			$three_stars    = Comments::where('food_id', $food_id)->where('rating', '3')->count();
			$four_stars     = Comments::where('food_id', $food_id)->where('rating', '4')->count();
			$five_stars     = Comments::where('food_id', $food_id)->where('rating', '5')->count();
			$rating_food    = $this->rating_food($food_id);
			return view('back.foods.food_rating', compact('count_comments', 'stars', 'one_stars', 'two_stars', 'three_stars', 'four_stars', 'five_stars', 'rating_food'));
		} else {
			return abort(403);
		}
	}
	public static function rating_food($food_id) {
		$count_comments = Comments::where('food_id', $food_id)->count();
		if ($count_comments > 0) {
			$one_stars    = Comments::where('food_id', $food_id)->where('rating', '1')->count();
			$two_stars    = Comments::where('food_id', $food_id)->where('rating', '2')->count();
			$three_stars  = Comments::where('food_id', $food_id)->where('rating', '3')->count();
			$four_stars   = Comments::where('food_id', $food_id)->where('rating', '4')->count();
			$five_stars   = Comments::where('food_id', $food_id)->where('rating', '5')->count();
			$total_rating = number_format((($five_stars*5)+($four_stars*4)+($three_stars*3)+($two_stars*2)+($one_stars*1))/$count_comments, 1);
			$result       = ([
					'total_rating'  => $total_rating,
					'total_comment' => $count_comments,
				]);
		} else {
			$result = ([
					'total_rating'  => 0,
					'total_comment' => $count_comments,
				]);
		}
		return $result;
	}
	public static function count_comments($food_id) {
		$result = Comments::where('food_id', $food_id)->count();
		return $result;
	}
	public function food_photos_delete(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['foods'])) {
			$food_role_media = FoodsRoleMedia::destroy($request->id);
			if ($food_role_media) {
				return redirect()->back()->with('success', 'Deleted');
			} else {
				return redirect()->back()->with('success', 'Failed');
			}
		} else {
			return abort(403);
		}
	}
	public function food_comment_delete(Request $request, $comment_id) {
		if (Sentinel::hasAnyAccess(['comments'])) {
			$comments = Comments::destroy($request->id);
			if ($comments) {
				return redirect()->back()->with('success', 'Deleted');
			} else {
				return redirect()->back()->with('success', 'Failed');
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
		if (Sentinel::hasAnyAccess(['foods'])) {
			$foods      = Foods::find($id);
			$categories = FoodsRoleCategories::selectRaw('foods_role_categories.*, count(category_id) as count')
				->where('foods_role_categories.food_id', $id)
				->groupBy('foods_role_categories.category_id')
				->get();
			return view('back.foods.detail', compact('foods', 'categories'));
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
	public function edit(Request $request, $id) {
		if (Sentinel::hasAnyAccess(['foods'])) {
			$foods                 = Foods::find($id);
			$foods_role_categories = FoodsRoleCategories::where('food_id', '=', $id)->get();
			return view('back.foods.data_edit', compact('foods', 'foods_role_categories'));
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
		if (Sentinel::hasAnyAccess(['foods'])) {
			$this->validate($request, [
					'title'             => 'required|unique:foods,title,'.$id.',id,deleted_at,NULL',
					'media_id'          => 'required|exists:media,id',
					'store_id'          => 'required|exists:stores,id',
					'short_text'        => 'required|max:300',
					'text'              => 'required',
					'price'             => 'required|numeric',
					'status'            => 'required',
					'status_recomended' => 'required',
					'contributor'       => 'required',
					'category_id.*'     => 'required',
				]);
			$foods                    = Foods::find($id);
			$foods->title             = $request->title;
			$foods->price             = $request->price;
			$foods->short_text        = $request->short_text;
			$foods->text              = $request->text;
			$foods->media_id          = $request->media_id;
			$foods->store_id          = $request->store_id;
			$foods->status            = $request->status;
			$foods->contributor       = $request->contributor;
			$foods->status_recomended = $request->status_recomended;
			$foods->meta_title        = $request->meta_title;
			$foods->meta_description  = $request->meta_description;
			$foods->meta_tags         = $request->meta_tags;
			$foods->slug              = null;
			$foods->created_by        = Sentinel::getUser()->id;
			if ($foods->save()) {
				if ($request->category_id) {
					$delete = FoodsRoleCategories::where('food_id', '=', $foods->id)->forcedelete();
					if ($delete) {
						$jmlh = count($request->category_id);
						for ($i = 0; $i < $jmlh; $i++) {
							$categories              = new FoodsRoleCategories;
							$categories->category_id = $request['category_id'][$i];
							$categories->food_id     = $foods->id;
							$categories->save();
						}
					}
				}
				return redirect()->back()->with('success', 'Updated');
			} else {
				return redirect()->back()->with('errors', 'Failed Updated');
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
		if (Sentinel::hasAnyAccess(['foods'])) {
			$foods = Foods::destroy($id);
			if ($foods) {
				return redirect()->back()->with('success', 'Deleted');
			} else {
				return redirect()->back()->with('success', 'Failed');
			}
		} else {
			return abort(403);
		}
	}
}
