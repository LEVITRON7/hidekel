<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' 		=> 'Auth\AuthController',
	'password' 	=> 'Auth\PasswordController',
]);

Route::group(['middleware' => [ 'auth'],'prefix' => 'admin', 'namespace' => 'Admin'], function(){
	/*
	*  Rutas para el controlador users
	*
	*/
	Route::get('welcome', [
			'as' 	=> 'admin.welcome',
			'uses' 	=> 'UsersController@welcome']);

	Route::group(['middleware' => ['auth','admin'],'prefix' 	=> 'users'],function(){

		Route::get('/', [
				'as' 	=> 'admin.users',
				'uses' 	=> 'UsersController@index']);

		Route::get('show/{id}', [
				'as' 	=> 'admin.users.show',
				'uses' 	=> 'UsersController@show']);

		Route::post('create', [
				'as' 	=> 'admin.users.create',
				'uses' 	=> 'UsersController@store']);

		Route::get('create', [
				'as' 	=> 'admin.users.create',
				'uses' 	=> 'UsersController@create']);

		Route::get('edit/{id}', [
				'as' 	=> 'admin.users.edit',
				'uses' 	=> 'UsersController@edit']);

		Route::put('edit/{id}', [
				'as' 	=> 'admin.users.update',
				'uses' 	=> 'UsersController@update']);

		Route::delete('delete/{id}', [
				'as' 	=> 'admin.users.delete',
				'uses' 	=> 'UsersController@delete']);
	});
	/*
	*  Rutas para el controlador events
	*
	*/
	Route::group(['prefix' 	=> 'events'], function(){
		Route::get('/', [
				'as' 	=> 'admin.events',
				'uses' 	=> 'EventsController@index']);

		Route::get('show/{id}', [
				'as' 	=> 'admin.events.show',
				'uses' 	=> 'EventsController@show']);

		Route::post('create', [
				'as' 	=> 'admin.events.create',
				'uses' 	=> 'EventsController@store']);

		Route::get('create', [
				'as' 	=> 'admin.events.create',
				'uses' 	=> 'EventsController@create']);

		Route::get('edit/{id}', [
				'as' 	=> 'admin.events.edit',
				'uses' 	=> 'EventsController@edit']);

		Route::put('edit/{id}', [
				'as' 	=> 'admin.events.update',
				'uses' 	=> 'EventsController@update']);

		Route::delete('delete/{id}', [
				'as' 	=> 'admin.events.delete',
				'uses' 	=> 'EventsController@delete']);

		Route::delete('deleteposter/{id}', [
				'as' 	=> 'admin.events.deleteposter',
				'uses' 	=> 'EventsController@deleteposter']);

		Route::post('filter_search',[
				'as' 	=> 'app.events.filter_search',
				'uses' 	=> 'EventsController@filter_search'
				]);
	});


	/*
	*  Rutas para el controlador members
	*
	*/
	Route::group(['prefix' 	=> 'members'], function(){
		Route::get('/', [
				'as' 	=> 'admin.members',
				'uses' 	=> 'MembersController@index']);

		Route::get('show/{id}', [
				'as' 	=> 'admin.members.show',
				'uses' 	=> 'MembersController@show']);

		Route::post('create', [
				'as' 	=> 'admin.members.create',
				'uses' 	=> 'MembersController@store']);

		Route::get('create', [
				'as' 	=> 'admin.members.create',
				'uses' 	=> 'MembersController@create']);

		Route::get('edit/{id}', [
				'as' 	=> 'admin.members.edit',
				'uses' 	=> 'MembersController@edit']);

		Route::put('edit/{id}', [
				'as' 	=> 'admin.members.update',
				'uses' 	=> 'MembersController@update']);

		Route::delete('delete/{id}', [
				'as' 	=> 'admin.members.delete',
				'uses' 	=> 'MembersController@delete']);

		Route::post('filter_search', [
				'as' 	=> 'admin.members.filter_search',
				'uses' 	=> 'MembersController@filter_search']);

		Route::post('filter_type', [
				'as' 	=> 'admin.members.filter_type',
				'uses' 	=> 'MembersController@filter_type']);

		Route::post('choise_class_by_club', [
				'as' 	=> 'admin.members.choise_class_by_club',
				'uses' 	=> 'MembersController@choise_class_by_club']);

		Route::delete('deletephoto/{id}', [
				'as' 	=> 'admin.members.deletephoto',
				'uses' 	=> 'MembersController@deletephoto']);
		Route::get('prueba/', [
				'as' 	=> 'admin.members.prueba',
				'uses' 	=> 'MembersController@prueba']);
	});	
	/*
	*  Rutas para el controlador activities
	*
	*/
	Route::group(['prefix' => 'activities'], function(){
		Route::get('/', [
				'as' 	=> 'admin.activities',
				'uses' 	=> 'ActivitiesController@index']);

		Route::get('add/multimedia/{id}', [
				'as' 	=> 'admin.activities.add_multimedia',
				'uses' 	=> 'ActivitiesController@add_multimedia']);

		Route::delete('deletemultimedia/{id}', [
				'as' 	=> 'admin.activities.deletemultimedia',
				'uses' 	=> 'ActivitiesController@deletemultimedia']);

		Route::get('edit/{id}', [
				'as' 	=> 'admin.activities.edit',
				'uses' 	=> 'EventsController@edit']);

		Route::put('edit/{id}', [
				'as' 	=> 'admin.activities.update',
				'uses' 	=> 'EventsController@update']);

		Route::delete('delete/{id}', [
				'as' 	=> 'admin.activities.delete',
				'uses' 	=> 'EventsController@delete']);

		Route::delete('deleteposter/{id}', [
				'as' 	=> 'admin.activities.deleteposter',
				'uses' 	=> 'EventsController@deleteposter']);

		Route::post('filter_search',[
				'as' 	=> 'admin.activities.filter_search',
				'uses' 	=> 'ActivitiesController@filter_search'
				]);
		Route::delete('delete/{id}',[
				'as' 	=> 'admin.activities.delete',
				'uses' 	=> 'ActivitiesController@delete'
				]);
		Route::get('show/{id}',[
				'as' 	=> 'admin.activities.show',
				'uses' 	=> 'ActivitiesController@show'
				]);
		Route::get('multimedias/show/{id}',[
				'as'	=>	'admin.activities.multimedias.show',
				'uses'	=>	'ActivitiesMultimediasController@show']);
	});
	/*
	*  Rutas para el controlador files
	*
	*/

	Route::post('uploadfiles',[
			'as' 	=> 'admin.uploadfiles',
			'uses' 	=> 'FilesController@uploadfiles'
			]);
	Route::post('uploadvideos',[
			'as' 		=> 'admin.uploadvideos',
			'uses' 		=> 'FilesController@uploadvideos'
			]);
	Route::delete('deleteimage/{id}',[
			'as'		=> 'admin.deleteimage',
			'uses' 		=> 'FilesController@deleteimage'
			]);
	Route::delete('deletevideo/{id}',[
			'as'		=> 'admin.deletevideo',
			'uses' 		=> 'FilesController@deletevideo'
			]);
	Route::delete('deletefile/{id}',[
			'as'		=> 'admin.deletefile',
			'uses' 		=> 'FilesController@deletefile'
			]);

	/*	
	*  Rutas para el controlador materials
	*
	*/
	Route::group(['prefix' => 'materials'],function(){
		Route::get('/', [
				'as' 		=> 'admin.materials',
				'uses' 		=> 'MaterialsController@index']);

		Route::get('show/{id}', [
				'as' 		=> 'admin.materials.show',
				'uses'		=> 'MaterialsController@show']);

		Route::post('create', [
				'as' 		=> 'admin.materials.create',
				'uses' 		=> 'MaterialsController@store']);

		Route::get('create', [
				'as' 		=> 'admin.materials.create',
				'uses'		=> 'MaterialsController@create']);

		Route::get('edit/{id}', [
				'as' 	=> 'admin.materials.edit',
				'uses' 	=> 'MaterialsController@edit']);

		Route::put('edit/{id}', [
				'as' 	=> 'admin.materials.update',
				'uses' 	=> 'MaterialsController@update']);

		Route::delete('delete/{id}', [
				'as' 	=> 'admin.materials.delete',
				'uses' 	=> 'MaterialsController@delete']);

		Route::delete('deletefile/{id}',[
				'as'		=> 'admin.materials.deletefile',
				'uses' 		=> 'MaterialsController@deletefile'
				]);
		Route::get('file/{id}',[
				'as' 		=> 'admin.materials.getfile',
				'uses' 		=> 'FilesController@getfile'
				]);
		Route::get('getfile/{id}',[
				'as' 		=> 'admin.materials.getfile',
				'uses' 		=> 'MaterialsController@getfile'
				]);

		Route::post('filter_search', [
				'as' 	=> 'admin.materials.filter_search',
				'uses' 	=> 'MaterialsController@filter_search']);

		Route::post('filter_type', [
				'as' 	=> 'admin.materials.filter_type',
				'uses' 	=> 'MaterialsController@filter_type']);

		Route::delete('deletelogo/{id}', [
				'as' 	=> 'admin.materials.deletelogo',
				'uses' 	=> 'MaterialsController@deletelogo']);
		/*	
		*  Rutas para el controlador materials topics
		*
		*/
		Route::group(['prefix' => 'topics'], function(){
			Route::get('/', [
					'as' 		=> 'admin.materials.topics',
					'uses' 		=> 'MaterialsTopicsController@index']);

			Route::get('show/{id}', [
					'as' 		=> 'admin.materials.topics.show',
					'uses'		=> 'MaterialsTopicsController@show']);

			Route::post('create', [
					'as' 		=> 'admin.materials.topics.create',
					'uses' 		=> 'MaterialsTopicsController@store']);

			Route::get('create', [
					'as' 		=> 'admin.materials.topics.create',
					'uses'		=> 'MaterialsTopicsController@create']);

			Route::get('edit/{id}', [
					'as' 	=> 'admin.materials.topics.edit',
					'uses' 	=> 'MaterialsTopicsController@edit']);

			Route::put('edit/{id}', [
					'as' 	=> 'admin.materials.topics.update',
					'uses' 	=> 'MaterialsTopicsController@update']);

			Route::delete('delete/{id}', [
					'as' 	=> 'admin.materials.topics.delete',
					'uses' 	=> 'MaterialsTopicsController@delete']);
		});

		/*	
		*  Rutas para el controlador materials types
		*
		*/
		Route::group(['prefix' => 'types'],function(){
			Route::get('/', [
					'as' 		=> 'admin.materials.types',
					'uses' 		=> 'MaterialsTypesController@index']);

			Route::get('show/{id}', [
					'as' 		=> 'admin.materials.types.show',
					'uses'		=> 'MaterialsTypesController@show']);

			Route::post('create', [
					'as' 		=> 'admin.materials.types.create',
					'uses' 		=> 'MaterialsTypesController@store']);

			Route::get('create', [
					'as' 		=> 'admin.materials.types.create',
					'uses'		=> 'MaterialsTypesController@create']);

			Route::get('edit/{id}', [
					'as' 	=> 'admin.materials.types.edit',
					'uses' 	=> 'MaterialsTypesController@edit']);

			Route::put('edit/{id}', [
					'as' 	=> 'admin.materials.types.update',
					'uses' 	=> 'MaterialsTypesController@update']);

			Route::delete('delete/{id}', [
					'as' 	=> 'admin.materials.types.delete',
					'uses' 	=> 'MaterialsTypesController@delete']);
		});

	});
	/*	
	*  Rutas para el controlador clubs
	*
	*/
	Route::group(['prefix' => 'clubs'],function(){
			Route::get('/', [
					'as' 		=> 'admin.clubs',
					'uses' 		=> 'ClubsController@index']);

			Route::get('show/{id}', [
					'as' 		=> 'admin.clubs.show',
					'uses'		=> 'ClubsController@show']);

			Route::post('create', [
					'as' 		=> 'admin.clubs.create',
					'uses' 		=> 'ClubsController@store']);

			Route::get('create', [
					'as' 		=> 'admin.clubs.create',
					'uses'		=> 'ClubsController@create']);

			Route::get('edit/{id}', [
					'as' 	=> 'admin.clubs.edit',
					'uses' 	=> 'ClubsController@edit']);

			Route::put('edit/{id}', [
					'as' 	=> 'admin.clubs.update',
					'uses' 	=> 'ClubsController@update']);

			Route::delete('delete/{id}', [
					'as' 	=> 'admin.clubs.delete',
					'uses' 	=> 'ClubsController@delete']);

			Route::delete('deletelogo/{id}', [
					'as' 	=> 'admin.clubs.deletelogo',
					'uses' 	=> 'ClubsController@deletelogo']);
			/*	
			*  Rutas para el controlador clubs classes
			*
			*/
			Route::group(['prefix' => 'classes'],function(){
				Route::get('/', [
						'as' 		=> 'admin.clubs.classes',
						'uses' 		=> 'ClubsClassesController@index']);

				Route::get('show/{id}', [
						'as' 		=> 'admin.clubs.classes.show',
						'uses'		=> 'ClubsClassesController@show']);

				Route::post('create', [
						'as' 		=> 'admin.clubs.classes.create',
						'uses' 		=> 'ClubsClassesController@store']);

				Route::get('create', [
						'as' 		=> 'admin.clubs.classes.create',
						'uses'		=> 'ClubsClassesController@create']);

				Route::get('edit/{id}', [
						'as' 	=> 'admin.clubs.classes.edit',
						'uses' 	=> 'ClubsClassesController@edit']);

				Route::put('edit/{id}', [
						'as' 	=> 'admin.clubs.classes.update',
						'uses' 	=> 'ClubsClassesController@update']);

				Route::delete('delete/{id}', [
						'as' 	=> 'admin.clubs.classes.delete',
						'uses' 	=> 'ClubsClassesController@delete']);

				Route::delete('deletelogo/{id}', [
						'as' 	=> 'admin.clubs.classes.deletelogo',
						'uses' 	=> 'ClubsClassesController@deletelogo']);
			});

			/*	
			*  Rutas para el controlador clubs roles
			*
			*/
			Route::group(['prefix' => 'roles'],function(){
				Route::get('/', [
						'as' 		=> 'admin.clubs.roles',
						'uses' 		=> 'ClubsRolesController@index']);

				Route::get('show/{id}', [
						'as' 		=> 'admin.clubs.roles.show',
						'uses'		=> 'ClubsRolesController@show']);

				Route::post('create', [
						'as' 		=> 'admin.clubs.roles.create',
						'uses' 		=> 'ClubsRolesController@store']);

				Route::get('create', [
						'as' 		=> 'admin.clubs.roles.create',
						'uses'		=> 'ClubsRolesController@create']);

				Route::get('edit/{id}', [
						'as' 	=> 'admin.clubs.roles.edit',
						'uses' 	=> 'ClubsRolesController@edit']);

				Route::put('edit/{id}', [
						'as' 	=> 'admin.clubs.roles.update',
						'uses' 	=> 'ClubsRolesController@update']);

				Route::delete('delete/{id}', [
						'as' 	=> 'admin.clubs.roles.delete',
						'uses' 	=> 'ClubsRolesController@delete']);
			});

			Route::group(['prefix' => 'ideals'],function(){
				Route::get('/', [
						'as' 		=> 'admin.clubs.ideals',
						'uses' 		=> 'ClubsIdealsController@index']);

				Route::get('show/{id}', [
						'as' 		=> 'admin.clubs.ideals.show',
						'uses'		=> 'ClubsIdealsController@show']);

				Route::post('create', [
						'as' 		=> 'admin.clubs.ideals.create',
						'uses' 		=> 'ClubsIdealsController@store']);

				Route::get('create', [
						'as' 		=> 'admin.clubs.ideals.create',
						'uses'		=> 'ClubsIdealsController@create']);

				Route::get('edit/{id}', [
						'as' 	=> 'admin.clubs.ideals.edit',
						'uses' 	=> 'ClubsIdealsController@edit']);

				Route::put('edit/{id}', [
						'as' 	=> 'admin.clubs.ideals.update',
						'uses' 	=> 'ClubsIdealsController@update']);

				Route::delete('delete/{id}', [
						'as' 	=> 'admin.clubs.ideals.delete',
						'uses' 	=> 'ClubsIdealsController@delete']);
			});
	});	
	/*	
	*  Rutas para el controlador clubs roles
	*
	*/
	Route::group(['prefix' => 'slides'], function(){
		Route::get('/', [
				'as' 		=> 'admin.slides',
				'uses' 		=> 'SlidesController@index']);

		Route::get('show/{id}', [
				'as' 		=> 'admin.slides.show',
				'uses'		=> 'SlidesController@show']);

		Route::post('create', [
				'as' 		=> 'admin.slides.create',
				'uses' 		=> 'SlidesController@store']);

		Route::get('create', [
				'as' 		=> 'admin.slides.create',
				'uses'		=> 'SlidesController@create']);

		Route::get('edit/{id}', [
				'as' 	=> 'admin.slides.edit',
				'uses' 	=> 'SlidesController@edit']);

		Route::put('edit/{id}', [
				'as' 	=> 'admin.slides.update',
				'uses' 	=> 'SlidesController@update']);

		Route::delete('delete/{id}', [
				'as' 	=> 'admin.slides.delete',
				'uses' 	=> 'SlidesController@delete']);

		Route::delete('deleteimage/{id}', [
				'as' 	=> 'admin.slides.deleteimage',
				'uses' 	=> 'SlidesController@deleteimage']);
	});
});

