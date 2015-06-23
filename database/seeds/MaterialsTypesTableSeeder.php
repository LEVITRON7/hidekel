<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class MaterialsTypesTableSeeder extends Seeder{

	public function run()
	{
		$materials = array("Video","Música","Especialidad","Manual","Curso","Cuadernillo","Requisitos","Presentación","Otro");

		foreach($materials as $material) { 
			\DB::table('materials_types')->insert(array (
				'name'			=>	$material
			));
		}	
	}
}