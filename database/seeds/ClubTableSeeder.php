<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class ClubTableSeeder extends Seeder{

	public function run()
	{
		$logos = ['','',''];
		$clubs = ['Aventureros','Conquistadores','Guías Mayores'];
		$faker = Faker::create();
		for ($i=0; $i < 3; $i++) { 
			\DB::table('clubs')->insert(array (
				'name'			=>	'Hidekel',
				'description'	=>	$faker->text,
				'type'			=>	$clubs[$i],
				'logo' 			=>	''
			));
		}

	}
}