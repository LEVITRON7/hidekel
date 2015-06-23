<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Conquis\Http\Requests\CreateMemberRequest;
use Conquis\Http\Requests\EditMemberRequest;
use Illuminate\Support\Facades\Session;
use Conquis\Club;
use Conquis\ClubClass;
use Conquis\Role;
use Conquis\Member;
use Conquis\Event;
use Conquis\MaterialsTopic;

use Illuminate\Database\Eloquent\Collection;
class MembersController extends Controller {

	public function __construct(){
		$this->sexselect =  array(''=>'@Selecciona sexo','Hombre' => 'Hombre', 'Mujer' => 'Mujer');
	}

	public function index()
	{	$functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		$clubsselect_filter[0] = 'Todos';
		asort($clubsselect);
		asort($clubsselect_filter);
	 	$members = Member::paginate(5);
        if (\Request::ajax()) {
            return view('app.admin.members.pagination', compact('members','clubsselect','clubsselect_filter'))->render();
        }
	 	return view('app.admin.members.index', compact('members','clubsselect','clubsselect_filter'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	$functions 		= 	new Functions();
		$clubs 			= 	Club::all();
		$roles 			= 	Role::all();
		$classes 		= 	ClubClass::all();	
		$classesselect 	= 	$functions->CollectionToArray($classes,'id',['name']);
		$clubsselect	= 	$functions->CollectionToArray($clubs,'id',['type','name']);
		$rolesselect	= 	$functions->CollectionToArray($roles,'id',['name']);
		$clubsselect[''] = '@Selecciona un club';
		$rolesselect[''] = '@Selecciona un Rol';
		$classesselect[''] = '@Selecciona una Clase';
		asort($clubsselect);
		asort($rolesselect);
		$sexselect = $this->sexselect;
		return view('app.admin.members.create', compact('clubsselect','rolesselect', 'classesselect','sexselect'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateMemberRequest $request)
	{	
		$array 			= 	$request->all();
		$functions 		= 	new Functions();

		$array['burn'] 	= 	$functions->DateStringToObject($array['burn']);
		if ($request->hasFile('photo'))
		{
			$filename = $functions->SaveFileToDisk($request->file('photo'),'/images/photos/');
			$array['photo'] = $filename;
		}

		$member = Member::create($array);
		$member->save();
		Session::flash('messages', 'El miembro: '.$member->first_name.', ha sido creado');
		return redirect('/admin/members/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$member = Member::findOrFail($id);		
		return view('app.admin.members.show', compact('member'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$functions 		= 	new Functions();
		$member 		= 	Member::findOrFail($id);
		$club 			= 	Club::find($member->clubclass->club->id);
		$clubs 			= 	Club::all();
		$roles 			= 	Role::all();
		$classes 		= 	$club->classes;
		$classesselect	= 	$functions->CollectionToArray($classes,'id',['name']);
		$clubsselect 		= 	$functions->CollectionToArray($clubs,'id',['type','name']);
		$rolesselect		= 	$functions->CollectionToArray($roles,'id',['name']);
		$clubsselect[''] 	= '@Selecciona un club';
		$rolesselect[''] 	= '@Selecciona un Rol';
		$classesselect['']= '@Selecciona una Clase';
		asort($clubsselect);
		asort($rolesselect);
		$sexselect = $this->sexselect;
		/*Se procesa la fecha para poder mostrarla en la vista*/
		$filejson = $functions->ImageParserToFormatPreview([$member->photo],'/admin/members/deletephoto/','/images/photos/');
		$filejson = json_encode($filejson);
		$member->burn = $functions->DateTodatetimepicker($member->burn);
		return view('app.admin.members.edit', compact('member','rolesselect','clubsselect','classesselect','sexselect','filejson'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditMemberRequest $request, $id)
	{
		$functions 		= 	new Functions();
		$member 		= 	Member::findOrFail($id);
		$array 			= 	$request->all();
		$array['burn'] 	= 	$functions->DateStringToObject($array['burn']);		
		if ($request->hasFile('photo'))
		{
			$filename = $functions->UpdateFileToDisk($request->file('photo'),$member->photo,'/images/photos/');
			$array['photo'] = $filename;
		}
		$member->fill($array);
		$member->save();
		Session::flash('messages', 'El miembro: '.$member->full_name.' ha sido actualizado');
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
			$member 	= 	Member::findOrFail($id);
			$member->delete();
		//Session::flash('messages', $member->full_name.' ha sido eliminado');
		//return redirect('/admin/members/');
		return response()->json(['success' => 200, 'data' => $member]);
	}

	public function deletephoto($id){

		$member 	= 	Member::where('photo','=',$id)->update(array('photo' => ''));
		$functions 	= 	new Functions();
		if ($functions->DeleteFileFromDisk($id,'/images/photos/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}

	public function filter_search(){
		$club = \Input::get('filter_club');
		$type = \Input::get('filter_type');
		$search = \Input::get('filter_search');
		switch ($type) {
			case 0: 
				// $club 		= 	Club::find($search);
				// $members 	= 	$club->members;				
				// return view('app.admin.members.results', compact('members'));
				// break;
			case 1:
				$class 		= 	ClubClass::find($search);
				$members 	= 	$class->members;
				return view('app.admin.members.results', compact('members'));
				break;
			case 2:
				$club 		= 	Club::find($club);
				$members 	= 	$club->members;
				$members_result 	= 	[];
				foreach ($members  as $member) {
					if ($member->role->id == $search) {
						$members_result[] = $member;
					}
				}
				$members = $members_result;
				return view('app.admin.members.results', compact('members'));
				break;
			default:
				break;
		}
	}

	public function filter_type(){
		$type = \Input::get('filter_type');
		$club = \Input::get('filter_club');
		$functions = new Functions();
		switch ($type) {
			case 0:
				if ($club == 0) {
					$members 			= 	Member::all();					
					return view('app.admin.members.results', compact('members'));
				}else{
					$club 				= 	Club::findOrFail($club);
					$members 			= 	$club->members;
					return view('app.admin.members.results', compact('members'));				
				}
				//return response()->json(['success' => true, $clubs]); 
				break;
			case 1:
				if($club == 0){
					$classes 			= 	ClubClass::all();					
					$filter_search 		= 	$functions->CollectionToArray($classes,'id',['name']);
					$filter_search[''] 	= 	'@Selecciona una clase';
				}else{
					$club 				= 	Club::findOrFail($club);				
					$classes 			= 	$club->classes;
					$filter_search 		= 	$functions->CollectionToArray($classes,'id',['name']);
					$filter_search[''] 	= 	'@Selecciona una clase';			
				}

				//asort($filter_search);
				return view('app.admin.members.select', compact('filter_search'));
				//return response()->json(['success' => true, $classes]); 
				break;
			case 2:
				$roles 				= 	Role::all();
				$filter_search 		= 	$functions->CollectionToArray($roles,'id',['name']);
				$filter_search[''] 	= 	'@Selecciona un rol';
				asort($filter_search);
				return view('app.admin.members.select', compact('filter_search'));
				//return response()->json(['success' => true, $roles]); 
				break;
			case -1:
				break;
			default:
				# code...
				break;
		}
	}

	public function choise_class_by_club()
	{
		$choise 		= 	\Input::get('club_choise');
		$classes 		= 	ClubClass::where('club_id','=',$choise)->get();
		$functions 		=  	new Functions();
		$select 		= 	$functions->CollectionToArray($classes,'id',['name']);
		$select[''] 	= 	'@Elige una clase';		
		return view('app.admin.members.clubclass', compact('select'));
	}

	public function prueba(){
/*		$club 		= 	Club::find(1);
		$members 	= 	$club->members;
		$members_result 	= 	[];
		foreach ($members  as $member) {
			if ($member->role->id == 9) {
				$members_result[] = $member;
			}		
		}
		dd($members_result);*/
		//$club = \Input::get('filter_club');
/*		$Event = new Event();		
		$Events = $Event->where('datetime_start', '>=', new \DateTime('today'))
							->orderBy('datetime_start','asc')
							->get();
		$result 	= 	[];
		foreach ($Events  as $e) {
			if ($e->club->id == 1) {
				$result[] = $e;
			}
		}
		$Events = $result;
		dd($Events);*/
		//return view('app.admin.activities.results', compact('Activities'));
		//$club = \Input::get('filter_club');
/*		$Event = new Event();		
		$activities = $Event->where('datetime_start', '<=', new \DateTime('today'))
							->orderBy('datetime_start','desc')
							->get();
		$result 	= 	[];
		foreach ($activities  as $a) {
			if ($a->club->id == 1) {
				$result[] = $a;
			}
		}
		$activities = $result;
		dd($activities);*/
		return view('app.home.error');
	}
}

