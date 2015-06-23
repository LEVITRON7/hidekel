<?php namespace Conquis\Http\Controllers;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Event;

class ActivitiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Event = new Event();
		$Activities = $Event->lasttoday;
		if(\Request::ajax()){
			return view('app.activities.pagination', compact('Activities'))->render();
		}
		return view('app.activities.index', compact('Activities'));
	}
	
	public function show($id)
	{
		$activity = Event::findOrFail($id);
		return view('app.activities.show', compact('activity'));
	}
	public function show_multimedia($id)
	{
		$Event = Event::findOrFail($id);
		$multimedias = $Event->multimedias;

		foreach ($multimedias as $multimedia) {
			if ($multimedia->type == 'Video') {					
				$multimedia->file = '<div class="img-responsive" style="float:left;margin:5px;" > <h3 style="margin-top:5px;">'.$multimedia->title.'</h3><iframe class="video-youtube" width="335" height="260" src="'.str_replace("watch?v=", "embed/", $multimedia->file).'" frameborder="0" allowfullscreen></iframe></div>';
				//dd($multimedia->file);
			}
		}
		$activity = $Event;
		return view('app.activities.multimedias.show', compact('multimedias','activity'));
		//dd($multimedias);
	}
}
