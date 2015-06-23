<?php namespace Conquis\Http\Requests;

use Conquis\Http\Requests\Request;

class IdealRequest extends Request {

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
			'club_id'	=> 'required',
			'name'		=> 'required',			
			'value'		=> 'required'
		];
	}

}
