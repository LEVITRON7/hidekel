<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Http\Requests\MaterialsTopicOrTypeRequest;
use Conquis\MaterialsType;
use Illuminate\Support\Facades\Session;

class MaterialsTypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$MaterialsTypes = MaterialsType::paginate(7); 

		if (\Request::ajax()) {
			return view('app.admin.materials.types.pagination',compact('MaterialsTypes'))->render();
		}
		return view('app.admin.materials.types.index',compact('MaterialsTypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('app.admin.materials.types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MaterialsTopicOrTypeRequest $request)
	{
		$array = $request->all();		
		$type = MaterialsType::create($array);
		$type->save();
		Session::flash('messages', 'El tipo de material: '.$type->name.', ha sido creado');
		return redirect('/admin/materials/types');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$type = MaterialsType::FindOrFail($id);
		return view('app.admin.materials.types.edit', compact('type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(MaterialsTopicOrTypeRequest $request,$id)
	{
		$array = $request->all();
		$type = MaterialsType::FindOrFail($id);;
		$type->fill($array);
		$type->save();
		Session::flash('messages', 'El tipo de material: '.$type->name.', ha sido actualizado');
		return redirect('/admin/materials/types');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$type 	= MaterialsType::findOrFail($id);		
		$type->delete();		
		return response()->json(['success' => 200, 'data' => $type]);	
/*		Session::flash('messages', 'El tipo: '.$type->name.' ha sido eliminado');
		return redirect('/admin/materials/types');*/
	}

}
