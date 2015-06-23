<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',100);
			$table->longText('description');
			$table->string('address');
			$table->datetime('datetime_start');
			$table->datetime('datetime_end');
			$table->double('location_latitude')->nullable();
			$table->double('location_longitude')->nullable();
			$table->string('poster')->nullable();

			$table->integer('club_id')->unsigned();			
			$table->foreign('club_id')
					->references('id')
					->on('clubs')
					->onDelete('cascade');

			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('set null');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}