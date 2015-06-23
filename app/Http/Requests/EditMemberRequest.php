<?php namespace Conquis\Http\Requests;

use Conquis\Http\Requests\Request;

class EditMemberRequest extends Request {

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
			'club_id'		=> 'required',
			'first_name'	=> 'required',
			'last_name'		=> 'required',
			'burn'			=> 'required',
			'sex'			=> 'required',
			'role_id'		=> 'required',
			'class_id'		=> 'required'
		];
	}

}
