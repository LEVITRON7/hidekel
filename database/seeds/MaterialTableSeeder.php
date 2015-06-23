<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class MaterialTableSeeder extends Seeder{

	public function run()
	{
		$faker = Faker::create();
		$materials = array("Video","Música","Especialidad","Manual","Curso","Cuadernillo","Requisitos","Presentación");
		$users =\DB::table('users')->get();

		for($i=0;$i<10;$i++){
			\DB::table('materials')->insert(array (
				'name'			=>	$faker->name,
				'file'			=>	'',
				'logo'			=>	'',
				'extension'		=>  '',
				'description'	=>  $faker->text,
				'topic_id'		=>	$faker->numberBetween(1, 10),
				'club_id'		=>	$faker->numberBetween(1, 3),
				'user_id'		=>  $faker->numberBetween(1, 10),
				'type_id'		=>	$faker->numberBetween(1, 7)
			));
		}	
	}
}
