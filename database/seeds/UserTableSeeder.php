<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class UserTableSeeder extends Seeder{

	public function run()
	{
		$faker = Faker::create();

		for ($i=0; $i <10 ; $i++) { 
			\DB::table('users')->insert(array (
				'email'			=>	$faker->unique()->email,
				'password'		=>	\Hash::make('123456'),
				'type'			=>	'user'
			));
		}
	}
}