<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, SparkPost and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	 */

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'ses'     => [
		'key'    => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'sparkpost' => [
		'secret'   => env('SPARKPOST_SECRET'),
	],

	'stripe'  => [
		'model'  => App\User::class ,
		'key'    => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],
	'facebook'       => [
		'client_id'     => '189973868449439',
		'client_secret' => 'fd1a40e8fa7e0e218d9caf83c7b277d3',
		'redirect'      => 'https://cemilanmantap.com/login/auth/facebook/callback',
	],

];
