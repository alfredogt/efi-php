<?php
namespace efi\vo;

use efi\db\ORM;
use efi\vo\ModuloVO;
use Efi;

class FuncionalidadVO extends ORM {  


    public static function nombreTabla()
    {
        return 'funcionalidad';
    }

    public function getModulo(){
    	return ModuloVO::busca()->where(['mod_id'=>$this->fun_modid])->uno();
    }


}