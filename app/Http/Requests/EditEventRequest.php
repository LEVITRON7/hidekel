<?php namespace Conquis\Http\Requests;

use Conquis\Http\Requests\Request;

class EditEventRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'				=>'required',
   			'description' 		=> 'required ',
        	'address' 			=> 'required ',
        	'datetime_start'	=> 'required',
        	'datetime_end'		=> 'required',
        	'location_latitude'	=> 'required',
        	'location_longitude'=> 'required',
        	'poster'			=> 'image|mimes:jpeg,bmp,png',
        	'club_id'			=> 'required'
		];
	}

}
