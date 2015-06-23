<?php namespace Conquis\Http\Requests;

use Conquis\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	private $route;

	public function __construct(Route $route){
		return $this->route = $route;
	}

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
			'member_id'	=>'',
   			'email' 	=> 'required|email|unique:users,email,'.$this->route->getParameter('id'),
        	'password' 	=> 'confirmed|min:6',
        	'type'		=> 'required'        	
		];
	}
	public function messages()
	{
		return [
			'member_id.required' =>'Elija un miembro del club!',
   			'email.required' 	 => 'El campo Email es requerido!',
        	'password.confirmed' => 'Contraseña de confirmacion no coincide!',
        	'type.required'		 => 'Elija un tipo de usuario'
		];
	}
}
