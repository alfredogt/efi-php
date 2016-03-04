<?php
namespace app\Funcionalidad\GestionUsuarios;

use app\Funcionalidad\ListadoPersonas\Modelo;
use efi\general\base\ControladorG;
use efi\vo\UsuarioVO;
use app\Formularios\CambiaPassForm;
use efi\general\Efi;
use efi\helpers\FormularioEFI;

class Controlador extends ControladorG{

	public $pagina;
	public $funcionalidad;		

	public function paginaCambiaclave(){
		$cambiapass = new CambiaPassForm();
		return $this->vista('cambiapass',['form'=>$cambiapass]);
	}

	
}