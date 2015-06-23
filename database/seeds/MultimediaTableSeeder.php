<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class MultimediaTableSeeder extends Seeder{

	public function run(){
		$faker = Faker::create();
		for ($i=0; $i <10 ; $i++) {
			\DB::table('multimedias')->insert(array (
				'title'				=>	$faker->name,
				'description'		=>	$faker->text,
				'file'				=>	'',
				'type'				=>	$faker->numberBetween(1, 2),
				'event_id'			=>  $faker->numberBetween(1, 10)
			));
		}
	}
}