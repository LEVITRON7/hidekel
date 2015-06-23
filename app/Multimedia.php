<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'multimedia';

	protected $fillable = 	[
							'title', 
							'description',
							'file',
							'event_id',
							'type'
							];

/*
* Relationships
*/
	public function AddFilesToMultimedia($event_id,$files,$type){
		if (!empty($files) && !empty($event_id)){
			foreach ($files as $file) {
				$Multimedia = new Multimedia;
				$Multimedia->file = $file;
				$Multimedia->type = $type;
				$Multimedia->event_id = $event_id;
				$Multimedia->save();
			}
		return true;
		}else{
			return false;
		}
	}

	public function getNamesArray(){
		return $this->file;
	}
   	public function event()
    {
        return $this->belongsTo('Conquis\Event');
    }
}