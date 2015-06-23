<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Conquis\Http\Requests\CreateEventRequest;
use Conquis\Http\Requests\EditEventRequest;
use Illuminate\Support\Facades\Session;
use Conquis\Event;
use Conquis\Club;

class EventsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

		$Events = new Event();
		$events = $Events->recents;

		$functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		asort($clubsselect_filter);

        if (\Request::ajax()){
            return view('app.admin.events.pagination', compact('events','clubsselect_filter'))->render();
        }
		return view('app.admin.events.index', compact('events','clubsselect_filter'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		asort($clubsselect);
		$user_id = \Auth::user()->id;
		return view('app.admin.events.create', compact('clubsselect','user_id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateEventRequest $request)
	{	
		$functions = new Functions();
		$array = $request->all();
		$array['datetime_start'] = $functions->DateStringToObject($array['datetime_start']);
		$array['datetime_end'] = $functions->DateStringToObject($array['datetime_end']);
		
		if ($request->hasFile('poster'))
		{
			$filename = $functions->SaveFileToDisk($request->file('poster'),'/images/posters/');
			$array['poster'] = $filename;
		}	
 
		$event = Event::create($array);
		//dd($array);
		//dd($event);
		$event->save();
		Session::flash('messages', 'El evento: '.$event->title.', ha sido creado');
		return redirect('/admin/events/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Event::findOrFail($id);
		return view('app.admin.events.show', compact('event'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $id)
	{
		$functions 		= new Functions();
		$date 			= new \Date();
		$event 			= Event::findOrFail($id);		

		$clubs 			= Club::all();
		$clubsselect 	= $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		asort($clubsselect);
		/*Se cambian las fechas al formato datetimepicker para la vista*/		
		$event->DateTimeTodatetimepicker();
		$filejson = $functions->ImageParserToFormatPreview([$event->poster],'/admin/events/deleteposter/','/images/posters/');
		$filejson = json_encode($filejson);
		return view('app.admin.events.edit', compact('event','clubsselect','filejson'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditEventRequest $request, $id)
	{
		$functions = new Functions();
		$event = Event::findOrFail($id);
		$array = $request->all();

		$array['datetime_start'] = $functions->DateStringToObject($array['datetime_start']);
		$array['datetime_end'] = $functions->DateStringToObject($array['datetime_end']);
		if($array['user_id'] == null){			
			$array['user_id'] = \Auth::user()->id;			
		}		
		if ($request->hasFile('poster'))
		{
			$filename = $functions->UpdateFileToDisk($request->file('poster'),$event->poster,'/images/posters/');
			$array['poster'] = $filename;
		}	
 
		$event->fill($array);
		//dd($array);
		//dd($event);
		$event->save();
		Session::flash('messages', 'El evento: '.$event->title.' ha sido actualizado');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
			$event 	= 	Event::findOrFail($id);
			$event->delete();
			return response()->json(['success' => 200, 'data' => $event]);	
		// 	Session::flash('messages', 'El evento: '.$event->title.' ha sido eliminado');
		// return redirect('/admin/events/');
	}

	public function deleteposter($id){
		$event 	= Event::where('poster','=',$id)->update(array('poster' => ''));
		$functions 	= new Functions();
		if ($functions->DeleteFileFromDisk($id,'/images/posters/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}

	public function filter_search(){
		$club = \Input::get('filter_club');
		$Event = new Event();		
		$Events = $Event->where('datetime_start', '>=', new \DateTime('now'))
						->orWhere('datetime_end', '>=', new \DateTime('now'))
						->orderBy('datetime_start','asc')
							->get();							
		$result 	= 	[];
		foreach ($Events  as $e) {
			if ($e->club->id == $club) {
				$result[] = $e;
			}
		}
		$events = $result;
		return view('app.admin.events.results', compact('events'));
	}
}
