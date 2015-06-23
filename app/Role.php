<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';
	protected $fillable = ['name'];
	public $timestamps = false;
/*
* Relationships
*/

	public function members()
    {
        return $this->hasMany('Conquis\Member');
    }
}