<?php
namespace app\Funcionalidad\Instalador;

use app\Funcionalidad\ListadoPersonas\Modelo;
use efi\general\base\ControladorG;
use efi\vo\PersonaVO;
use efi\general\Efi;
use app\Funcionalidad\Instalador\forms\ControlBD;
use efi\db\MySqlProvider;

class Controlador extends ControladorG{

	public $pagina;
	public $funcionalidad;
	public $plantilla = 'login';

	public function paginaIndex(){
		$form = new ControlBD();
		if($form->carga()){
			if($form->valida()){
				$bd = new MySqlProvider();
				$coneccion = @$bd->connect($form->host,$form->user,$form->password,$form->bd);				
				if($coneccion !== null){
					return  'Datos Validos';
					$bd->disconnect();
				}else{
					echo 'Datos no validos';
					return 'Datos no validos';
				}
			}
		}
		return $this->vista('index',['form' => $form]);
	}

	public function paginaValida(){

	}
	
}