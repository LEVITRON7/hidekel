<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Conquis\Event;
use Conquis\Club;
use Conquis\Multimedia;

class ActivitiesController extends Controller {

	/**	
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

		$Event = new Event();		
		$activities= $Event->lasttoday;

		$functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		asort($clubsselect_filter);
		if(\Request::ajax()){
			return view('app.admin.activities.pagination', compact('activities','clubsselect_filter'))->render();	
		}
		return view('app.admin.activities.index', compact('activities','clubsselect_filter'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$activity = Event::findOrFail($id);
		return view('app.admin.activities.show', compact('activity'));
	}

	public function add_multimedia($id){
		$Event = new Event();
		$functions = new Functions();
		$Event = $Event->find($id);
		//dd($Event->multimedias);
		$Images = [];
		$Videos = [];
		foreach ($Event->Multimedias as $multimedia) {
			if ($multimedia->type == 'Foto') {
				$Images[] = $multimedia->file;
			}else{
				$Videos[] = $multimedia;
			}			
		}
		$path_delete = '/admin/activities/deletemultimedia/';
		$preview = $functions->ImageParserToFormatPreview($Images,$path_delete,'/images/multimedia/');
		$fotos = json_encode($preview);		
		return view('app.admin.activities.addmultimedia',compact('fotos','Event','Videos'));
	}
	/**
	 * Delete multimedia
	 *
	 * @return Response
	 */
	public function deletemultimedia($id)
	{	
		$multimedia = new Multimedia;
		$multimedia->where('file','=',$id)->delete();
		$functions 	= new Functions();
		if ($functions->DeleteFileFromDisk($id,'/images/multimedia/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}

	public function filter_search(){
		$club = \Input::get('filter_club');
		$Event = new Event();		
		$activities = $Event->where('datetime_start', '<=', new \DateTime('now'))
							->where('datetime_end', '<=', new \DateTime('now'))
							->orderBy('datetime_end','desc')->get();
		$result 	= 	[];
		foreach ($activities  as $a) {
			if ($a->club->id == $club) {
				$result[] = $a;
			}
		}
		$activities = $result;
		return view('app.admin.activities.results', compact('activities'));
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
	//		Session::flash('messages', 'El evento: '.$event->title.' ha sido eliminado');
	//	return redirect('/admin/events/');
	}
}
