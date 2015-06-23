<?php namespace Conquis;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['email', 'password','type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function setPasswordAttribute($value){
		if(!empty($value)){
			$this->attributes['password'] = bcrypt($value);
		}	
	}

/*
* Relationships
*/
    public function member()
    {
        return $this->hasOne('Conquis\Member');
    }
	public function materials(){
		return $this->hasMany('Conquis\Material');	
	}
	public function events(){
		return $this->hasMany('Conquis\Event');	
	}
}