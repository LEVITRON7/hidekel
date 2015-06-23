<?php namespace Conquis\Http\Requests;

use Conquis\Http\Requests\Request;

class EditClubRequest extends Request {

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
			'name'			=>	'required',
			'description'	=>	'required',
			'type'			=>	'required',
			'logo'			=>	''
		];
	}

}
