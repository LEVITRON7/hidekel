<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('AdminTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('ClubTableSeeder');		
		$this->call('ClubClassTableSeeder');
		$this->call('IdealTableSeeder');
		$this->call('MaterialsTopicsTableSeeder');
		$this->call('MaterialsTypesTableSeeder');
		$this->call('MaterialTableSeeder');
		$this->call('EventTableSeeder');
		//$this->call('MultimediaTableSeeder');
		$this->call('RoleTableSeeder');
		$this->call('MemberTableSeeder');
		$this->call('SlideTableSeeder');
	}

}
