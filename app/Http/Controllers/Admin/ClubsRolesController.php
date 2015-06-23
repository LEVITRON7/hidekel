<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Conquis\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Conquis\Role;

class ClubsRolesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::paginate(7);
		if (\Request::ajax()) {
			return view('app.admin.clubs.roles.pagination',compact('roles'))->render();
		}
		return view('app.admin.clubs.roles.index',compact('roles'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('app.admin.clubs.roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RoleRequest $request)
	{
		$array = $request->all();		
		$role = Role::create($array);
		$role->save();
		Session::flash('messages', 'El role de club: '.$role->name.', ha sido creado');
		return redirect('/admin/clubs/roles');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::FindOrFail($id);
		return view('app.admin.clubs.roles.edit', compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(RoleRequest $request,$id)
	{
		$array = $request->all();
		$role= Role::FindOrFail($id);
		$role->fill($array);
		$role->save();
		Session::flash('messages', 'El role de club: '.$role->name.', ha sido actualizado');
		return redirect('/admin/clubs/roles');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$role 	= Role::findOrFail($id);		
		$role->delete();
		return response()->json(['success' => 200, 'data' => $role]);
/*		Session::flash('messages', 'El role: '.$topic->name.' ha sido eliminado');
		return redirect('/admin/clubs/roles');*/
	}
}
