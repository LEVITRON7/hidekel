<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class MaterialsType extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'materials_types';
	protected $fillable = [	'name'];
	public $timestamps = false;
/*
* Relationships
*/
	public function materials(){
		return $this->hasMany('Conquis\Material','type_id');	
	}
}