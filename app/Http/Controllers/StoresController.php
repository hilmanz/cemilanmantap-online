<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Stores;
use GoogleMaps;
use GooglePlaces;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class storesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $keyword = null) {
		if (Sentinel::hasAnyAccess(['stores'])) {
			$term = $request->keyword;
			if ($term) {
				$stores = Stores::where('name', 'LIKE', '%'.$term.'%')->paginate(10);
				$stores->appends($request->only('keyword'));
				return view('back.stores.index', compact('stores', 'term'));
			} else {
				$stores = Stores::paginate(10);
				return view('back.stores.index', compact('stores'));
			}
		} else {
			return abort(403);
		}
	}
	public function get_store_select2(Request $request) {
		if (Sentinel::hasAnyAccess(['stores'])) {
			$term = $request->q;
			if ($term) {
				$stores = Stores::where('name', 'LIKE', '%'.$term.'%')->limit(5)->get();
			} else {
				$stores = Stores::limit(5)->get();
			}
			return response()->json($stores);
		} else {
			return abort(403);
		}
	}
	public function old_select2(Request $request) {
		if (Sentinel::hasAnyAccess(['stores'])) {
			$term = $request->q;
			if ($term) {
				$response = GoogleMaps::load('geocoding')
					->setParam([
						'address'    => $term,
						'components' => [
							'country'   => 'ID',
						]
					])
					->get('results');
			} else {
				$response = GoogleMaps::load('geocoding')
					->setParam([
						'address'    => 'Indonesia',
						'components' => [
							'country'   => 'ID',
						]
					])
					->get('results');
			}
			$count = count($response['results']);
			$total = "";

			if ($count > 0) {
				for ($i = 0; $i < $count; $i++) {
					$location[] = ([
							"address"  => $response['results'][$total.$i]['formatted_address'],
							"lng"      => $response['results'][$total.$i]['geometry']['location']['lng'],
							"lat"      => $response['results'][$total.$i]['geometry']['location']['lat'],
							"place_id" => $response['results'][$total.$i]['place_id']
						]);
				}
			} else {
				$location[] = ([
						"address" => 'Not Found'
					]);
			}

			return response()->json($location);
		} else {
			return abort(403);
		}
	}

	public function select2(Request $request) {
		if (Sentinel::hasAnyAccess(['stores'])) {
			$term = $request->q;
			if ($term) {
				$response = GooglePlaces::placeAutocomplete($term);
			} else {
				$response = GooglePlaces::placeAutocomplete('restaurant Indonesia');
			}
			$count = count($response['predictions']);
			$total = "";

			if ($count > 0) {
				for ($i = 0; $i < $count; $i++) {
					$location[] = ([
							"description"    => $response['predictions'][$total.$i]['description'],
							"id"             => $response['predictions'][$total.$i]['id'],
							"place_id"       => $response['predictions'][$total.$i]['place_id'],
							"main_text"      => $response['predictions'][$total.$i]['structured_formatting']['main_text'],
							"secondary_text" => $response['predictions'][$total.$i]['structured_formatting']['secondary_text'],
							"terms"          => $response['predictions'][$total.$i]['terms'][$total.$i]['value']
						]);
				}
			} else {
				$location[] = ([
						"address" => 'Not Found'
					]);
			}

			return response()->json($location);
		} else {
			return abort(403);
		}
	}
	public function google_map_place_id(Request $request, $place_id) {
		$response         = GooglePlaces::placeDetails($place_id);
		$response_address = $response['result']['address_components'];
		$count            = count($response['result']['address_components']);
		$total            = "";
		for ($i = 0; $i < $count; $i++) {
			if ($response_address[$total.$i]['types'][0] == 'country') {
				$address_components[] = ([
						"long_name"  => $response_address[$total.$i]['long_name'],
						"short_name" => $response_address[$total.$i]['short_name'],
						"types"      => $response_address[$total.$i]['types'][0],
					]);
			}
		}
		$location[] = ([
				"formatted_address"      => $response['result']['formatted_address'],
				"lng"                    => $response['result']['geometry']['location']['lng'],
				"lat"                    => $response['result']['geometry']['location']['lat'],
				"url"                    => $response['result']['url'],
				"formatted_phone_number" => $response['result']['formatted_phone_number'],
				"name"                   => $response['result']['name'],
				"vinicity"               => $response['result']['vicinity'],
				"place_id"               => $response['result']['place_id'],
				"long_name"              => $address_components[0]['long_name'],
				"short_name"             => $address_components[0]['short_name'],
				"types"                  => $address_components[0]['types'],
			]);
		return response()->json($location);
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
		if (Sentinel::hasAnyAccess(['stores'])) {
			$validator = Validator::make($request->all(), [
					'name'            => 'required|unique:stores,name,NULL,deleted_at,deleted_at,NULL',
					'email'           => 'required|email',
					'file_id'         => 'required|exists:media,id',
					'phone_number'    => 'required',
					'address'         => 'required',
					'place_id'        => 'required',
					'country'         => 'required',
					'city'            => 'required',
					'country_initial' => 'required',
					'lng'             => 'required',
					'lat'             => 'required',
					'status'          => 'required',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$stores = new Stores([
						'name'             => $request->name,
						'email'            => $request->email,
						'phone_number'     => $request->phone_number,
						'media_id'         => $request->file_id,
						'address'          => $request->address,
						'place_id'         => $request->place_id,
						'country'          => $request->country,
						'city'             => $request->city,
						'country_initial'  => $request->country_initial,
						'url'              => $request->url,
						'url_use'          => $request->url_use,
						'meta_title'       => $request->meta_title,
						'meta_description' => $request->meta_description,
						'meta_tags'        => $request->meta_tags,
						'longtitude'       => $request->lng,
						'latitude'         => $request->lat,
						'created_by'       => Sentinel::getUser()->id,
						'status'           => $request->status,
					]);
				if ($stores       ->save()) {
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
		if (Sentinel::hasAnyAccess(['stores'])) {
			$stores = Stores::find($id);
			return view('back.stores.data_edit', compact('stores'));
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
		if (Sentinel::hasAnyAccess(['stores'])) {
			$validator = Validator::make($request->all(), [
					'name'            => 'required|unique:stores,name,'.$request->id.',id,deleted_at,NULL',
					'email'           => 'required|email',
					'file_id'         => 'required|exists:media,id',
					'phone_number'    => 'required',
					'address'         => 'required',
					'lng'             => 'required',
					'lat'             => 'required',
					'place_id'        => 'required',
					'country'         => 'required',
					'country_initial' => 'required',
					'city'            => 'required',
					'status'          => 'required',
				]);
			if ($validator    ->fails()) {
				return response()->json([
						'status'  => 'errors',
						'message' => $validator->getMessageBag()->toArray()
					]);
			} else {
				$stores                   = Stores::find($request->id);
				$stores->name             = $request->name;
				$stores->slug             = null;
				$stores->email            = $request->email;
				$stores->phone_number     = $request->phone_number;
				$stores->media_id         = $request->file_id;
				$stores->address          = $request->address;
				$stores->place_id         = $request->place_id;
				$stores->country          = $request->country;
				$stores->city             = $request->city;
				$stores->country_initial  = $request->country_initial;
				$stores->url              = $request->url;
				$stores->url_use          = $request->url_use;
				$stores->meta_title       = $request->meta_title;
				$stores->meta_description = $request->meta_description;
				$stores->meta_tags        = $request->meta_tags;
				$stores->longtitude       = $request->lng;
				$stores->latitude         = $request->lat;
				$stores->created_by       = Sentinel::getUser()->id;
				$stores->status           = $request->status;
				if ($stores       ->update()) {
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
		if (Sentinel::hasAnyAccess(['stores'])) {
			$id     = $request->id;
			$stores = Stores::destroy($id);
			if ($stores) {
				return back()->with('success', 'Deleted');
			} else {
				return back()->with('Failed', 'Deleted');
			}
		} else {
			return abort(403);
		}
	}
}
