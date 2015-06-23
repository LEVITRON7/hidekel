<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

Class RoleTableSeeder extends Seeder{

	public function run()
	{
		$faker = Faker::create();
		$arrayRol = array('Director','Subdirector','Secretario','Tesorero','Instructor','Consejero Titular','Consejero Auxiliar','Capitán','Integrante');
		foreach ( $arrayRol as $rol) { 
			\DB::table('roles')->insert(array (
				'name'			=>	 $rol
			));
		}
	}
}