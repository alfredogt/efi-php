<?php
namespace app\Formularios;

use efi\helpers\FormularioEFI;

class RegistraForm extends FormularioEFI{

	public $usu_login;
	public $password;
	public $confirm_password;
	public $estado;
        

	public function reglas(){
		return [
			[['usu_login'],'string'],
			[['usu_login','password','confirm_password'],'obligatorio'],
			[['password','confirm_password'],'identico'],			
			[['usu_login'],'unico','class'=>'efi/vo/UsuarioVO'],
		];
	}



}