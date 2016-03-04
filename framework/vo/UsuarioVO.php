<?php
namespace efi\vo;

use efi\db\ORM;
use Efi;

class UsuarioVO extends ORM {  


    public static function nombreTabla()
    {
        return 'usuario';
    }

    public function reglas(){
    	return [];
    }


}