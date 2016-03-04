<?php
namespace efi\general\base;

use efi\general\Url;

class VistaG{

	public $titulo;
	public $plantilla;

	private function validaFile($path){
		if(file_exists($path)){			
			return true;
		}else{
			echo "No es posible encontrar la plantilla";
			exit;
		}
	}

	public function ejecuta($vista,$default,$params){
		$path_func = $GLOBALS['config']['FuncPath'];
		$path_d = $path_func.'/'.$default['funcionalidad'].'/vista/'.$vista.".php";

		if($this->validaFile($path_d)){		

			$this->plantilla = $default['plantilla'];
			$vista_render = $this->renderVista($path_d,$params);
			return $vista_render;

		}

	}

	public function renderVista($path_d,$params){
		ob_start();
			foreach ($params as $key => $value) {
					$$key = $value;
				}			
			require_once $path_d;
			$vari = ob_get_contents();
		ob_end_clean();
		if($this->plantilla !== false){
			return $this->renderLayout($vari);
		}
		return $vari;
	}	

	public function renderLayout($vista){
		$path_func = $GLOBALS['config']['FuncPath']."/../Plantillas/";
		$path = $path_func.$this->plantilla.".php";
		if($this->validaFile($path)){
			ob_start();			
				$contenido = $vista;
				require_once $path;
				$layout = ob_get_contents();
			ob_end_clean();
		}
		return $layout;
	}

	public function registraCSS($url,$type = ''){
		$link = Url::creaUrl("/web/".$url);
		return "<link href='".$link."' rel='stylesheet' type='$type'>";
	}

	public function registraJS($url,$type = ''){
		$link = Url::creaUrl("/web/".$url);
		return "<script src='".$link."'></script>";
	}

}