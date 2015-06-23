<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class MemberTableSeeder extends Seeder{

	public function run()
	{
		$faker = Faker::create();

		for ($i=0; $i <5 ; $i++) { 
			\DB::table('members')->insert(array (
				'first_name'	=>	$faker->firstName,
				'last_name'		=>	$faker->lastName,
				'burn'			=>	$faker->date,
				'photo'			=>	'',
				'sex'			=>	$faker->numberBetween(1, 2),
				'confirmed'		=> 	true,
				'user_id'		=>	null,
				'role_id'		=>	$faker->numberBetween(1, 9),
				'class_id'		=>	$faker->numberBetween(1, 13),
				'club_id'		=>	$faker->numberBetween(1, 3)
			));
		}		
	}
}