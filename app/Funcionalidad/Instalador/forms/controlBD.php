<?php
namespace app\Funcionalidad\Instalador\forms;

use efi\helpers\FormularioEFI;

class controlBD extends FormularioEFI{

	public $host;
	public $user;
	public $password;
	public $bd;
        

	public function reglas(){
		return [
			[['host','user','password','bd'],'obligatorio'],
		];
	}

}