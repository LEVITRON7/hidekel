<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class IdealTableSeeder extends Seeder{

	public function run()
	{

		$faker = Faker::create();
		for ($i=0; $i <3 ; $i++) {
			for ($j=0; $j <5 ; $j++) { 
				\DB::table('ideals')->insert(array (
					'club_id'	=>	 $i + 1,
					'name'		=>	 $faker->name,
					'value'		=> 	 $faker->text(300)
				));
			}
		}
	}
}