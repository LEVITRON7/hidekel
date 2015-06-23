<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Conquis\Http\Requests\CreateClubRequest;
use Conquis\Http\Requests\EditClubRequest;
use Illuminate\Http\Request;
use Conquis\Club;

class ClubsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clubs = Club::paginate(7);
        if (\Request::ajax()){
            return view('app.admin.clubs.pagination', compact('clubs'))->render();
        }
		return view('app.admin.clubs.index', compact('clubs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('app.admin.clubs.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateClubRequest $request)
	{

		$array = $request->all();
		$functions = new Functions();

		if ($request->hasFile('logo'))
		{
			$filename = $functions->SaveFileToDisk($request->file('logo'),'/images/logos/');
			$array['logo'] = $filename;
		}

		$club = Club::create($array);
		$club->save();
		Session::flash('messages', 'El club: '.$club->type.' '.$club->name.', ha sido creado');
		return redirect('/admin/clubs/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */	
	public function show($id)
	{
		$club = Club::findOrFail($id);
		return view('app.admin.clubs.show', compact('club'));
	}	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
		$functions = new Functions();
		$club = Club::findOrFail($id);
		$filejson = $functions->ImageParserToFormatPreview([$club->logo],'/admin/clubs/deletelogo/','/images/logos/');
		$filejson = json_encode($filejson);
 		return view('app.admin.clubs.edit',compact('club','filejson'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditClubRequest $request, $id)
	{
		$functions 	= new Functions();
		$club 		= Club::findOrFail($id);
		$array 		= $request->all();
	
		if ($request->hasFile('logo'))
		{
			$filename = $functions->UpdateFileToDisk($request->file('logo'),$club->logo,'/images/logos/');
			$array['logo'] = $filename;
		}
		
		$club->fill($array);
		$club->save();
		Session::flash('messages', 'El club: '.$club->type.' '.$club->name.', ha sido actualizado');
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
		$club = Club::findOrFail($id);		
		$club->delete();
		return response()->json(['success' => 200, 'data' => $club ]);
/*		Session::flash('messages', 'El club: '.$club->type.' '.$club->name.', ha sido eliminado');
		return redirect('/admin/clubs/');*/
	}

	public function deletelogo($id)
	{	
		$club 	= Club::where('logo','=',$id)->update(array('logo' => ''));
		$functions 	= new Functions();		
		if ($functions->DeleteFileFromDisk($id,'/images/logos/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}
}

