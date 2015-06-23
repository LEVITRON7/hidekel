<?php namespace Conquis\Http\Controllers\Admin;

use Conquis\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class Functions {
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $date string
	 * @return Response $date object php for save on DB
	 */
	public function DateStringToObject($datestring){
		$date = new \Date();		
		if ($datestring != null) {
			$date = $date->createFromFormat('D M j Y H:i:s e+', $datestring);
		}else{
			return $datestring;
		}
		return $date;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $file object
	 * @return Response $filename string for save on DB
	 */	
	public function SaveFileToDisk($file,$folder){
		$uuid =  \Uuid::generate(1);		
		$path_files = public_path().$folder;
			/*Se obtiene el archivo*/
			/*Se crea un nombre unico para el archivo */			
			$filename 	=	$uuid->generate().'.'.$file->getClientOriginalExtension();
		    
		    $type_file 	= 	$file->getMimeType();

		    $file->move($path_files,$filename);
			
		    /*Se verifica si el archvo es una imagen*/
			if(substr($type_file, 0, 5) == 'image') {
				// to finally create image instances
				$img = Image::make($path_files.$filename);
				$this->ResizeImage($img);
			}
		    return $filename;
	}
	public function ResizeImage($img){
		if ($img->width()>1024) {
			// resize image to new width but do not exceed original size
		    $img->widen(1024, function ($constraint) {
		    	/*Se evita que el tamaño de la imagen escalada supere al original*/
			    $constraint->upsize();
			});
			$img->save();
			$img->destroy();
		}
	}
	/**
	 * Remove the specified resource from storage.
	 * 	
	 * @param  $new object file and $old String name old file
	 * @return Response $filename string for save on DB
	 */	
	public function UpdateFileToDisk($new, $old, $folder){
		$uuid =  \Uuid::generate(1);
		$path_files = public_path().$folder;
			/*Se obtiene el archivo*/
			/*Se crea un nombre unico para el archivo */
			$filename =	$uuid->generate().'.'.$new->getClientOriginalExtension();
			
			$type_file = $new->getMimeType();

			if($new->move($path_files,$filename)){
				/*Se elimina el antiguo archivo*/
				if (\File::exists($path_files.$old)){
				    \File::delete($path_files.$old);
				}
		    /*Se verifica si el archvo es una imagen*/
			if(substr($type_file, 0, 5) == 'image') {
				// to finally create image instances
				$img = Image::make($path_files.$filename);
				$this->ResizeImage($img);
			}			
				return $filename;
			}else{
				return false;
			}
	}

	public function DeleteFileFromDisk($file,$folder){
		if(!empty($file) && \File::delete(public_path().$folder.$file)){
			return true;
		}else{
			return false;
		}
	}

	public function DeleteFilesFromDisk($files,$folder){
		if(!empty($files)){
			foreach ($files as $file) {
				\File::delete(public_path().$folder.$file);
			}
			return true;
		}else{
			return false;
		}
	}

	public function DateTodatetimepicker($date){
		$date = new \Date($date);
		return $date->format('D, j \d\e M \d\e Y, h:ia');
	}

	public function ImageParserToFormatPreview($files,$path_delete,$path){
		$p1 = $p2 = [];
		if (!empty($files)) {
			foreach ($files as $file){
			if ($file != '') {
					$key = '';
				    $url = $path_delete.$file;
				    $p1[] = "<img src='".$path.$file."' class='file-preview-image'>";
				    $p2[] = ['caption' => "Imagen: ".$file, 'width' => '120px', 'url' => $url, 'key' => $key];
				}
			}
			return ['initialPreview' => $p1, 'initialPreviewConfig' => $p2, 'append' => true];
		}		
	}

	public function FileParserToFormatPreview($file,$path_delete,$path){
		$p1 = $p2 = [];
		if (!empty($file)) {
			if ($file->file != '') {
				$key = '';
				$url = $path_delete.$file->file;
				switch ($file->extension) {
					case 'youtube.com':
						$p1[] = '<iframe width="200px" src="'. str_replace("watch?v=", "embed/", $file->file.'?rel=0&fs=1') .'"frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				    	$p2[] = ['caption' => $file->name.'.'.$file->extension, 'width' => '120px', 'url' => $url, 'key' => $key];
						break;
					case 'mp3':
						$p1[] = '<audio controls><source src="'.$path.$file->file.'" type="audio/mpeg">'.$file->name.'</audio>';
				    	$p2[] = ['caption' => $file->name.'.'.$file->extension, 'width' => '120px', 'url' => $url, 'key' => $key];
						break;
					case 'pdf':
						$p1[] = '<embed src="'.$path.$file->file.'"/>';
				    	$p2[] = ['caption' => $file->name.'.'.$file->extension, 'width' => '120px', 'url' => $url, 'key' => $key];
						break;
					default:
						$p1[] = "<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>".$file->name."</div>";
				    	$p2[] = ['caption' => $file->name.'.'.$file->extension, 'width' => '120px', 'url' => $url, 'key' => $key];
						break;
				}		    
					return ['initialPreview' => $p1, 'initialPreviewConfig' => $p2,'append' => true];
			}
		}
	}
	/**
	 * Get Array from object collection
	 *
	 * @param  $Object Collection from DB, $id of collection, $columns array of collection, $separator string
	 * @return Response $array with [$id,$column]
	 */	
	public function CollectionToArray($object,$id,$columns,$separator = '')
	{	$array = [];
		if (!empty($object)) {		
		$count = count($columns);		
		foreach ($object as $item) {			
			$a='';
			$i = 0;	
			foreach ($columns as $column) {
			$i++;
				if ($i != $count) {
					$a .= $item[$column].$separator.' ';
				}else{
					$a .= $item[$column];
				}
			}
			$array[$item[$id]] = $a;
		}
		return $array;
		}
	}

	/**
	 * 
	 *
	 * @param  
	 * @return 
	 */	
	public function getFilePreview($file)
	{	//url('/files/materials/'.$file->file)
		switch ($file->extension) {
			case 'pdf'	:
			case 'doc'	:
			case 'docx'	:				
			case 'ppt'	:
			case 'pptx'	:
				$path = '/files/materials/'.$file->file;
				return '<iframe src="https://docs.google.com/viewerng/viewer?url='.asset($path).'&embedded=true" style="width:80%; height:400px;" frameborder="0"></iframe>';
				break;
			case 'youtube.com':
				return '<iframe width="480px" height="320" src="'. str_replace("watch?v=", "embed/", $file->file.'?rel=0&fs=1') .'"frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				break;
			case 'mp3':
				$path = '/files/materials/'.$file->file;
				return '<br><br><div class=""><audio controls preload="none"> <source src="'.asset($path).'" type="audio/mpeg"/></audio></div>';
				break;
			default:
				# code...
				break;
		}
	}

}