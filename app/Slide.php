<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table 	= 'slides';
	protected $fillable =  ['event_id','title','description','file'];
	public $timestamps = false;
	
/*
* Relationships
*/	
    public function event()
    {
        return $this->belongsTo('Conquis\Event');
    }
}