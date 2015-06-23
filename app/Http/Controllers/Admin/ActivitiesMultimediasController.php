<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Event;
class ActivitiesMultimediasController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
		return view('app.admin.activities.multimedias.show', compact('multimedias','activity'));
		//dd($multimedias);
	}

}
