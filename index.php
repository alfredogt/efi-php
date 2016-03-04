<?php
include './framework/general/autoload.php';
$config = require './config/efi.php';

$app = new efi\general\aplicacion($config);

$app->ejecuta();


?>
