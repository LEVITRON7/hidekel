<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Material extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'materials';

    protected $fillable =   [ 
                            'name', 
                            'description',
                            'file',
                            'logo',
                            'extension',
                            'topic_id',
                            'club_id',
                            'type_id',
                            'user_id'
                            ];

    public function getAllMaterials(){
        return $this->paginate(7);
    }
/*
* Relationships
*/
   	public function club()
    {
        return $this->belongsTo('Conquis\Club');
    }
   	public function user()
    {
        return $this->belongsTo('Conquis\User');
    }
   	public function topic()
    {
        return $this->belongsTo('Conquis\MaterialsTopic');
    }
   	public function type()
    {
        return $this->belongsTo('Conquis\MaterialsType');
    }

}