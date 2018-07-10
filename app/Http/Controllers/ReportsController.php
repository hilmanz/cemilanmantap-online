<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Foods;
use App\Media;
use App\Users;
use Excel;
use Illuminate\Http\Request;
use Sentinel;

class ReportsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function reviewers(Request $request) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$reviewers = Comments::with(['user', 'comments_role_media'])
				->leftJoin('users', 'users.id', '=', 'comments.user_id')
				->leftJoin('comments_role_media', 'comments.id', '=', 'comments_role_media.comment_id')
				->selectRaw('comments.*, count(comments.user_id) as count, count(comments_role_media.comment_id) as total_media')
				->groupBy('users.id')
				->orderBy('count', 'DESC')
				->paginate(10);
			return view('back.reports.reviewers', compact('reviewers'));
		} else {
			return abort(403);
		}
	}
	public function contributors(Request $request) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$contributors = Foods::with(['user', 'media'])
				->leftJoin('users', 'users.id', '=', 'foods.created_by')
				->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
				->selectRaw('foods.*, count(foods.created_by) as count')
				->where('role_users.role_id', 1)
				->groupBy('foods.created_by')
				->orderBy('count', 'DESC')
				->paginate(10);
			return view('back.reports.contributors', compact('contributors'));
		} else {
			return abort(403);
		}
	}
	public function reviewers_detail($user_id) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$user_comments = Comments::where('user_id', $user_id)->orderBy('id', 'DESC')->paginate(10);
			return view('back.reports.detail_reviewers', compact('user_comments', 'user_id'));
		} else {
			return abort(403);
		}
	}
	public function contributors_detail($user_id) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$user_foods = Foods::where('created_by', $user_id)->orderBy('id', 'DESC')->paginate(10);
			return view('back.reports.detail_contributors', compact('user_foods', 'user_id'));
		} else {
			return abort(403);
		}
	}
	public function print_reviewers_detail(Request $request) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$this->validate($request, [
					'date_from'  => 'required',
					'date_until' => 'required'
				]);
			$date_from     = $request->date_from;
			$date_until    = $request->date_until;
			$user          = Users::find($request->user_id);
			$user_comments = Comments::where('user_id', $request->user_id)
			                                                    ->whereBetween('comments.created_at', [$date_from, $date_until])
			                                                    ->orderBy('id', 'DESC')
			                                                    ->get();
			$print_excel = Excel::create(date('d-m-Y H:m:s'), function ($excel)
				 use (
					$date_from,
					$date_until,
					$user_comments,
					$user
				) {
					$excel->sheet('New sheet', function ($sheet)
						 use (
							$date_from,
							$date_until,
							$user_comments,
							$user
						) {
							$sheet->loadView('back.reports.print_reviewers_detail',
								[
									'date_from'     => $date_from,
									'date_until'    => $date_until,
									'user_comments' => $user_comments,
									'user'          => $user
								]
							);
						});
				});
			return $print_excel->download('csv');
		} else {
			return abort(403);
		}
	}
	public function print_contributors_detail(Request $request) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$this->validate($request, [
					'date_from'  => 'required',
					'date_until' => 'required'
				]);
			$date_from  = $request->date_from;
			$date_until = $request->date_until;
			$user       = Users::find($request->user_id);
			$user_foods = Foods::where('created_by', $request->user_id)
			                                                 ->whereBetween('foods.created_at', [$date_from, $date_until])
			                                                 ->orderBy('id', 'DESC')
			                                                 ->get();
			$print_excel = Excel::create(date('d-m-Y H:m:s'), function ($excel)
				 use (
					$date_from,
					$date_until,
					$user_foods,
					$user
				) {
					$excel->sheet('New sheet', function ($sheet)
						 use (
							$date_from,
							$date_until,
							$user_foods,
							$user
						) {
							$sheet->loadView('back.reports.print_contributors_detail',
								[
									'date_from'  => $date_from,
									'date_until' => $date_until,
									'user_foods' => $user_foods,
									'user'       => $user
								]
							);
						});
				});
			return $print_excel->download('csv');
		} else {
			return abort(403);
		}
	}
	public function print_reviewers(Request $request) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$this->validate($request, [
					'date_from'  => 'required',
					'date_until' => 'required'
				]);
			$date_from  = $request->date_from;
			$date_until = $request->date_until;
			$reviewers  = Comments::with(['user', 'comments_role_media'])
				->leftJoin('users', 'users.id', '=', 'comments.user_id')
				->leftJoin('comments_role_media', 'comments.id', '=', 'comments_role_media.comment_id')
				->selectRaw('comments.*, count(comments.user_id) as count, count(comments_role_media.comment_id) as total_media')
				->whereBetween('comments.created_at', [$date_from, $date_until])
				->groupBy('users.id')
				->orderBy('count', 'DESC')
				->get();
			$print_excel = Excel::create(date('d-m-Y H:m:s'), function ($excel)
				 use (
					$date_from,
					$date_until,
					$reviewers
				) {
					$excel->sheet('New sheet', function ($sheet)
						 use (
							$date_from,
							$date_until,
							$reviewers
						) {
							$sheet->loadView('back.reports.print_reviewers',
								[
									'date_from'  => $date_from,
									'date_until' => $date_until,
									'reviewers'  => $reviewers
								]
							);
						});
				});
			return $print_excel->download('csv');
		} else {
			return abort(403);
		}
	}
	public function print_contributors(Request $request) {
		if (Sentinel::hasAnyAccess(['reports'])) {
			$this->validate($request, [
					'date_from'  => 'required',
					'date_until' => 'required'
				]);
			$date_from    = $request->date_from;
			$date_until   = $request->date_until;
			$contributors = Foods::with(['user', 'media'])
				->leftJoin('users', 'users.id', '=', 'foods.created_by')
				->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
				->selectRaw('foods.*, count(foods.created_by) as count')
				->where('role_users.role_id', 1)
				->whereBetween('foods.created_at', [$date_from, $date_until])
				->groupBy('foods.created_by')
				->orderBy('count', 'DESC')
				->get();
			$print_excel = Excel::create(date('d-m-Y H:m:s'), function ($excel)
				 use (
					$date_from,
					$date_until,
					$contributors
				) {
					$excel->sheet('New sheet', function ($sheet)
						 use (
							$date_from,
							$date_until,
							$contributors
						) {
							$sheet->loadView('back.reports.print_contributors',
								[
									'date_from'    => $date_from,
									'date_until'   => $date_until,
									'contributors' => $contributors
								]
							);
						});
				});
			return $print_excel->download('csv');
		} else {
			return abort(403);
		}
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
	public static function get_total_media($user_id) {
		$result = Media::where('created_by', $user_id)->count();
		return $result;
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
