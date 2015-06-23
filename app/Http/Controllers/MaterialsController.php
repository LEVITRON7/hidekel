<?php namespace Conquis\Http\Controllers;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Conquis\Http\Controllers\Admin\Functions;
use Illuminate\Http\Request;
use Conquis\Material;
use Conquis\MaterialsTopic;
use Conquis\MaterialsType;
use Conquis\Club;

class MaterialsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Materials = Material::paginate(6);
        $functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		$clubsselect_filter[0] = 'Todos';
		asort($clubsselect_filter);
        if (\Request::ajax()) {
            return view('app.materials.pagination', compact('Materials','clubsselect_filter'))->render();
        }
        return view('app.materials.index', compact('Materials','clubsselect_filter'));
		//return view('app.materials.index', compact('Materials'));
	}
	public function show($id)
	{
		$material = Material::findOrFail($id);
		$functions = new Functions();

		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		$clubsselect_filter[0] = 'Todos';
		asort($clubsselect_filter);

		$preview_material = $functions->getFilePreview($material);
		//dd($preview_material);
		return view('app.materials.show', compact('material','preview_material','clubsselect_filter'));
	}
	public function filter_search(){
		$club = \Input::get('filter_club');
		$type = \Input::get('filter_type');
		$search = \Input::get('filter_search');
		switch ($type) {
			case 0: 
/*				$club 		= 	Club::find($search);
				$Materials 	= 	$club->materials;				
				return view('app.materials.results', compact('Materials'));
				break;*/
				break;
			case 1:
				if ($club == 0) {
					$MaterialsTopic	= 	MaterialsTopic::findOrFail($search);
					$Materials = $MaterialsTopic->materials;
					//return response()->json(['success' => true, $materials]);
					return view('app.materials.results', compact('Materials'));
				}else{
					$club	= 	Club::findOrFail($club);
					$Materials = $club->materials;
					$materials_result = [];
					foreach ($Materials  as $material) {
						if ($material->topic->id == $search) {
							$materials_result[] = $material;
						}
					}
					$Materials = $materials_result;
					return view('app.materials.results', compact('Materials'));
				}
				$class 		= 	Material::find($search);
				$Materials 	= 	$class->materials;
				return view('app.materials.results', compact('Materials'));
				break;
			case 2:
				if($club == 0 ){
					$MaterialsType	= 	MaterialsType::findOrFail($search);
					$Materials = $MaterialsType->materials;
					//return response()->json(['success' => true, $materials]);
					return view('app.materials.results', compact('Materials'));
				}else{
					$club	= 	Club::findOrFail($club);
					$Materials = $club->materials;
					$materials_result = [];
					foreach ($Materials  as $material) {
						if ($material->type->id == $search) {
							$materials_result[] = $material;
						}
					}
					$Materials = $materials_result;
					return view('app.materials.results', compact('Materials'));
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
					$Materials 			= 	Material::all();
					return view('app.materials.results', compact('Materials'));				
				}else{
					$club 				= 	Club::findOrFail($club);
					$Materials 			= 	$club->materials;
					return view('app.materials.results', compact('Materials'));				
				}
				break;
			case 1:
				$MaterialsTopics	= 	MaterialsTopic::all();
				$filter_search 		= 	$functions->CollectionToArray($MaterialsTopics,'id',['name']);
				$filter_search[''] 	= 	'@Selecciona un Tópico';
				//asort($filter_search);
				return view('app.materials.select', compact('filter_search'));
				//return response()->json(['success' => true, $classes]);
				break;
			case 2:
				$MaterialsTypes		= 	MaterialsType::all();
				$filter_search 		= 	$functions->CollectionToArray($MaterialsTypes,'id',['name']);
				$filter_search[''] 	= 	'@Selecciona un Tipo';
				return view('app.materials.select', compact('filter_search')); 
				break;
			case -1:
				break;
			default:
				# code...
				break;
		}
	}

	public function all_of_type($id){
		//$id = \Input::get('id');
		$materials = MaterialsType::findOrFail($id);
		$Materials = $materials->materials;
		//dd($materials);

        $functions = new Functions();
		$clubs = Club::all();
		$clubsselect = $functions->CollectionToArray($clubs,'id',['type','name']);
		$clubsselect[''] = '@Selecciona un club';
		$clubsselect_filter  = $clubsselect;
		$clubsselect_filter[-2] = 'Ninguno';
		$clubsselect_filter[0] = 'Todos';
		asort($clubsselect_filter);

        return view('app.materials.results_type', compact('Materials','clubsselect_filter'));
		//return view('app.materials.index', compact('Materials'));

	}
}
