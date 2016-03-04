<?php
namespace efi\general;

use efi\vo\FuncionalidadVO;
use efi\general\api;

class Frontal{
/*
Clase frontal de EFI, se encarga de manipular peticiones y llamar a la funcionalidad requerida. 
procesa las peticiones ajax.
*/
	public function validaModulo(){

	}

	/**
	* Obtiene el modulo solicitado que viene en la peticion.
	* @return el valor del Modulo solicitado.
	*/
	public function getM(){
		if(Efi::$base->request->get('ajax')) return Efi::$base->request->post('m');
		return Efi::$base->request->get('m');
	}

	/**
	* Obtiene la Funcionalidad solicitada que viene en la peticion.
	* @return el valor de la Funcionalidad solicitada.
	*/
	public function getF(){
		if(Efi::$base->request->get('ajax')) return Efi::$base->request->post('f');
		return Efi::$base->request->get('f');
	}

	/**
	* Obtiene El nombre de la pagina solicitada que viene en la peticion.
	* @return el valor de la pagina solicitada.
	*/
	public function getP(){
		if(Efi::$base->request->get('ajax')) return Efi::$base->request->post('p');
		return Efi::$base->request->get('p');	
	}

	/**
	* Funciona princpal, se encarga de validar la peticion y cargar la funcionalidad respectiva.
	* @return el contenido generado.
	*/
	public function Recibe(){
		// Valida si se hace una peticion a la Api de AJAX.
		if(Efi::$base->request->get('ajax')){

			// Valida si la peticion es Ajax, si no lo es devuelve Vacio o error.
			if(!Efi::$base->request->isAjax()) throw new \Exception('Petición Ajax no permitido, utilice la API');
			// Nueva instancia de la api que procesa la peticion Ajax y retorn a en formato JSON.
			// $ajax = new api($this);
			$contenido = $this->cargaFuncionalidad($this->getM(),$this->getF(),$this->getP());
			$respuesta = ['estado'=>'OK','mensaje'=>$contenido];
			return json_encode($respuesta);
		}

		//Ejecuta instalador
		if(strcmp(Efi::$base->request->get('op'), 'install') === 0){
			return $this->cargaInstalador();
		}
		// Valida si el usuario esta Logeado. si no es asi redirecciona a Login.
		if(Efi::$base->request->isHome()){
			// Carga la funcionalidad de Login.
			return $this->cargaFuncionalidad(0,2,'login');
		}else{
			// Carga la funcionalidad requerida.
			return $this->cargaFuncionalidad($this->getM(),$this->getF(),$this->getP());
		}
	}

	/**
	* Carga la Funcionalidad respectiva de acuerdo a la petición.
	* @return el valor que retorna el controlador respectivo.
	*/
	public function cargaFuncionalidad($mod,$fun,$pagina){

		// Consulta en la base de datos la funconalidad requrida.
		$modulo = FuncionalidadVO::busca()->where(['fun_id'=>$fun,'fun_modid'=>$mod])->uno();

		// Construye la ruta para cargar el controlador de la funcionalidad.
		$func = "app\\Funcionalidad\\".trim($modulo->fun_clase)."\\Controlador"; 

		// Crea nueva instancia del Controlador de la funcionalidad solicitada.
		$controlador = new $func($pagina,trim($modulo->fun_clase));

		// retorna el contenido de la ejecucion en formato HTML
		return $controlador->ejecuta();
	}

	public function cargaInstalador(){

		// Construye la ruta para cargar el controlador de la funcionalidad.
		$func = "app\\Funcionalidad\\Instalador\\Controlador"; 

		// Crea nueva instancia del Controlador de la funcionalidad solicitada.
		$controlador = new $func('index', 'instalador');

		// retorna el contenido de la ejecucion en formato HTML
		return $controlador->ejecuta();
	}

}