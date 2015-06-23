<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('club_classes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',50)->unique();
			$table->string('logo');
			$table->integer('club_id')->unsigned();

			$table->foreign('club_id')
					->references('id')
					->on('clubs')
					->onDelete('cascade');				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('club_classes');
	}

}