<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Slide;
use Conquis\Event;
use Conquis\Http\Requests\SlideRequest;
use Illuminate\Support\Facades\Session;

class SlidesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$slides = Slide::paginate(3);
		if (\Request::ajax()) {
			return view('app.admin.slides.pagination',compact('slides'))->render();
		}
		return view('app.admin.slides.index',compact('slides'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$functions = new Functions();
		$events = Event::all();
		$eventsselect = $functions->CollectionToArray($events,'id',['title']);
		$eventsselect[-1] = 'Ninguno';
		$eventsselect[''] = '@Selecciona un evento';

		return view('app.admin.slides.create',compact('eventsselect'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SlideRequest $request)
	{
		$functions = new Functions();
		$array = $request->all();
		//dd($array);

		if ($request->hasFile('file'))
		{	$file = $request->file('file');
			$filename = $functions->SaveFileToDisk($file,'/images/slides/');
			$array['file'] = $filename;
			$array['extension'] = $file->getClientOriginalExtension();
		}
		if (($array['event_id']==-1) or $array['event_id']=='') {
			$array['event_id']=null;
		}
		$slides = Slide::create($array);
		//dd($array);
		//dd($event);
		$slides->save();
		Session::flash('messages', 'La imagen: '.$slides->title.', ha sido guardada');
		return redirect('/admin/slides/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$slide = Slide::FindOrFail($id);
		return view('app.admin.slides.show',compact('slide'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$slide = Slide::findOrFail($id);
		$functions = new Functions();
		$events = Event::all();
		$eventsselect = $functions->CollectionToArray($events,'id',['title']);
		$eventsselect[''] = '@Selecciona un evento';
		$eventsselect[-1] = 'Ninguno';
		$filejson = $functions->ImageParserToFormatPreview([$slide->file],'/admin/slides/deleteimage/','/images/slides/');
		$filejson = json_encode($filejson);
		return view('app.admin.slides.edit',compact('eventsselect','slide','filejson'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(SlideRequest $request,$id)
	{
		$functions = new Functions();
		$array = $request->all();
		$image = Slide::findOrFail($id);
		//dd($array);

		if ($request->hasFile('file'))
		{	$file = $request->file('file');
			$filename = $functions->UpdateFileToDisk($file,$image->file,'/images/slides/');
			$array['file'] = $filename;
			$array['extension'] = $file->getClientOriginalExtension();
		}
		if (($array['event_id']==-1) or $array['event_id']=='') {
			$array['event_id']=null;
		}	
		//dd($array);
		$image->fill($array);
		$image->save();
		Session::flash('messages', 'La imagen: '.$image->title.', ha sido actualizada');
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
		$functions 	= new Functions();
		$image 		= Slide::findOrFail($id);		
		if ($image->delete()){
			$functions->DeleteFileFromDisk($image->file,'/images/slides/');
		}
		return response()->json(['success' => 200, 'data' => $image]);	
/*		Session::flash('messages', 'La imagen: '.$image->title.' ha sido eliminada');
		return redirect('/admin/slides');*/
	}
	
	public function deleteimage($id){
		$image 	= Slide::where('file','=',$id)->update(array('file' => ''));
		$functions 	= new Functions();
		if ($functions->DeleteFileFromDisk($id,'/images/slides/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}
}
