<?php
namespace app\Formularios;

use efi\helpers\FormularioEFI;

class LoginForm extends FormularioEFI{

	public $username;
	public $password;
	public $recuerda;
        

	public function reglas(){
		return [
			[['username','password'],'obligatorio'],
		];
	}



}