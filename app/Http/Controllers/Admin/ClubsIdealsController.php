<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Conquis\Http\Requests\IdealRequest;

use Illuminate\Http\Request;
use Conquis\Ideal;
use Conquis\Club;

class ClubsIdealsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ideals = Ideal::paginate(7);
        if (\Request::ajax()){
            return view('app.admin.clubs.ideals.pagination', compact('ideals'))->render();
        }
		return view('app.admin.clubs.ideals.index', compact('ideals'));
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
		return view('app.admin.clubs.ideals.create',compact('clubsselect'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(IdealRequest $request)
	{
		$array = $request->all();
		$functions = new Functions();
		$ideal = Ideal::create($array);
		$ideal->save();
		Session::flash('messages', 'El ideal: '.$ideal->name.', ha sido creado');
		return redirect('admin/clubs/ideals');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ideal = Ideal::findOrFail($id);
		return view('app.admin.clubs.ideals.show',compact('ideal'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ideal = Ideal::findOrFail($id);
		$functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Elija un club';
		asort($clubsselect);

		return view('app.admin.clubs.ideals.edit',compact('clubsselect','ideal'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(IdealRequest $request, $id)
	{
		$ideal = Ideal::findOrFail($id);
		$array = $request->all();
		$functions = new Functions();
		$ideal->fill($array);
		$ideal->save();
		Session::flash('messages', 'El ideal: '.$ideal->name.', ha sido actualizado');
		return redirect('admin/clubs/ideals');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$ideal 	= Ideal::findOrFail($id);		
		$ideal->delete();
		return response()->json(['success' => 200, 'data' => $ideal]);
/*		Session::flash('messages', 'El role: '.$topic->name.' ha sido eliminado');
		return redirect('/admin/clubs/roles');*/
	}
}
