<?php
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')->insert(
			array(
				'email'      => 'admin@mail.com',
				'username'   => 'administrator',
				'status'     => 1,
				'password'   => bcrypt('12345'),
				'name'       => 'Administrator',
				'created_at' => date('Y-m-d'),
				'updated_at' => date('Y-m-d'),
			)
		);
		DB::table('activations')->insert(
			array(
				'user_id'   => 1,
				'code'      => '',
				'completed' => 1,
			)
		);
		DB::table('roles')->insert([
				[
					'slug'        => 'administrator',
					'name'        => 'Administrator',
					'permissions' => '{"dashboard":true,"categories":true,"mediaLibrary":true,"subscribers":true,"homeSliders":true,"stores":true,"comments":true,"videos":true,"foods":true,"roles":true,"users":true,"categories_abjad":true,"referensiCemilan":true}'
				],
				[
					'slug'        => 'reviwer',
					'name'        => 'Reviwer',
					'permissions' => ''
				]
			]);
		DB::table('role_users')->insert(
			array(
				'user_id' => 1,
				'role_id' => 1,
			)
		);
	}
}