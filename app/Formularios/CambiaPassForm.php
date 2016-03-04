<?php
namespace app\Formularios;

use efi\helpers\FormularioEFI;

class CambiaPassForm extends FormularioEFI{

	public $password_old;
	public $password_new;
	public $confirm_password;
        

	public function reglas(){
		return [
			[['password_old','password_new','confirm_password'],'obligatorio'],
			[['password_new','confirm_password'],'identico'],			
		];
	}



}