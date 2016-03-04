<?php
namespace efi\vo;

use efi\db\ORM;
use Efi;

class LogVO extends ORM {  


    public static function nombreTabla()
    {
        return 'log';
    }


}