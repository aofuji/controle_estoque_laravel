<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$dt = Carbon::now();
		$dt->timezone = 'America/Sao_Paulo';
		DB::table('users')->insert([
			'name' => 'andre',
			'email' => 'andre@teste.com',
			'password' => bcrypt('secret'),
			'nivel_acesso' => 1,
			'created_at' => $dt,
			'updated_at' => $dt,
		]);
		DB::table('users')->insert([
			'name' => 'user',
			'email' => 'user@user.com',
			'password' => bcrypt('secret'),
			'nivel_acesso' => 2,
			'created_at' => $dt,
			'updated_at' => $dt,
		]);
	}
}
