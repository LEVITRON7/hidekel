<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->date('burn');
			$table->string('photo')->nullable;
			$table->enum('sex',['Hombre','Mujer']);
			$table->boolean('confirmed');

			$table->integer('role_id')->unsigned()->nullable();			
			$table->foreign('role_id')
					->references('id')
					->on('roles')
					->onDelete('cascade');

			$table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')
					->references('id')
					->on('club_classes')
					->onDelete('cascade');

			$table->integer('club_id')->unsigned()->nullable();
			$table->foreign('club_id')
					->references('id')
					->on('clubs')
					->onDelete('cascade');

			$table->integer('user_id')->unsigned()->nullable()->unique();
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
		Schema::drop('members');
	}

}