<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';
	protected $fillable = [	'title', 
							'description',
							'datetime_start',
							'datetime_end',
							'address',
							'location_latitude',
							'location_longitude',
							'poster',
							'club_id',
							'user_id'
						];

	 public function  getDateBetweenAttribute(){		
		$Inicio = new \Date($this->datetime_start);
		$Fin = new \Date($this->datetime_end);
		return $Inicio->format('D j M \d\e\l Y\, h:ia').' al '.$Fin->format('D j M \d\e\l Y\, h:ia');
	}
	public function getRecentsAttribute(){

		return 	$this->where('datetime_start', '>=', new \DateTime('now'))
						->orWhere('datetime_end', '>=', new \DateTime('now'))
						->orderBy('datetime_start','asc')
						->paginate(3);
	}
	public function getLastTodayAttribute(){
		
		return $this->where('datetime_start', '<=', new \DateTime('now'))
							->where('datetime_end', '<=', new \DateTime('now'))
							->orderBy('datetime_end','desc')
							->paginate(3);
	}
	public function DateTimeTodatetimepicker(){
		$date = new \Date($this->datetime_start);
		$date1 = new \Date($this->datetime_end);
		$this->datetime_start = $date->format('D, j \d\e M \d\e Y, h:ia');
		$this->datetime_end = $date1->format('D, j \d\e M \d\e Y, h:ia');
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
	public function multimedias(){
		return $this->hasMany('Conquis\Multimedia');	
	}
	public function slide(){
		return $this->hasOne('Conquis\Slide');	
	}
}