<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Requests;
use Conquis\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Conquis\Multimedia;
use Conquis\Material;

class FilesController extends Controller {

	public function uploadfiles(Request $request){
		$Multimedia = new Multimedia();
		$functions = new Functions();
		$array = $request->all();
		$names = [];
		if ($request->hasFile('files'))
		{
			$files = $request->file('files');
			foreach ($files as $file) {
				$filename = $functions->SaveFileToDisk($file,'/images/multimedia/');
				$names[] = $filename;
			}
			$array['files'] = $names;
			/*Se mandan a guardar las imagenes en la BD*/
			//dd($names);

			$Multimedia->AddFilesToMultimedia($array['eventid'],$names,1);
		}
		$path_delete = '/admin/deleteimage/';
		$preview = $functions->ImageParserToFormatPreview($names,$path_delete,'/files/multimedia/');

    	//return response()->json(['initialPreview' => $request, 'initialPreviewConfig' => $array, 'append' => true ]);
		 return response()->json(['success' => true, $preview]);
	}

	public function deleteimage($id){
		$multimedia 	= 	Multimedia::where('file','=',$id)->delete();
		$functions 		= 	new Functions();
		if ($functions->DeleteFileFromDisk($id,'/images/multimedia/')) {
			return response()->json(['success' => true]);
		}else{
			return response()->json(['success' => false]);
		}
	}

	public function uploadvideos(Request $request){
		$multimedia = new Multimedia();
		$file = \Input::get('file');
		$event_id = \Input::get('event_id');
		$title = \Input::get('title');
		$array = ['title' => $title , 'description'=> null ,'file' => $file ,'event_id' => $event_id,'type' => 2];

		$multimedia->fill($array);
		if($multimedia->save()){
			return response()->json(['success' => true, 'video' => $multimedia]);
		}else{
			return response()->json(['Error' => 400, 'video' => '' ]);
		}
	}

	public function deletevideo($id){
		$Multimedia = Multimedia::findOrFail($id);
		/*Manda a eliminar el archivo multimedia de la BD*/
		if ($Multimedia->delete()){
			return response()->json(['success' => 200, 'video' => $Multimedia]);
		}else{
			return response()->json(['error' => 400, 'video' => $Multimedia]);
		}	
	}
	
}
