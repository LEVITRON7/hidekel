<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class MaterialsTopicsTableSeeder extends Seeder{

	public function run()
	{
		$Topics = array("Actividades Misioneras",
						"Artes Domésticas",
						"Artes Vocacionales",
						"Salud y Ciencia",
						"Artes y Habilidades Manuales",
						"Agroindustrias",
						"Naturaleza",
						"Actividades Recreativas",
						"ADRA",
						"Masters",
						"Otros"
						);

		foreach($Topics as $topic) { 
			\DB::table('materials_topics')->insert(array (
				'name'			=>	$topic
			));
		}	
	}
}