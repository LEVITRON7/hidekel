<?php namespace Conquis\Http\Controllers;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Conquis\Event;

class EventsController extends Controller {

    public function __construct()
    {
        //$this->middleware('auth', ['only' => ['delete','update','create']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Event = new Event();
		$Events = $Event->recents;
		if(\Request::ajax()){
			return view('app.events.pagination', compact('Events'))->render();	
		}
		return view('app.events.index', compact('Events'));
	}
	public function show($id)
	{
		$event = Event::findOrFail($id);
		return view('app.events.show', compact('event'));
	}
}
