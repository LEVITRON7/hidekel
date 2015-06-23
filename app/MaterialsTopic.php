<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class MaterialsTopic extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'materials_topics';
	protected $fillable = [	'name'];
	public $timestamps = false;
/*
* Relationships
*/
	public function materials(){
		return $this->hasMany('Conquis\Material','topic_id');
	}
}