Route::group([  'prefix' => 'activities'], function(){
	Route::get('/', [
			'as' 		=> 'activities.',
			'uses' 		=> 'ActivitiesController@index']);
	
	Route::get('show/{id}', [
			'as' 	=> 'activities.show',
			'uses' 	=> 'ActivitiesController@show']);

	Route::get('multimedias/show/{id}',[
			'as'	=>	'activities.multimedias.show',
			'uses'	=>	'ActivitiesController@show_multimedia']);

	Route::get('multimedias/',[
		'as'	=>	'activities.multimedias.index',
		'uses'	=>	'MultimediaController@index']);
});

Route::group(['prefix' => 'events'], function(){
	Route::get('/', [
			'as' 		=> 'events',
			'uses' 		=> 'EventsController@index']);
	Route::get('show/{id}', [
			'as' 		=> 'events.show',
			'uses' 		=> 'EventsController@show']);	
});

Route::group(['prefix' => 'materials'], function(){
	Route::get('',[
		'as'	=>	'materials.index',
		'uses'	=>	'MaterialsController@index']);

	Route::get('show/{id}',[
		'as'	=>	'materials.show',
		'uses'	=>	'MaterialsController@show']);

	Route::get('all_of_type/{id}',[
		'as'	=>	'materials.all_of_type',
		'uses'	=>	'MaterialsController@all_of_type']);

	Route::post('filter_search', [
			'as' 	=> 'materials.filter_search',
			'uses' 	=> 'MaterialsController@filter_search']);

	Route::post('filter_type', [
			'as' 	=> 'materials.filter_type',
			'uses' 	=> 'MaterialsController@filter_type']);

});
Route::get('/', [
		'as'	=>	'home',
		'uses'	=>	'HomeController@app']);

Route::group(['prefix' => 'home'], function(){

	Route::get('hidekel',[
		'as'	=>	'home.hidekel',
		'uses'	=>	'HomeController@hidekel']);

	Route::get('clubs',[
		'as'	=>	'home.clubs',
		'uses'	=>	'HomeController@clubs']);

	Route::get('clubs/show/{id}',[
		'as'	=>	'home.clubs.show',
		'uses'	=>	'HomeController@show_club']);

	Route::get('contact', [
			'as' 	=> 'home.contact',
			'uses' 	=> 'HomeController@contact']);

	Route::post('contact', [
			'as' 	=> 'home.contact',
			'uses' 	=> 'HomeController@send_mail']);

});