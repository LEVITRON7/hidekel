<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class ClubClassTableSeeder extends Seeder{

	public function run()
	{
	$aventureros  = array("Abejas", "Rayos de Sol", "Constructores", "Manos Ayudadoras");
	$conquis  = array("Amigo", "Compañero", "Explorador", "Orientador", "Viajero", "Guía");
	$guias  = array("Guía Mayor", "Guía Mayor Avanzado", "Guía Mayor Instructor");	
		$faker = Faker::create();
		foreach ($aventureros as $clase) {			

				\DB::table('club_classes')->insert(array (
					'club_id'	=>	 1,
					'name'		=>	 $clase,
					'logo'		=> 	''
				));
		}
		foreach ($conquis as $clase) {			

				\DB::table('club_classes')->insert(array (
					'club_id'	=>	 2,
					'name'		=>	 $clase,
					'logo'		=> 	''
				));
		}
		foreach ($guias as $clase) {			

				\DB::table('club_classes')->insert(array (
					'club_id'	=>	 3,
					'name'		=>	 $clase,
					'logo'		=> 	''
				));
		}
	}
}