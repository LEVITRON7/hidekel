<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',100);
			$table->string('file');
			$table->string('logo');
			$table->string('extension');
			$table->string('description');

			$table->integer('club_id')->unsigned();			
			$table->foreign('club_id')
					->references('id')
					->on('clubs')
					->onDelete('cascade');

			$table->integer('topic_id')->unsigned()->nullable();		
			$table->foreign('topic_id')
					->references('id')
					->on('materials_topics')
					->onDelete('cascade');

			$table->integer('type_id')->unsigned()->nullable();
			$table->foreign('type_id')
					->references('id')
					->on('materials_types')
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
		Schema::drop('materials');
	}

}