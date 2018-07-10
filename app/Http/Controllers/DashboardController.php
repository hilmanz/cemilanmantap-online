<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Comments;
use App\Foods;
use App\Media;
use App\Subscribers;
use App\Users;

use Illuminate\Http\Request;
use Sentinel;

class DashboardController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Sentinel::hasAnyAccess(['dashboard'])) {
			$count_users            = Users::count();
			$count_subscribers      = Subscribers::count();
			$count_media_image      = Media::where('type', '=', 'image')->count();
			$count_media_video      = Media::where('type', '=', 'video')->count();
			$foods                  = Foods::orderBy('id', 'DESC')->limit(10)->get();
			$count_foods            = Foods::count();
			$count_categories_foods = Categories::count();
			$food_categories        = Categories::orderBy('id', 'DESC')->limit(10)->get();
			return view('back.dashboard.index',
				compact(
					'count_users',
					'count_subscribers',
					'count_categories',
					'count_media_image',
					'count_media_video',
					'count_foods',
					'foods',
					'count_categories_foods',
					'food_categories'
				)
			);
		} else {
			return abort(403);
		}
	}
	public function topreviewer() {
		$result = Comments::with(['user'])->leftJoin('users', 'users.id', '=', 'comments.user_id')
		                                  ->selectRaw('comments.*, count(comments.user_id) as count')
		                                  ->groupBy('users.id')
		                                  ->limit(5)
		                                  ->orderBy('count', 'DESC')
		                                  ->get();
		return response()->json($result);
	}
	public function toptrandingtopic() {
		$result = Comments::with(['food'])->leftJoin('foods', 'foods.id', '=', 'comments.food_id')
		                                  ->selectRaw('comments.*, count(comments.food_id) as count')
		                                  ->groupBy('foods.id')
		                                  ->limit(5)
		                                  ->orderBy('count', 'DESC')
		                                  ->get();
		return response()->json($result);
	}
	public function toprating() {
		$result = Foods::selectRaw('foods.*, foods.rating as rating')
			->groupBy('foods.id')
			->limit(5)
			->orderBy('rating', 'DESC')
			->get();
		return response()->json($result);
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
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
