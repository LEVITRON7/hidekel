<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Conquis\Http\Requests\ClassRequest;
use Conquis\Club;
use Conquis\ClubClass;

class ClubsClassesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$classes = ClubClass::paginate(7);
        if (\Request::ajax()){
            return view('app.admin.clubs.classes.pagination', compact('classes'))->render();
        }
		return view('app.admin.clubs.classes.index', compact('classes'));
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
		$clubsselect[''] = '@Elija un club';
		asort($clubsselect);
		return view('app.admin.clubs.classes.create',compact('clubsselect'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ClassRequest $request)
	{
		$array = $request->all();

		$functions = new Functions();

		if ($request->hasFile('logo'))
		{
			$filename = $functions->SaveFileToDisk($request->file('logo'),'/images/logos/');
			$array['logo'] = $filename;
		}

		$class = ClubClass::create($array);
		$class->save();
		Session::flash('messages', 'La clase: '.$class->name.', ha sido creado');
		return redirect('admin/clubs/classes');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$class = ClubClass::findOrFail($id);
		$functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Elija un club';
		asort($clubsselect);

		$filejson = $functions->ImageParserToFormatPreview([$class->logo],'/admin/clubs/classes/deletelogo/','/images/logos/');
		$filejson = json_encode($filejson);

		return view('app.admin.clubs.classes.edit',compact('clubsselect','class','filejson'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ClassRequest $request, $id)
	{
		$class = ClubClass::findOrFail($id);
		$array = $request->all();
		$functions = new Functions();

		if ($request->hasFile('logo'))
		{
			$filename = $functions->UpdateFileToDisk($request->file('logo'),$class->logo,'/images/logos/');
			$array['logo'] = $filename;
		}

		$class->fill($array);
		$class->save();
		Session::flash('messages', 'La clase: '.$class->name.', ha sido actualizado');
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
		$class = ClubClass::findOrFail($id);
		$class->delete();
		return response()->json(['success' => 200, 'data' => $class]);
/*		Session::flash('messages', 'La clase: '.$class->name.', ha sido eliminado');
		return redirect('admin/clubs/classes');*/
	}

	public function deletelogo($id)
	{	
		$club 	= ClubClass::where('logo','=',$id)->update(array('logo' => ''));
		$functions 	= new Functions();		
		if ($functions->DeleteFileFromDisk($id,'/images/logos/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}
}
