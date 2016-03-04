<?php
namespace app\Funcionalidad\login;

use efi\vo\UsuarioVO;
use efi\general\Efi;

class Modelo{

	public function login(&$form){
		$user = UsuarioVO::busca()->where(['usu_login'=>$form->username])->uno();
		if($user !== null){
			if(Efi::$base->seguridad->validaPasswordHash($form->password, $user->usu_password)){
				Efi::$base->session->creaSession($user->usu_perid);
				return true;
			}
		}
		$form->_erroresEFI[] = ['error1'=>'Usuario y/o contraseña incorrectos'];
		return false;
	}

	public function registraUser(&$form){
		$user = new UsuarioVO();
		$user->usu_perid ='76543';
		$user->usu_login = $form->usu_login;
		$user->usu_password = Efi::$base->seguridad->generaPasswordHash($form->password);
		return $user->registra();
	}

	
}