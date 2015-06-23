<?php namespace Conquis\Http\Controllers\Admin;
use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Http\Requests\MaterialsTopicOrTypeRequest;
use Conquis\MaterialsTopic;
use Illuminate\Support\Facades\Session;

class MaterialsTopicsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$MaterialsTopics = MaterialsTopic::paginate(7);
		if (\Request::ajax()) {
			return view('app.admin.materials.topics.pagination',compact('MaterialsTopics'))->render();
		}
		return view('app.admin.materials.topics.index',compact('MaterialsTopics'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('app.admin.materials.topics.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MaterialsTopicOrTypeRequest $request)
	{
		$array = $request->all();		
		$topic = MaterialsTopic::create($array);
		$topic->save();
		Session::flash('messages', 'El tópico de material: '.$topic->name.', ha sido creado');
		return redirect('/admin/materials/topics');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$topic = MaterialsTopic::FindOrFail($id);
		return view('app.admin.materials.topics.edit', compact('topic'));
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
		$topic = MaterialsTopic::FindOrFail($id);
		$topic->fill($array);
		$topic->save();
		Session::flash('messages', 'El tópico de material: '.$topic->name.', ha sido actualizado');
		return redirect('/admin/materials/topics');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$topic 	= MaterialsTopic::findOrFail($id);		
		$topic->delete();
		return response()->json(['success' => 200, 'data' => $topic]);		
/*		Session::flash('messages', 'El tópico: '.$topic->name.' ha sido eliminado');
		return redirect('/admin/materials/topics');*/
	}
}
