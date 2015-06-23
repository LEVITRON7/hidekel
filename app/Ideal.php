<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Ideal extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ideals';
	protected $fillable = ['club_id','name','value'];
	public $timestamps = false;

/*
* Relationships
*/
   	public function club()
    {
        return $this->belongsTo('Conquis\Club');
    }
}
