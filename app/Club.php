<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Club extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clubs';
	protected $fillable =['name','type','description','logo'];

	public function getFullAttribute()
	{
		return   $this->type.' '.$this->name ;
	}	
 
/*
* Relationships
*/
	public function members(){
		return $this->hasMany('Conquis\Member');
	}
	public function classes(){
		return $this->hasMany('Conquis\ClubClass');
	}
	public function ideals(){
		return $this->hasMany('Conquis\Ideal');
	}
	public function events(){
		return $this->hasMany('Conquis\Event');	
	}
	public function materials(){
		return $this->hasMany('Conquis\Material');
	}
}