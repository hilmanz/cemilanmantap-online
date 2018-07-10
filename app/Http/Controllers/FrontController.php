<?php

namespace App\Http\Controllers;

use App\Categories;
use App\CategoriesAbjad;
use App\Comments;
use App\CommentsRoleMedia;
use App\Foods;
use App\FoodsRoleCategories;
use App\FoodsRoleMedia;
use App\HomeSliders;
use App\Media;
use App\ReferensiCemilan;

use App\ReferensiCemilanRoleMedia;
use App\Stores;
use App\Subscribers;
use App\Videos;
use File;
use GooglePlaces;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use OpenGraph;
use Sentinel;
use SEOMeta;
use Validator;

use Vinkla\Instagram\Instagram;

class FrontController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// =========== SEO Tools ================ //
		SEOMeta::setTitle('Cemilan Mantap');
		SEOMeta::setDescription('Ngopi dan cemilan memang telah melekat dan menjadi bagian kehidupan seluruh lapisan masyarakat Indonesia sebagai teman santai sejenak di tengah kesibukan aktivitas sehari-hari. Selain dapat menenangkan dan menyenangkan sejenak, momen santai ditemani nikmatnya secangkir kopi dan camilan pun kini telah menjadi gaya hidup. Bila sepasang ideal mantap ini dinikmati, seketika langsung memberikan keakraban dan mencairkan suasana. Itulah mengapa Kopi ABC menghadirkan sebuah direktori cemilan yang inspiratif untuk #TemanMantap.');
		SEOMeta::setCanonical(url('/'));
		SEOMeta::addKeyword(['cemilan', 'mantap', 'cemilan mantap']);
		OpenGraph::setDescription('Ngopi dan cemilan memang telah melekat dan menjadi bagian kehidupan seluruh lapisan masyarakat Indonesia sebagai teman santai sejenak di tengah kesibukan aktivitas sehari-hari. Selain dapat menenangkan dan menyenangkan sejenak, momen santai ditemani nikmatnya secangkir kopi dan camilan pun kini telah menjadi gaya hidup. Bila sepasang ideal mantap ini dinikmati, seketika langsung memberikan keakraban dan mencairkan suasana. Itulah mengapa Kopi ABC menghadirkan sebuah direktori cemilan yang inspiratif untuk #TemanMantap.');
		OpenGraph::setTitle('Cemilan Mantap');
		OpenGraph::setUrl(url('/'));
		OpenGraph::addProperty('type', 'articles');
		OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
		OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
		OpenGraph::addImage(
			[
				'url'  => url('/front_assets/assets/img/slide-02.jpg'),
				'size' => 300
			]
		);
		OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
				'height' => 300,
				'width'  => 300
			]);
		// =========== End SEO Tools ============ //
		$home_sliders     = HomeSliders::where('status', 'publish')->orderBy('id', 'DESC')->limit(5)->get();
		$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
		$top_rating       = Foods::selectRaw('foods.*, foods.rating as rating')
			->groupBy('foods.id')
			->limit(5)
			->orderBy('rating', 'DESC')
			->get();
		$top_trending = Comments::with(['food'])
			->leftJoin('foods', 'foods.id', '=', 'comments.food_id')
			->selectRaw('comments.*, count(comments.food_id) as count')
			->groupBy('foods.id')
			->limit(5)
			->orderBy('count', 'DESC')
			->get();
		$top_reviewers = Comments::with(['user'])
			->leftJoin('users', 'users.id', '=', 'comments.user_id')
			->selectRaw('comments.*, count(comments.user_id) as count')
			->groupBy('users.id')
			->limit(5)
			->orderBy('count', 'DESC')
			->get();

		$stores_city = Stores::select('stores.city')->where('city', '!=', null)->groupBy('city')->get();
		return view('front.home.index', compact('home_sliders', 'categories_abjad', 'top_rating', 'top_trending', 'top_reviewers', 'stores_city'));
	}

	public function videos(Request $request) {

		// =========== SEO Tools ================ //
		SEOMeta::setTitle('Videos Cemilan Mantap');
		SEOMeta::setDescription('Ngopi dan cemilan memang telah melekat dan menjadi bagian kehidupan seluruh lapisan masyarakat Indonesia sebagai teman santai sejenak di tengah kesibukan aktivitas sehari-hari. Selain dapat menenangkan dan menyenangkan sejenak, momen santai ditemani nikmatnya secangkir kopi dan camilan pun kini telah menjadi gaya hidup. Bila sepasang ideal mantap ini dinikmati, seketika langsung memberikan keakraban dan mencairkan suasana. Itulah mengapa Kopi ABC menghadirkan sebuah direktori cemilan yang inspiratif untuk #TemanMantap.');
		SEOMeta::setCanonical(url('/videos'));
		SEOMeta::addKeyword(['cemilan', 'mantap', 'cemilan mantap']);
		OpenGraph::setDescription('Ngopi dan cemilan memang telah melekat dan menjadi bagian kehidupan seluruh lapisan masyarakat Indonesia sebagai teman santai sejenak di tengah kesibukan aktivitas sehari-hari. Selain dapat menenangkan dan menyenangkan sejenak, momen santai ditemani nikmatnya secangkir kopi dan camilan pun kini telah menjadi gaya hidup. Bila sepasang ideal mantap ini dinikmati, seketika langsung memberikan keakraban dan mencairkan suasana. Itulah mengapa Kopi ABC menghadirkan sebuah direktori cemilan yang inspiratif untuk #TemanMantap.');
		OpenGraph::setTitle('Videos Cemilan Mantap');
		OpenGraph::setUrl(url('/videos'));
		OpenGraph::addProperty('type', 'articles');
		OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
		OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
		OpenGraph::addImage(
			[
				'url'  => url('/front_assets/assets/img/slide-02.jpg'),
				'size' => 300
			]
		);
		OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
				'height' => 300,
				'width'  => 300
			]);
		// =========== End SEO Tools ============ //

		$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
		$videos           = Videos::where('status', 'publish')->simplePaginate(9);
		return view('front.videos.index', compact('videos', 'categories_abjad'));
	}
	public function tentang(Request $request) {
		// =========== SEO Tools ================ //
		SEOMeta::setTitle('Tentang Cemilan Mantap');
		SEOMeta::setDescription('Ngopi dan cemilan memang telah melekat dan menjadi bagian kehidupan seluruh lapisan masyarakat Indonesia sebagai teman santai sejenak di tengah kesibukan aktivitas sehari-hari. Selain dapat menenangkan dan menyenangkan sejenak, momen santai ditemani nikmatnya secangkir kopi dan camilan pun kini telah menjadi gaya hidup. Bila sepasang ideal mantap ini dinikmati, seketika langsung memberikan keakraban dan mencairkan suasana. Itulah mengapa Kopi ABC menghadirkan sebuah direktori cemilan yang inspiratif untuk #TemanMantap.');
		SEOMeta::setCanonical(url('/tentang-cemilan'));
		SEOMeta::addKeyword(['cemilan', 'mantap', 'cemilan mantap']);
		OpenGraph::setDescription('Ngopi dan cemilan memang telah melekat dan menjadi bagian kehidupan seluruh lapisan masyarakat Indonesia sebagai teman santai sejenak di tengah kesibukan aktivitas sehari-hari. Selain dapat menenangkan dan menyenangkan sejenak, momen santai ditemani nikmatnya secangkir kopi dan camilan pun kini telah menjadi gaya hidup. Bila sepasang ideal mantap ini dinikmati, seketika langsung memberikan keakraban dan mencairkan suasana. Itulah mengapa Kopi ABC menghadirkan sebuah direktori cemilan yang inspiratif untuk #TemanMantap.');
		OpenGraph::setTitle('Cemilan Mantap');
		OpenGraph::setUrl(url('/tentang-cemilan'));
		OpenGraph::addProperty('type', 'articles');
		OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
		OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
		OpenGraph::addImage(
			[
				'url'  => url('/front_assets/assets/img/slide-02.jpg'),
				'size' => 300
			]
		);
		OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
				'height' => 300,
				'width'  => 300
			]);
		// =========== End SEO Tools ============ //
		$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
		return view('front.tentang.index', compact('categories_abjad'));
	}
	public function categories_abjad(Request $request, $abjad) {
		$categoriesAbjad = CategoriesAbjad::where('name', $abjad)->first();
		if ($categoriesAbjad) {
			$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
			$categories       = Categories::where('categories_abjad_id', $categoriesAbjad->id)->simplePaginate(9);

			// =========== SEO Tools ================ //
			SEOMeta::setTitle('Kategori Cemilan '.$categoriesAbjad->name);
			SEOMeta::setDescription($categoriesAbjad->meta_description);
			SEOMeta::setCanonical('http://cemilanmantap.com');
			SEOMeta::addKeyword([$categoriesAbjad->meta_tags]);
			OpenGraph::setDescription($categoriesAbjad->meta_description);
			OpenGraph::setTitle($categoriesAbjad->meta_title);
			OpenGraph::setUrl(url('/category/').'/'.$categoriesAbjad->name);
			OpenGraph::addProperty('type', 'articles');
			if (!empty($categoriesAbjad->media->filename)) {
				OpenGraph::addImage(url('/media/originals/').'/'.$categoriesAbjad->media->filename);
				OpenGraph::addImage(url('/media/originals/').'/'.$categoriesAbjad->media->filename);
				OpenGraph::addImage(
					[
						'url'  => url('/media/originals/').'/'.$categoriesAbjad->media->filename,
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/media/originals/').'/'.$categoriesAbjad->media->filename, [
						'height' => 300,
						'width'  => 300
					]);
			} else {
				OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
				OpenGraph::addImage(
					[
						'url'  => url('/front_assets/assets/img/slide-02.jpg'),
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
						'height' => 300,
						'width'  => 300
					]);
			}

			// =========== End SEO Tools ============ //

			$stores_city = Stores::select('stores.city')->where('city', '!=', null)->groupBy('city')->get();
			return view('front.kategori.index', compact('categories', 'categoriesAbjad', 'categories_abjad', 'abjad', 'stores_city'));
		} else {
			return abort(404);
		}
	}
	public function categories(Request $request, $abjad, $city) {
		$categoriesAbjad = CategoriesAbjad::where('name', $abjad)->first();
		if ($categoriesAbjad) {
			$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
			if ($city != 'all') {
				$categories = Categories::select('categories.*')
					->LeftJoin('foods_role_categories', 'foods_role_categories.category_id', '=', 'categories.id')
					->LeftJoin('foods', 'foods.id', '=', 'foods_role_categories.food_id')
					->LeftJoin('stores', 'stores.id', '=', 'foods.store_id')
					->where('stores.city', $city)
					->where('categories.categories_abjad_id', $categoriesAbjad->id)
					->groupBy('categories.id')
					->simplePaginate(10);
			} else {
				$categories = Categories::select('categories.*')
					->LeftJoin('foods_role_categories', 'categories.id', '=', 'foods_role_categories.category_id')
					->LeftJoin('foods', 'foods.id', '=', 'foods_role_categories.food_id')
					->LeftJoin('stores', 'stores.id', '=', 'foods.store_id')
					->where('categories.categories_abjad_id', $categoriesAbjad->id)
					->groupBy('categories.id')
					->simplePaginate(10);
			}
			// =========== SEO Tools ================ //
			SEOMeta::setTitle('Kategori Cemilan '.$categoriesAbjad->name);
			SEOMeta::setDescription($categoriesAbjad->meta_description);
			SEOMeta::setCanonical('http://cemilanmantap.com');
			SEOMeta::addKeyword([$categoriesAbjad->meta_tags]);
			OpenGraph::setDescription($categoriesAbjad->meta_description);
			OpenGraph::setTitle($categoriesAbjad->meta_title);
			OpenGraph::setUrl(url('/category/').'/'.$categoriesAbjad->name);
			OpenGraph::addProperty('type', 'articles');
			if (!empty($categoriesAbjad->media->filename)) {
				OpenGraph::addImage(url('/media/originals/').'/'.$categoriesAbjad->media->filename);
				OpenGraph::addImage(url('/media/originals/').'/'.$categoriesAbjad->media->filename);
				OpenGraph::addImage(
					[
						'url'  => url('/media/originals/').'/'.$categoriesAbjad->media->filename,
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/media/originals/').'/'.$categoriesAbjad->media->filename, [
						'height' => 300,
						'width'  => 300
					]);
			} else {
				OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
				OpenGraph::addImage(
					[
						'url'  => url('/front_assets/assets/img/slide-02.jpg'),
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
						'height' => 300,
						'width'  => 300
					]);
			}

			// =========== End SEO Tools ============ //

			$stores_city = Stores::select('stores.city')->where('city', '!=', null)->groupBy('city')->get();
			return view('front.kategori.index', compact('categories', 'categoriesAbjad', 'categories_abjad', 'city', 'abjad', 'stores_city'));
		} else {
			return abort(404);
		}
	}
	public function detail_categori(Request $request, $abjad, $city, $categories_slug) {
		$q_abjad         = CategoriesAbjad::orderBy('name', 'ASC');
		$q_abjad_specify = $q_abjad->where('name', $abjad);
		if ($q_abjad_specify->count() > 0) {
			$q_categories = Categories::where('slug', $categories_slug)->where('categories_abjad_id', $q_abjad_specify->first()->id);
			$cek          = $q_categories->count();
			if ($cek > 0) {
				$category         = $q_categories->first();
				$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
				if ($city != 'all') {
					$food_role_categories = FoodsRoleCategories::LeftJoin('foods', 'foods.id', '=', 'foods_role_categories.food_id')
						->LeftJoin('stores', 'stores.id', '=', 'foods.store_id')
						->where('stores.city', $city)
						->where('category_id', $category->id)
						->simplePaginate(10);
				} else {
					$food_role_categories = FoodsRoleCategories::LeftJoin('foods', 'foods.id', '=', 'foods_role_categories.food_id')
						->LeftJoin('stores', 'stores.id', '=', 'foods.store_id')
						->where('category_id', $category->id)
						->simplePaginate(10);
				}

				// =========== SEO Tools ================ //
				SEOMeta::setTitle('Kategori Cemilan '.$category->name);
				SEOMeta::setDescription($category->meta_description);
				SEOMeta::setCanonical(url('/category/').'/'.$q_abjad_specify->first()->name.'/categories='.$category->name);
				SEOMeta::addKeyword([$category->meta_tags]);
				OpenGraph::setDescription($category->meta_description);
				OpenGraph::setTitle($category->meta_title);
				OpenGraph::setUrl(url('/category/').'/'.$q_abjad_specify->first()->name.'/categories='.$category->name);
				OpenGraph::addProperty('type', 'articles');
				OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
				OpenGraph::addImage(
					[
						'url'  => url('/front_assets/assets/img/slide-02.jpg'),
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
						'height' => 300,
						'width'  => 300
					]);
				// =========== End SEO Tools ============ //

				$stores_city = Stores::select('stores.city')->where('city', '!=', null)->groupBy('city')->get();
				return view('front.kategori.detail', compact('food_role_categories', 'category', 'categories_abjad', 'city', 'abjad', 'stores_city', 'categories_slug'));
			} else {
				return abort(404);
			}
		} else {
			return abort(404);
		}
	}
	public function detail_food(Request $request, $slug) {
		$q_foods = Foods::whereSlug($slug);
		if ($q_foods->count() > 0) {
			$foods             = $q_foods->first();
			$q_food_categories = FoodsRoleCategories::selectRaw('foods_role_categories.*, count(category_id) as count')
				->where('foods_role_categories.food_id', $foods->id)
				->groupBy('foods_role_categories.category_id')
				->get();
			$categories_abjad           = CategoriesAbjad::orderBy('name', 'ASC')->get();
			$q_photos                   = FoodsRoleMedia::where('food_id', $foods->id);
			$photos                     = $q_photos->orderBy('created_at', 'DESC')->limit(2)->get();
			$count_comments             = Comments::where('food_id', $foods->id)->count();
			$comments                   = Comments::where('food_id', $foods->id)->where('status', 'publish')->orderBy('created_at', 'DESC')->simplePaginate(9);
			$count_food_photos_comments = CommentsRoleMedia::select(['comments_role_media.*'])
				->leftJoin('comments', 'comments.id', '=', 'comments_role_media.comment_id')
				->leftJoin('foods', 'foods.id', '=', 'comments.food_id')
				->where('comments.status', 'publish')
				->where('comments.food_id', $foods->id)
				->count();
			foreach ($q_food_categories as $data) {
				$arr = ([
						'id' => $data->category_id
					]);
			}
			$food_categories = implode(", ", $arr);

			// =========== SEO Tools ================ //
			SEOMeta::setTitle('Kategori Cemilan '.$foods->title);
			SEOMeta::setDescription($foods->meta_description);
			SEOMeta::setCanonical(url('/food/').'/'.$slug);
			SEOMeta::addKeyword([$foods->meta_tags]);
			OpenGraph::setDescription($foods->meta_description);
			OpenGraph::setTitle($foods->meta_title);
			OpenGraph::setUrl(url('/food/').'/'.$slug);
			OpenGraph::addProperty('type', 'articles');
			if (!empty($foods->media->filename)) {
				OpenGraph::addImage(url('/media/originals/').'/'.$foods->media->filename);
				OpenGraph::addImage(url('/media/originals/').'/'.$foods->media->filename);
				OpenGraph::addImage(
					[
						'url'  => url('/media/originals/').'/'.$foods->media->filename,
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/media/originals/').'/'.$foods->media->filename, [
						'height' => 300,
						'width'  => 300
					]);
			} else {
				OpenGraph::addImage(url('/').'/front_assets/assets/img/slide-02.jpg');
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'));
				OpenGraph::addImage(
					[
						'url'  => url('/front_assets/assets/img/slide-02.jpg'),
						'size' => 300
					]
				);
				OpenGraph::addImage(url('/front_assets/assets/img/slide-02.jpg'), [
						'height' => 300,
						'width'  => 300
					]);
			}

			$stores_city = Stores::select('stores.city')->where('city', '!=', null)->groupBy('city')->get();
			return view('front.kategori.food', compact('categories_abjad', 'foods', 'photos', 'q_photos', 'count_comments', 'photos_comments', 'comments', 'food_categories', 'count_food_photos_comments', 'stores_city'));
		} else {
			return abort(404);
		}
	}
	public function ajax_photos_comments(Request $request, $food_id) {
		if ($request->ajax()) {
			$photos_food_comments = CommentsRoleMedia::select(['comments_role_media.*'])
				->leftJoin('comments', 'comments.id', '=', 'comments_role_media.comment_id')
				->leftJoin('foods', 'foods.id', '=', 'comments.food_id')
				->where('comments.status', 'publish')
				->where('comments.food_id', $food_id)
				->simplePaginate(6);
			return view('front.kategori.ajax_photos_comments', compact('photos_food_comments'));
		}
		return view('front.kategori.ajax_photos_comments', compact('photos_food_comments'));
	}
	public function modal_food_photos(Request $request, $food_id) {
		$foods_media = FoodsRoleMedia::where('food_id', $food_id)->simplePaginate(9);
		if ($request->ajax()) {
			return view('front.kategori.modal_food_photos', compact('foods_media'));
		}
		return view('front.kategori.modal_food_photos', compact('foods_media'));
	}
	public function modal_comment_food_photos(Request $request, $comment_id) {
		$foods_media = CommentsRoleMedia::where('comment_id', $comment_id)->simplePaginate(9);
		if ($request->ajax()) {
			return view('front.kategori.modal_food_photos', compact('foods_media'));
		}
		return view('front.kategori.modal_food_photos', compact('foods_media'));
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
	public function user_info(Request $request) {
		$total_comment = Comments::where('user_id', Sentinel::getUser()->id)->count();
		return view('front.partials.user_info', compact('total_comment'));
	}
	public function user_info_mobile(Request $request) {
		$total_comment = Comments::where('user_id', Sentinel::getUser()->id)->count();
		return view('front.partials.user_info_mobile', compact('total_comment'));
	}

	public function add_comment(Request $request) {
		if ($request->hasFile('filename')) {
			$validator = Validator::make($request->all(), [
					'g-recaptcha-response' => 'required|captcha',
					'rating'               => 'required',
					'komentar'             => 'required',
					'food_id'              => 'required|exists:foods,id',
					'filename'             => 'array|max:3000',
					'filename.*'           => 'mimes:jpeg,bmp,png,gif|image|present',
				]);
		} else {
			$validator = Validator::make($request->all(), [
					'g-recaptcha-response' => 'required|captcha',
					'rating'               => 'required',
					'komentar'             => 'required',
					'food_id'              => 'required|exists:foods,id',
				]);
		}
		if ($validator    ->fails()) {
			return response()->json([
					'status'  => 'errors',
					'message' => $validator->getMessageBag()->toArray()
				]);
		} else {

			$comments = new Comments([
					'title'   => 'Default title',
					'food_id' => $request->food_id,
					'rating'  => $request->rating,
					'text'    => $request->komentar,
					'user_id' => Sentinel::getUser()->id,
					'status'  => 'publish',
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
						'status'  => 'failed',
						'message' => 'Data Failed.',
					]);
			}
		}
	}

	public static function photos_comments($comment_id) {
		$count_photos_comments = CommentsRoleMedia::where('comment_id', $comment_id)->count();
		$photos_comments       = CommentsRoleMedia::whereHas('comments', function ($query) {
				$query->where('comments.status', 'publish');
			})->where('comment_id', $comment_id)->orderBy('created_at', 'DESC')->limit(2)->get();
		return view('front.kategori.photos_comments', compact('photos_comments', 'count_photos_comments'));
	}
	public static function foods_similar($category_id, $food_id) {
		$foods_similar = Foods::whereHas('food_role_categories', function ($query) use ($category_id) {
				$query->whereIn('category_id', [$category_id]);
			})->where('id', '!=', $food_id)->orderBy('created_at', 'DESC')->limit(4)->get();
		return view('front.kategori.foods_similar', compact('foods_similar'));
	}
	public function get_food_rating(Request $request, $food_id) {
		$count_comments = Comments::where('food_id', $food_id)->count();
		$rating_food    = $this->rating_food($food_id);
		return view('front.kategori.food_rating', compact('rating_food', 'count_comments'));
	}
	public function add_cemilan(Request $request) {
		return view('front.cemilan.add');
	}
	public function add_referensi_cemilan(Request $request) {
		if ($request->hasFile('filename')) {
			$validator = Validator::make($request->all(), [
					'g-recaptcha-response' => 'required|captcha',
					'name'                 => 'required|',
					'lokasi'               => 'required',
					'filename'             => 'array|max:3000',
					'filename.*'           => 'mimes:jpeg,bmp,png,gif|image|present',
				]);
		} else {
			$validator = Validator::make($request->all(), [
					'g-recaptcha-response' => 'required|captcha',
					'name'                 => 'required|',
					'lokasi'               => 'required',
				]);
		}
		if ($validator    ->fails()) {
			return response()->json([
					'status'  => 'errors',
					'message' => $validator->getMessageBag()->toArray()
				]);
		} else {
			$referensi_cemilan              = New ReferensiCemilan;
			$referensi_cemilan->name        = $request->name;
			$referensi_cemilan->lokasi      = $request->lokasi;
			$referensi_cemilan->harga       = $request->harga;
			$referensi_cemilan->no_telp     = $request->no_telp;
			$referensi_cemilan->review_text = $request->review_text;
			if (Sentinel::check()) {
				$referensi_cemilan->created_by = Sentinel::getUser()->id;
			} else {
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
						$files           = new Media;
						$files->filename = $filename[$i];
						$files->cover    = $filename[$i];
						$files->name     = $filename[$i];
						$files->type     = 'image';
						$files->link     = null;
						if (Sentinel::check()) {
							$files->created_by = Sentinel::getUser()->id;
						} else {
							$files->created_by = null;
						}
						$files->save();

						$referensi_media                       = new ReferensiCemilanRoleMedia;
						$referensi_media->referensi_cemilan_id = $referensi_cemilan->id;
						$referensi_media->media_id             = $files->id;
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
	public function google_place_search(Request $request) {
		$term = $request->q;
		if ($term) {
			$response = GooglePlaces::placeAutocomplete($term);
		} else {
			$response = GooglePlaces::placeAutocomplete('restaurant Jakarta');
		}
		$count = count($response['predictions']);
		$total = "";

		if ($count > 0) {
			for ($i = 0; $i < $count; $i++) {
				$location[] = ([
						"description" => $response['predictions'][$total.$i]['description'],
						"id"          => $response['predictions'][$total.$i]['id'],
						"place_id"    => $response['predictions'][$total.$i]['place_id'],
						"main_text"   => $response['predictions'][$total.$i]['structured_formatting']['main_text'],
						// "secondary_text" => $response['predictions'][$total.$i]['structured_formatting']['secondary_text'],
						// "terms"          => $response['predictions'][$total.$i]['terms'][$total.$i]['value']
					]);
			}
		} else {
			$location[] = ([
					"place_id"    => '',
					"main_text"   => '',
					"description" => 'Maaf silahkan masukan kota lain'
				]);
		}
		return view('front.google_place.index', compact('location', 'count', 'total'));

		//return response()->json($location);
	}
	public function get_data_location(Request $request) {
		$categories_abjad = CategoriesAbjad::orderBy('name', 'ASC')->get();
		$foods            = Foods::select(['foods.*'])->join('stores', 'stores.id', '=', 'foods.store_id')
		                                   ->where('stores.name', 'like', '%'.$request->keyword.'%')
			->orWhere('stores.address', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('stores.meta_tags', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('stores.meta_description', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('stores.meta_title', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('foods.title', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('foods.short_text', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('foods.meta_title', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('foods.meta_description', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('foods.meta_tags', 'LIKE', '%'.$request->keyword.'%')
			->orWhere('stores.place_id', $request->place_id)
			->paginate(20);
		return view('front.google_place.search', compact('foods', 'categories_abjad'));
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
		$validator = Validator::make($request->all(), [
				'g-recaptcha-response' => 'required',
				'email'                => 'required|email|unique:subscribers,email,NULL,deleted_at,deleted_at,NULL',
			]);
		if ($validator    ->fails()) {
			return response()->json([
					'status'  => 'errors',
					'message' => $validator->getMessageBag()->toArray()
				]);
		} else {
			$subscribers        = new Subscribers;
			$subscribers->email = $request->email;
			if ($subscribers  ->save()) {
				return response()->json([
						'status'  => 'success',
						'message' => 'Thanks! Your email has been added to our database. We will contact you to inform about future events and gatherings.',
					]);
			} else {
				return response()->json([
						'status'  => 'errors',
						'message' => 'Data Failed.',
					]);
			}
		}
	}
	public function instagram_feed(Request $request) {
		$instagram     = new Instagram('6270340679.1677ed0.b1b1bc60d27c4b13bb84291bf6cd418d&count=6');
		$get_instagram = $instagram->get();
		if ($request->ajax()) {
			return view('front.home.instagramFeed', compact('get_instagram'));
		}
	}

	public static function get_food_single_comments($food_id) {
		$comments = Comments::where('food_id', $food_id)->orderBy('created_at', 'DESC')->first();
		return $comments;
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
