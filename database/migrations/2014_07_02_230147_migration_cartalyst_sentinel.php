<?php

/**
 * Part of the Sentinel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Sentinel
 * @version    2.0.17
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2017, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrationCartalystSentinel extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('activations', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->string('code');
				$table->boolean('completed')->default(0);
				$table->timestamp('completed_at')->nullable();
				$table->timestamps();

				$table->engine = 'InnoDB';
			});

		Schema::create('persistences', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->string('code');
				$table->timestamps();

				$table->engine = 'InnoDB';
				$table->unique('code');
			});

		Schema::create('reminders', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->string('code');
				$table->boolean('completed')->default(0);
				$table->timestamp('completed_at')->nullable();
				$table->timestamps();

				$table->engine = 'InnoDB';
			});

		Schema::create('roles', function (Blueprint $table) {
				$table->increments('id');
				$table->string('slug');
				$table->string('name');
				$table->text('permissions')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->unique('slug');
			});

		Schema::create('role_users', function (Blueprint $table) {
				$table->integer('user_id')->unsigned();
				$table->integer('role_id')->unsigned();
				$table->nullableTimestamps();

				$table->engine = 'InnoDB';
				$table->primary(['user_id', 'role_id']);
			});

		Schema::create('throttle', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned()->nullable();
				$table->string('type');
				$table->string('ip')->nullable();
				$table->timestamps();

				$table->engine = 'InnoDB';
				$table->index('user_id');
			});

		Schema::create('users', function (Blueprint $table) {
				$table->increments('id');
				$table->string('email');
				$table->string('provider')->nullable();
				$table->string('jenis_kelamin')->nullable();
				$table->text('avatar')->nullable();
				$table->string('password');
				$table->integer('status');
				$table->text('permissions')->nullable();
				$table->timestamp('last_login')->nullable();
				$table->string('name')->nullable();
				$table->string('username')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->unique('email');
			});

		Schema::create('home_sliders', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->integer('media_id');
				$table->integer('mobile_media_id');
				$table->string('status');
				$table->integer('created_by');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('media_id');
				$table->index('mobile_media_id');
				$table->index('created_by');
			});

		Schema::create('subscribers', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name')->nullable();
				$table->string('email');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->unique('email');
			});

		Schema::create('stores', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('media_id');
				$table->text('place_id');
				$table->text('url');
				$table->string('country_initial');
				$table->string('country');
				$table->string('city');
				$table->string('url_use');
				$table->string('name')->nullable();
				$table->string('email')->nullable();
				$table->string('slug')->nullable();
				$table->string('phone_number')->nullable();
				$table->string('longtitude')->nullable();
				$table->string('latitude')->nullable();
				$table->text('address')->nullable();
				$table->integer('created_by');
				$table->string('status');
				$table->text('meta_title')->nullable();
				$table->text('meta_description')->nullable();
				$table->text('meta_tags')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('media_id');
				$table->index('created_by');
			});

		Schema::create('categories_abjad', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->integer('media_id');
				$table->integer('mobile_media_id');
				$table->integer('created_by');
				$table->text('meta_title')->nullable();
				$table->text('meta_description')->nullable();
				$table->text('meta_tags')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('media_id');
				$table->index('mobile_media_id');
				$table->index('created_by');
			});

		Schema::create('categories', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('slug');
				$table->integer('media_id');
				$table->integer('categories_abjad_id')->nullable();
				$table->integer('created_by');
				$table->text('short_text')->nullable();
				$table->text('long_text')->nullable();
				$table->text('meta_title')->nullable();
				$table->text('meta_description')->nullable();
				$table->text('meta_tags')->nullable();
				$table->string('status');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('media_id');
				$table->index('categories_abjad_id');
				$table->index('created_by');
			});

		Schema::create('foods', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('media_id');
				$table->integer('store_id');
				$table->string('title');
				$table->string('slug');
				$table->string('price');
				$table->text('text');
				$table->text('short_text');
				$table->float('rating')->default(0);
				$table->integer('created_by')->nullable();
				$table->string('status');
				$table->string('contributor');
				$table->integer('status_recomended');
				$table->text('meta_title')->nullable();
				$table->text('meta_description')->nullable();
				$table->text('meta_tags')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('media_id');
				$table->index('store_id');
				$table->index('created_by');
			});

		Schema::create('comments', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id');
				$table->integer('food_id');
				$table->string('title');
				$table->string('rating');
				$table->text('text');
				$table->string('status');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('user_id');
				$table->index('food_id');
			});

		Schema::create('referensi_cemilan', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name')->nullable();
				$table->text('lokasi')->nullable();
				$table->string('harga')->nullable();
				$table->string('no_telp')->nullable();
				$table->text('review_text')->nullable();
				$table->integer('created_by');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('created_by');
			});

		Schema::create('referensi_cemilan_role_media', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('referensi_cemilan_id');
				$table->integer('media_id');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('referensi_cemilan_id');
				$table->index('media_id');
			});

		Schema::create('media', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->text('text')->nullable();
				$table->text('cover')->nullable();
				$table->text('filename')->nullable();
				$table->text('link')->nullable();
				$table->string('type')->nullable();
				$table->integer('created_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('created_by');
			});

		Schema::create('videos', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->text('text');
				$table->string('media_id');
				$table->string('status');
				$table->integer('created_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('media_id');
				$table->index('created_by');
			});

		Schema::create('comments_role_media', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('comment_id');
				$table->integer('media_id');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('comment_id');
				$table->index('media_id');
			});

		Schema::create('foods_role_categories', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('food_id');
				$table->integer('category_id');
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDB';
				$table->index('food_id');
				$table->index('category_id');
			});

		Schema::create('videos_role_categories', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('video_id');
				$table->integer('category_id');
				$table->timestamps();

				$table->engine = 'InnoDB';
				$table->index('video_id');
				$table->index('category_id');
			});

		Schema::create('foods_role_media', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('food_id');
				$table->integer('media_id');
				$table->timestamps();

				$table->engine = 'InnoDB';
				$table->index('food_id');
				$table->index('media_id');
			});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('activations');
		Schema::drop('persistences');
		Schema::drop('reminders');
		Schema::drop('roles');
		Schema::drop('role_users');
		Schema::drop('throttle');
		Schema::drop('users');
		Schema::drop('categories');
		Schema::drop('stores');
		Schema::drop('media');
		Schema::drop('comments');
		Schema::drop('videos');
		Schema::drop('home_sliders');
		Schema::drop('subscribers');
		Schema::drop('foods');
		Schema::drop('foods_role_categories');
		Schema::drop('comments_role_media');
		Schema::drop('foods_role_media');
		Schema::drop('videos_role_categories');
		Schema::drop('categories_abjad');
		Schema::drop('referensi_cemilan');
		Schema::drop('referensi_cemilan_role_media');
	}
}
