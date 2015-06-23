<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class SlideTableSeeder extends Seeder{

	public function run(){
		$faker = Faker::create();
		for ($i=0; $i <5 ; $i++) {
			\DB::table('slides')->insert(array (
				'title'					=>	$faker->name,
				'description'			=>	$faker->text,
				'file'					=>	'',
				'event_id'				=>  $faker->numberBetween(1, 10)
			));
		}
	}
}