<?php namespace Conquis\Http\Requests;

use Conquis\Http\Requests\Request;

class CreateUserRequest extends Request {

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
			'member_id'	=>'required',
   			'email' 	=> 'required|email|unique:users,email',
        	'password' 	=> 'required|confirmed|min:6',
        	'type'		=> 'required'
		];
	}
	public function messages()
	{
		return [
			'member_id.required'	=>'Elija un miembro del club!',
   			'email.required' 	 => 'El campo Email es requerido!',
        	'password.required'  => 'El campo Contraseña es requerido!',
        	'password.confirmed' => 'Contraseña de confirmacion no es igual!',
        	'type.required'		 => 'Elija un tipo de usuario'
		];
	}
}
