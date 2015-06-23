<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Conquis\Http\Requests\CreateUserRequest;
use Conquis\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Session;
use Conquis\User;
use Conquis\Member;

class UsersController extends Controller {

	public function __construct(){
		$this->typeselect =  array(	''		=>'@Selecciona un tipo',
									'admin' => 'admin', 
									'user' 	=> 'user');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function  welcome(){
		return view('app.admin.users.welcome');
	}

	public function index()
	{
	 	$users = User::paginate(7);
        if (\Request::ajax()){
            return view('app.admin.users.pagination', compact('users'))->render();
        }
	 	return view('app.admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	$members = new Member();
		$membersselect = $members->ArrayIdNameWithoutUsed();
		$membersselect[''] = '@Selecciona un miembro';
		asort($membersselect);
		$membersselect[-1] = 'Ninguno';
		$typeselect = $this->typeselect;
		return view('app.admin.users.create', compact('membersselect', 'typeselect'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{	
		$user = User::create($request->all());
		$member = new Member();
		if ($request->member_id != -1) {
			$member->AddUser($user->id, $request->member_id);	
		}
		$user->save();
		Session::flash('messages', 'El usuario: '.$user->email.' ha sido creado');
		return redirect('/admin/users/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		return view('app.admin.users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		$members = new Member();
		$membersselect = $members->ArrayIdNameWithoutUsed();
		$membersselect[''] = '@Selecciona un miembro';		
		if($user->member != null){
			$membersselect[$user->member->id] = $user->member->full_name;
		}else {			
			$member = new Member();
			$member->id = 0;
			$user->member = $member;
		}
		asort($membersselect);
		$membersselect[-1] = 'Ninguno';
		$typeselect = $this->typeselect;
		return view('app.admin.users.edit', compact('user','membersselect', 'typeselect'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditUserRequest $request, $id)
	{
			$user = User::findOrFail($id);
			$member = new Member();

			/*Se manda a cambiar el miembro al que pertenece el usuario*/
			if (($request->member_id == -1) or ($request->member_id == '')) {
				if ($user->member != null) {
						$member = Member::find($user->member->id);
						$member->user_id = null;
						$member->save();
					}
			}else{
				if($user->member == null){
					$new_member = Member::find($request->member_id);
					$new_member->user_id = $user->id;
					$new_member->save();
				}else{
					$member->ChangeUserIdOfMember($user->id,$request->member_id,$user->member->id);
				}	
			}					
			$user->fill($request->all());
			$user->save();
		Session::flash('messages', 'El usuario: '.$user->email.' ha sido actualizado');
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
			$user 	= 	User::findOrFail($id);
			$user->delete();			
		return response()->json(['success' => 200, 'data' => $user]);
/*			Session::flash('messages', 'El usuario: '.$user->email.' ha sido eliminado');
		return redirect('/admin/users/');*/
	}

}
