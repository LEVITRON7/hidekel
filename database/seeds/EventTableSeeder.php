<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class EventTableSeeder extends Seeder{

	public function run(){
		$faker = Faker::create();

		for ($i=0; $i <5 ; $i++) {

			\DB::table('events')->insert(array (
				'title'					=>	$faker->name,
				'description'			=>	$faker->text,
				'address'				=>	$faker->address,
				'datetime_start'		=>  $faker->dateTimeBetween($startDate = 'now', $endDate = '+30 days') ,
				'datetime_end'			=>  $faker->dateTimeBetween($startDate = '+30 days', $endDate = '+60 days'),
				'location_latitude'		=>  $faker->latitude,
				'location_longitude'	=>  $faker->longitude,
				'poster'				=>	'',
				'club_id'				=>	$faker->numberBetween(1, 3),
				'user_id'				=>  $faker->numberBetween(1, 10)	
			));	
		}

		for ($i=0; $i <5 ; $i++) {

			\DB::table('events')->insert(array (
				'title'					=>	$faker->name,
				'description'			=>	$faker->text,
				'address'				=>	$faker->address,
				'datetime_start'		=>  $faker->dateTimeThisYear('now'),
				'datetime_end'			=>  $faker->dateTimeThisYear('now'),
				'location_latitude'		=>  $faker->latitude,
				'location_longitude'	=>  $faker->longitude,
				'poster'				=>	'',
				'club_id'				=>	$faker->numberBetween(1, 3),
				'user_id'				=>  $faker->numberBetween(1, 10)	
			));	
		}
	}
}