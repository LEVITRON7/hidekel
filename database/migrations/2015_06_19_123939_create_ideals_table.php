<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ideals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',50);		
			$table->longText('value');
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
		Schema::drop('ideals');
	}

}