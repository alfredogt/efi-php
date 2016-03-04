<?php
namespace efi\vo;

use efi\db\ORM;
use efi\vo\FuncionalidadVO;
use Efi;

class ModuloVO extends ORM {  


    public static function nombreTabla()
    {
        return 'modulo';
    }

    public function getFuncionalidades($params = [])
    {
    	$params['fun_modid'] = $this->mod_id;
    	return FuncionalidadVO::busca()->where($params)->todo();
    }


}