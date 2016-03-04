<?php
namespace efi\general;

use efi\general\Efi;

class restriccion{

	public static function isPost($params=null){
		if(Efi::$base->request->isPost()) return true;
		return 'Peticion no valida';
	}
}

?>