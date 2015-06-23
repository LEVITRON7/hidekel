<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class ClubClass extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'club_classes';
	protected $fillable = ['name','club_id','logo'];
	public $timestamps = false;

/*
* Relationships
*/
	public function getAllWithMajor(){
		
	}
   	public function club()
    {
        return $this->belongsTo('Conquis\Club');
    }
	public function members(){
		return $this->hasMany('Conquis\Member','class_id');	
	}
}