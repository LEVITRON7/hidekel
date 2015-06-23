<?php namespace Conquis;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';

	protected $fillable = 	[
							'first_name', 
							'last_name',
							'burn',
							'photo',
							'sex',
							'confirmed',
							'role_id',
							'class_id',
							'club_id',
							'user_id'
							];

	public function getFullNameAttribute()
	{
		return 	$this->first_name.' '. $this->last_name;
	}

	public function ArrayIdNameWithoutUsed(){		
		$members = $this->whereNull('user_id')->orderBy('first_name','asc')->get();
		$array=[];
		//dd($members);
		foreach ($members as $member) {
			$array[$member->id] = $member->full_name;
		}
		return $array;
	}

	public function ChangeUserIdOfMember($user_id,$new_member_id,$old_member_id){
		if($new_member_id != $old_member_id){
			$new = Member::find($new_member_id);		
			$new->user_id =  $user_id;
			$old= Member::find($old_member_id);		
			$old->user_id =  null;
			if($old->save() and $new->save()){
				return true;	
			}
				return false;
		}
		return false;
	}	
	public function AddUser($user_id, $member_id){
		$member= Member::find($member_id);
		$member->user_id = $user_id;
		if($member->save()){
			return true;
		}
			return false;
	}

/*
* Relationships
*/    
    public function user()
    {
        return $this->belongsTo('Conquis\User');
    }
    public function role()
    {
        return $this->belongsTo('Conquis\Role');
    }
   	public function clubclass()
    {
        return $this->belongsTo('Conquis\ClubClass','class_id');
    }
   	public function club()
    {
        return $this->belongsTo('Conquis\Club');
    }
}