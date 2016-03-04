<?php
namespace efi\general;

class request{

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

	public function get($valor){
		if($_GET){
			if(isset($_GET[$valor])) return $_GET[$valor];
			return '';
		}
		return false;
	}

	public function post($valor){
		if($_POST){
			if(isset($_POST[$valor])) return $_POST[$valor];
			return '';	
		}
		return false;
	}

	public function getForm($nameform){
		if(!$this->isPost()) return false;	
		if(isset($_POST[$nameform])){
			return $_POST[$nameform];
		}
		return false;
	}

	public function isHome(){
		if($_GET){
			if(isset($_GET['m']) && isset($_GET['f']) && isset($_GET['p'])) return false;
		}
		return true;
	}

	public function isPost(){		
			if(!empty($_POST)) {
				return true;
			}
			return false;
	}

	public function isAjax(){
		 if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') return true;
		 return false;
	}

}