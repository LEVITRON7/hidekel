<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clubs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',50);		
			$table->longText('description')->nullable();
			$table->string('type');
			$table->string('logo');
			$table->timestamps(); //Created_at update_at
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clubs');
	}

}