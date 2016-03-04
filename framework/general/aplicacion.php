<?php
namespace efi\general;

use efi\general\Efi;

class aplicacion{
/*
* Clase principal, encargada de gestionar el frameWork
*/

	public $config;

	/**
	* establece la configuracion de Efi y define la variable principal de EFI.
	*/
	public function __construct($config){
		$this->config=$config;
		$base = new Efi();
		Efi::$base = $base;
	}

	/**
	* Metodo principal, ejecuta el metodo de la clase fontaol e imprime el contenido generado
	*/
	public function ejecuta(){	
		try {
			$frontal = new Frontal();
		    $contenido = $frontal->Recibe();		    
		} catch (\Exception $e) {
			if (ob_get_contents()) ob_end_clean();			
		    echo 'Error en la ejecucion: '.  $e->getMessage(). "\n";
		    exit();
		}
		if(count(error_get_last())==0){
			$this->imprime($contenido);
		}
	}

	/**
	* Imprime el contenido generado.
	*/
	public function imprime($contenido){
		echo $contenido;
	}
}