<?php
namespace efi\general\base;

use efi\general\base\VistaG;
use efi\general\Url;
use efi\general\restriccion;

class ControladorG{

	public $plantilla = false;

	function __construct($pagina,$funcionalidad){
		$this->pagina = $pagina;
		$this->funcionalidad = $funcionalidad;
	}	

	private function valRestricciones(){
		if(function_exists('restricciones')){
			$restriccion = $this->restricciones();
			$pag = $this->pagina;
			if(isset($restriccion[$pag])){
				$rest = $restriccion[$pag];
				if($respuesta = restriccion::$rest()){
					if($respuesta!==true){ echo($respuesta); exit; }
				} 
			}
		}
		return true;
	}

	public function ejecuta(){
		if($this->valRestricciones()){
			$metodo = "pagina".ucwords($this->pagina);
			return $this->$metodo();
		}
	}

	public function vista($vista, $params = []){
		$vst = new VistaG();
		return $vst->ejecuta($vista,['pagina'=>$this->pagina,'funcionalidad'=>$this->funcionalidad,'plantilla'=>$this->plantilla],$params);
	}

	public function refresca(){

	}

	public function redirige($url){
		$url = Url::creaUrl($url);
		header('Location: '.$url);
		exit;
	}

}