<?php
namespace efi\general;

class session{
/*
	se encarga de gestionar la session del usuario en el servidor.
	todos los nombres de variables se definen usando un 'tokenSesion'.

	Ver:
	 archivo -config.php- (Archivo de configuracion EFI).

	Esto se hace para permitir ejecutar mas de una aplicacion de EFI en el mismo servidor
	de esta forma los nombres se crean unicos en todo el servidor.
*/

	// ID de la session.
	private $id;

	/**
	* Valida si la peticion la hace un visitante.
	* @return Boolean true si NO esta logueado, false si esta Logueado.
	*/
	public function isVisitante(){
		return !$this->isActivo();
	}

	/**
	* Valida si la peticion la hace un usuario logueado.
	* @return Boolean true si esta logueado, false si no.
	*/
	public function isActivo(){
		@session_start();
		if(isset($_SESSION)){
			$name = $GLOBALS['config']['tokenSesion'];
			if(isset($_SESSION[$name."__id"])){
				return true;
			}
		}
		return false;
	}

	/**
	* Crea una nueva sesion al usuario, con el id especificado.
	* @param number ID del usuario que se ha logueado.
	* @return Boolean true si esta logueado, false si no.
	*/
	public function creaSession($id){
		@session_start();
		$name = $GLOBALS['config']['tokenSesion'];
		$this->id= $id;
		$_SESSION[$name.'__id'] = $id;
		return true;
	}

	/**
	* Obtiene el valor de una variable de sesion.
	* @param string Nombre de la variable que se quiere obtener
	* @return Boolean|string false si no esta definida | valor de la session.
	*/
	public function get($name){
		@session_start();
		if(isset($_SESSION)){
			$config = $GLOBALS['config']['tokenSesion'];
			if(isset($_SESSION[$config."_".$name])){
				return $_SESSION[$config."_".$name];
			}
		}
		return false;
	}

	/**
	* Define una variable de session al usuario
	* @param string Nombre de la variable que se quiere definir
	* @param string Valor de la variable que se quiere definir
	* @return void.
	*/
	public function set($name,$valor){
		@session_start();
		if(isset($_SESSION)){
			$config = $GLOBALS['config']['tokenSesion'];
			$_SESSION[$config."_".$name] = $valor;
		}

	}

	/**
	* Destruye una variable de sesion definida anteriormente
	* @param string Name, nombre de la variable que se va a destruir.
	* @return void.
	*/
	public function ver_destruye($name){
		@session_start();
		if($this->isActivo()){
			$config = $GLOBALS['config']['tokenSesion'];
			if(isset($_SESSION[$config."_".$name])){
				unset($_SESSION[$config."_".$name]);
			}
		}
	}

	/**
	* Destruye la session del usuario
	* @return void.
	*/
	public function destruye(){
		@session_start();
		if($this->isActivo()){
			$config = $GLOBALS['config']['tokenSesion'];
			foreach ($_SESSION as $key => $value) {
				if(strpos($key, $config) !== false){
					unset($_SESSION[$key]);
				}
			}
		}
	}

}