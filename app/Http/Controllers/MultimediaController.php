<?php namespace Conquis\Http\Controllers;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Event;
use Conquis\Multimedia;

class MultimediaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Event = new Event();
		$multimedias = Multimedia::all();
		$Activities = $Event->where('datetime_start', '<=', new \DateTime('today'))
					->orderBy('datetime_start','desc')
					->get();		
		$fotos = [];
		$videos = [];
		foreach ($Activities as $activity) {
			foreach ($activity->multimedias as $multimedia) {
				if ($multimedia->type == 'Video') {					
					$multimedia->file = '<div class="img-responsive" style="float:left;margin:10px;" > <h3 style="margin-top:5px;">'.$multimedia->title.'</h3><iframe class="video-youtube" width="335" height="260" src="'.str_replace("watch?v=", "embed/", $multimedia->file).'" frameborder="0" allowfullscreen></iframe></div>';
					//dd($multimedia->file);
				}
			}
		}

		return view('app.multimedias.index',compact('Activities','multimedias'));
	}
}
