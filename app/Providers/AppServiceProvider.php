<?php namespace Conquis\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use Conquis\MaterialsType;
use Conquis\Club;
use Conquis\Http\Controllers\Admin\Functions;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()	
	{	

		//Se provee el  menu de todos los tipos de materiales
     	View::composer(['*'], function($view)
        {
        	$functions  = new Functions();
        	$materials  = MaterialsType::all();
            $clubs      =   Club::all();
            $clubsmenu  = $functions->CollectionToArray($clubs,'id',['type','name']);
        	$materialsmenu = $functions->CollectionToArray($materials,'id',['name']);
        	$view->with(compact('materialsmenu','clubsmenu'));

        });
/*-------------------Menu general para members ----------------*/
        View::composer(['app.admin.members.*'],
		function($view)
        {
        	$menu = [[	'href'  =>'/admin/members/create',
        				'text'  =>'Agregar Miembro', 
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ],
        			];
        	$view->with(compact('menu'));
        });
/*-------------------Menu general para users ----------------*/
        View::composer(['app.admin.users.*'],
		function($view)
        {
        	$menu = [[	'href'  =>'/admin/users/create',
        				'text'  => 'Agregar Usuario',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-user-plus"></i>&nbsp;'
                        ],
        			];
        	$view->with(compact('menu'));
        });

/*-------------------Menu general para activities and events ----------------*/
        View::composer(['app.admin.activities.*',
        				'app.admin.events.*'],
		function($view)
        {
        	$menu = [[	'href'  =>'/admin/events/create',
        				'text'  =>'Agregar Evento',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ]
        			];
        	$view->with(compact('menu'));
        });

/*-------------------Menu general para materials ----------------*/
        View::composer(['app.admin.materials.*'],
		function($view)
        {
        	$menu = [[	'href'  =>'/admin/materials/create',
        				'text'  =>'Agregar Material',
        				'class' => 'btn btn-success',
        				'type'  => 'a',
                        'i'=>  '<i class="fa fa-plus"></i>&nbsp;'
                        ],
        			[	'href'  =>'/admin/materials/types/create',
        				'text'  =>'Agregar tipo de material',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ],
        			[	'href'  =>'/admin/materials/topics/create',
        				'text'  =>'Agregar tópico de material',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ]
        			];
        	$view->with(compact('menu'));
        });
/*-------------------Menu general para Clubs ----------------*/
        View::composer(['app.admin.clubs.*'],
		function($view)
        {
        	$menu = [[	'href'  =>'/admin/clubs/create',
        				'text'  =>'Agregar Club',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ],
        			[	'href'  =>'/admin/clubs/classes/create',
        				'text'  =>'Agregar clase de club',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ],
        			[	'href'  =>'/admin/clubs/roles/create',
        				'text'  =>'Agregar rol de club',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ],
                    [   'href'  =>'/admin/clubs/ideals/create',
                        'text'  =>'Agregar ideal de club',
                        'class' => 'btn btn-success',
                        'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ]
        			];
        	$view->with(compact('menu'));
        });
/*-------------------Menu general para Slides----------------*/
        View::composer(['app.admin.slides.*'],
		function($view)
        {
        	$menu = [[	'href'  =>'/admin/slides/create',
        				'text'  =>'Agregar imagen a Slide',
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-plus"></i>&nbsp;'
                        ]
        			];
        	$view->with(compact('menu'));
        });
/*-------------------Menu general para regresar ----------------*/
        View::composer(['app.admin.*.create'],
		function($view)
        {	
        	$menu = [[	'href'  => \URL::previous(),
        				'text'  =>'Regresar', 
        				'class' => 'btn btn-success ',
        				'type'  => 'a',
                        'i'     =>  '<i class="fa fa-arrow-left"></i>&nbsp;'
                        ],
        			];
        	$view->with(compact('menu'));
        });
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'Conquis\Services\Registrar'
		);
	}

}
