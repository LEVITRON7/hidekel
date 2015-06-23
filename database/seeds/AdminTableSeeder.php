<?php

use Illuminate\Database\Seeder;

Class AdminTableSeeder extends Seeder{

	public function run()
	{
		\DB::table('users')->insert(array (
			'email'			=>	'yonny90_15@hotmail.com',
			'password'		=>	\Hash::make('yoloco'),
			'type'			=>	'admin'
		));
	}
}