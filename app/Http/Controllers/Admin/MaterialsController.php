<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Conquis\Http\Requests\CreateMaterialRequest;
use Conquis\Http\Requests\EditMaterialRequest;
use Illuminate\Http\Request;
use Conquis\Material;
use Conquis\Club;
use Conquis\MaterialsType;
use Conquis\MaterialsTopic;
use Illuminate\Support\Facades\Session;

class MaterialsController extends Controller{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$materials = Material::paginate(7);
		//dd($Materials);
        //$posts = Post::paginate(5);
        $functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		$clubsselect_filter[0] = 'Todos';
		asort($clubsselect_filter);
        if (\Request::ajax()) {
            return view('app.admin.materials.pagination', compact('materials','clubsselect_filter'))->render();
        }
        return view('app.admin.materials.index', compact('materials','clubsselect_filter'));
		//return view('app.admin.materials.index', compact('Materials'));	
	}		

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$functions = new Functions();
		$topics = MaterialsTopic::all();
		$topicsselect = $functions->CollectionToArray($topics,'id',['name']);
		$topicsselect[''] = '@Selecciona un tópico';
		asort($topicsselect); 
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		asort($clubsselect);
		$types = MaterialsType::all();
		$typesselect = $functions->CollectionToArray($types,'id',['name']);
		$typesselect[''] = '@Selecciona un tipo';
		asort($typesselect); 
		$user_id = \Auth::user()->id;
		$Materials = Material::all();

		return view('app.admin.materials.create', compact('materials','clubsselect','topicsselect','typesselect','user_id'));	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateMaterialRequest $request)
	{

		$functions = new Functions();
		$array = $request->all();
		//dd($array);

		if ($request->hasFile('file'))
		{	$file = $request->file('file');
			$filename = $functions->SaveFileToDisk($file,'/files/materials/');
			$array['file'] = $filename;
			$array['extension'] = $file->getClientOriginalExtension();
		}
		if ($request->hasFile('logo'))
		{	$file = $request->file('logo');
			$filename = $functions->SaveFileToDisk($file,$material->logo,'/images/logos/');
			$array['logo'] = $filename;
		}
		if($array['video'] != ''){
			$array['file'] = $array['video'];
			$array['extension'] = 'youtube.com';
		}
		$material = Material::create($array);
		//dd($array);
		//dd($event);
		$material->save();
		Session::flash('messages', 'El material: '.$material->name.', ha sido creado');
		return redirect('/admin/materials/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$material = Material::findOrFail($id);
		$functions = new Functions();

		$preview_material = $functions->getFilePreview($material);
		//dd($preview_material);
		return view('app.admin.materials.show', compact('material','preview_material'));
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
		$topics = MaterialsTopic::all();
		$topicsselect = $functions->CollectionToArray($topics,'id',['name']);
		$topicsselect[''] = '@Selecciona un tópico';
		asort($topicsselect); 
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		asort($clubsselect);
		$types = MaterialsType::all();
		$typesselect = $functions->CollectionToArray($types,'id',['name']);
		$typesselect[''] = '@Selecciona un tipo';
		asort($typesselect); 

		$user_id = \Auth::user()->id;
		$material = Material::findOrFail($id);
		//dd($material);
		$preview  = $functions->FileParserToFormatPreview($material,'/admin/materials/deletefile/','/files/materials/');
		$preview2 = $functions->ImageParserToFormatPreview([$material->logo],'/admin/materials/deletelogo/','/images/logos/');
		$filejson = json_encode($preview);
		$filejson2 = json_encode($preview2);
		return view('app.admin.materials.edit', compact('material','clubsselect','topicsselect','typesselect','user_id','filejson','filejson2'));	
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditMaterialRequest $request, $id)
	{
		$functions = new Functions();
		$array = $request->all();
		$material = Material::findOrFail($id);
		//dd($array);

		if ($request->hasFile('file'))
		{	$file = $request->file('file');
			$filename = $functions->UpdateFileToDisk($file,$material->file,'/files/materials/');
			$array['file'] = $filename;
			$array['extension'] = $file->getClientOriginalExtension();
		}
		if ($request->hasFile('logo'))
		{	$file = $request->file('logo');
			$filename = $functions->UpdateFileToDisk($file,$material->logo,'/images/logos/');
			$array['logo'] = $filename;
		}
		if($array['video'] != ''){
			$array['file'] = $array['video'];
			$array['extension'] = 'youtube.com';
		}
		//dd($array);
		$material->fill($array);
		$material->save();
		Session::flash('messages', 'El material: '.$material->name.', ha sido actualizado');
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
		$functions = new Functions();
		$material 	= Material::findOrFail($id);		
		if ($material->delete()){
			$functions->DeleteFileFromDisk($material->file,'/files/materials/');
		}
		return response()->json(['success' => 200, 'data' => $material]);
/*		Session::flash('messages', 'El material: '.$material->name.' ha sido eliminado');
		return redirect('/admin/materials/');*/
	}

	public function deletefile($id){

		$material 	= Material::where('file','=',$id)->update(array('file' => ''));
		$functions 	= new Functions();		
		if ($functions->DeleteFileFromDisk($id,'/files/materials/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}
	public function getfile($id){

	 return \Response::make(file_get_contents(public_path().'/files/materials/'.$id), 200, [
	    'Content-Type' => 'application/pdf',
	    'Content-Disposition' => 'inline; '.$id,
	]);
		
		//return response(public_path().'/files/materials/'.$id, $id);
		//return response()->download(public_path().'/files/materials/'.$id);
	}



	public function filter_search(){
		$club = \Input::get('filter_club');
		$type = \Input::get('filter_type');
		$search = \Input::get('filter_search');
		switch ($type) {
			case 0: 
/*				$club 		= 	Club::find($search);
				$materials 	= 	$club->materials;				
				return view('app.admin.materials.results', compact('materials'));
				break;*/
				break;
			case 1:
				if ($club == 0) {
					$MaterialsTopic	= 	MaterialsTopic::findOrFail($search);
					$materials = $MaterialsTopic->materials;
					//return response()->json(['success' => true, $materials]);
					return view('app.admin.materials.results', compact('materials'));
				}else{
					$club	= 	Club::findOrFail($club);
					$materials = $club->materials;
					$materials_result = [];
					foreach ($materials  as $material) {
						if ($material->topic->id == $search) {
							$materials_result[] = $material;
						}
					}
					$materials = $materials_result;
					return view('app.admin.materials.results', compact('materials'));
				}
				$class 		= 	Material::find($search);
				$materials 	= 	$class->materials;
				return view('app.admin.materials.results', compact('materials'));
				break;
			case 2:
				if($club == 0 ){
					$MaterialsType	= 	MaterialsType::findOrFail($search);
					$materials = $MaterialsType->materials;
					//return response()->json(['success' => true, $materials]);
					return view('app.admin.materials.results', compact('materials'));
				}else{
					$club	= 	Club::findOrFail($club);
					$materials = $club->materials;
					$materials_result = [];
					foreach ($materials  as $material) {
						if ($material->type->id == $search) {
							$materials_result[] = $material;
						}
					}
					$materials = $materials_result;
					return view('app.admin.materials.results', compact('materials'));
				}
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
				if ($club == 0 ) {
					$materials 			= 	Material::all();
					return view('app.admin.materials.results', compact('materials'));				
				}else{
					$club 				= 	Club::findOrFail($club);
					$materials 			= 	$club->materials;
					return view('app.admin.materials.results', compact('materials'));				
				}
				break;
			case 1:
				$MaterialsTopics	= 	MaterialsTopic::all();
				$filter_search 		= 	$functions->CollectionToArray($MaterialsTopics,'id',['name']);
				$filter_search[''] 	= 	'@Selecciona un Tópico';
				//asort($filter_search);
				return view('app.admin.materials.select', compact('filter_search'));
				//return response()->json(['success' => true, $classes]);
				break;
			case 2:
				$MaterialsTypes		= 	MaterialsType::all();
				$filter_search 		= 	$functions->CollectionToArray($MaterialsTypes,'id',['name']);
				$filter_search[''] 	= 	'@Selecciona un Tipo';
				return view('app.admin.materials.select', compact('filter_search')); 
				break;
			case -1:
				break;
			default:
				# code...
				break;
		}
	}

	public function deletelogo($id)
	{	
		$club 	= Material::where('logo','=',$id)->update(array('logo' => ''));
		$functions 	= new Functions();		
		if ($functions->DeleteFileFromDisk($id,'/images/logos/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}
}
