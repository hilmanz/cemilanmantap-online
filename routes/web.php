<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(['middleware' => 'admin', 'prefix' => 'backadmin'], function () {
		Route::resource('/dashboard', 'DashboardController');
		Route::resource('/categories', 'CategoriesController');
		Route::resource('/categories-abjad', 'CategoriesAbjadController');
		Route::resource('/media', 'MediaController');
		Route::resource('/home-sliders', 'HomeSlidersController');
		Route::resource('/stores', 'StoresController');
		Route::resource('/comments', 'CommentsController');
		Route::resource('/videos', 'VideosController');
		Route::resource('/foods', 'FoodsController');
		Route::resource('/roles', 'RolesController');
		Route::resource('/users', 'UsersController');
		Route::resource('/subscribers', 'SubscribersController');
		Route::resource('/referensi-cemilan', 'ReferensiCemilanController');
		Route::get('/section-posts/{section}', 'PostsController@posts_section');
		Route::get('/chartjs-topreviewer-dashboard', 'DashboardController@topreviewer');
		Route::get('/chartjs-toptrandingtopic-dashboard', 'DashboardController@toptrandingtopic');
		Route::get('/chartjs-toprating-dashboard', 'DashboardController@toprating');
		Route::get('/modal-media', 'MediaController@modal_list');
		Route::get('/modal-multiple-media', 'MediaController@modal_multiple_list');
		Route::get('/choose-media/{id}', 'MediaController@choose_media');
		Route::post('/choose-multiple-media', 'MediaController@choose_multiple_media');
		Route::post('/foods-upload-media', 'FoodsController@food_photos');
		Route::post('/foods-photos-delete/{food_role_media_id}', 'FoodsController@food_photos_delete');
		Route::post('/foods-comments-delete/{comment_id}', 'FoodsController@food_comment_delete');
		Route::post('/comments-status', 'CommentsController@update_status');
		Route::get('/get-food-photos/{food_id}', 'FoodsController@get_food_photos');
		Route::get('/get-food-comments/{food_id}', 'FoodsController@get_food_comments');
		Route::get('/get-food-rating/{food_id}', 'FoodsController@get_food_rating');
		Route::get('/rating-food/{food_id}', 'FoodsController@rating_food');
		Route::get('/categories-select2', 'CategoriesController@select2');
		Route::get('/categories-abjad-select2', 'CategoriesAbjadController@select2');
		Route::get('/foods-select2', 'FoodsController@select2');
		Route::get('/stores-select2', 'StoresController@select2');
		Route::get('/google-map/{place_id}', 'StoresController@google_map_place_id');
		Route::get('/get-stores-select2', 'StoresController@get_store_select2');
		Route::get('/roles-select2', 'RolesController@select2');
		Route::delete('/multi-delete-media', 'MediaController@multi_delete');
		
		
		Route::get('/reports-reviewers', 'ReportsController@reviewers');
		Route::get('/reports-reviewers/{user_id}', 'ReportsController@reviewers_detail');
		Route::get('/reports-contributors', 'ReportsController@contributors');
		Route::get('/reports-contributors/{user_id}', 'ReportsController@contributors_detail');
		Route::post('/print-reviewers', 'ReportsController@print_reviewers');
		Route::post('/print-reviewers-detail', 'ReportsController@print_reviewers_detail');
		Route::post('/print-contributors', 'ReportsController@print_contributors');
		Route::post('/print-contributors-detail', 'ReportsController@print_contributors_detail');

	});
Route::group(['middleware' => 'login'], function () {
		// ======================= Authentification ==================== //
		Route::get('/login', 'LoginController@index');
		Route::get('/login-influencers', 'LoginController@login_influencers');
		Route::get('/signup', 'RegistrationController@index');
		Route::get('/signup-influencers', 'RegistrationController@signup_influencers');
		Route::post('/login', 'LoginController@postLogin');
		Route::post('/signup', 'RegistrationController@add');
		Route::get('/forgot-password', 'ForgotPasswordController@index');
		Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');
		Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
		Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');
		Route::get('/logout', 'LoginController@logout');
		Route::get('/re_send_activation/{email}', 'RegistrationController@re_send_activation');
		Route::get('/activate/{email}/{activationCode}', 'RegistrationController@activate');
		Route::get('/login/auth/facebook', 'LoginController@redirectToFacebook');
		Route::get('/login/auth/facebook/callback', 'LoginController@handleFacebookCallback');
	});
Route::group(['middleware' => 'web'], function () {
		Route::resource('/home', 'FrontController');
		Route::get('/', 'FrontController@index');
		Route::get('/videos', 'FrontController@videos');
		Route::get('/tentang-cemilan', 'FrontController@tentang');
		Route::get('/category/abjad={name}&city={city}', 'FrontController@categories');
		Route::get('/category/abjad={name}', 'FrontController@categories_abjad');
		// Route::get('/add-cemilan', 'FrontController@add_cemilan');
		Route::get('/category/abjad={name}&city={city}/categories={categories}', 'FrontController@detail_categori');
		Route::get('/food/{slug}', 'FrontController@detail_food');
		Route::get('/get-food-rating/{food_id}', 'FrontController@get_food_rating');
		Route::get('/photos-comments/{food_id}', 'FrontController@ajax_photos_comments');
		Route::get('/modal-food-photos/{food_id}', 'FrontController@modal_food_photos');
		Route::get('/modal-comment-food-photos/{food_id}', 'FrontController@modal_comment_food_photos');
		Route::post('/add-comments', 'FrontController@add_comment');
		Route::post('/add-referensi-cemilan', 'FrontController@add_referensi_cemilan');
		Route::get('/user-info-ajax', 'FrontController@user_info');
		Route::get('/user-info-mobile-ajax', 'FrontController@user_info_mobile');
		Route::get('/search-google-place', 'FrontController@google_place_search');
		Route::get('/search-location', 'FrontController@get_data_location');
	});
Route::post('/logout', 'LoginController@logout');
