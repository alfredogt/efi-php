<?php
namespace efi\vo;

use efi\db\ORM;
use Efi;

class PersonaVO extends ORM {  


    public static function nombreTabla()
    {
        return 'persona';
    }


}