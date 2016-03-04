<?php
namespace efi\general;

use efi\general\request;
use efi\general\session;
use efi\general\seguridad;

class Efi{

	public static $base;
	public $request;
	public $session;
	public $seguridad;

	public function __construct(){		
		$this->request = new request();
		$this->session = new session();
		$this->seguridad = new seguridad();
	}

	public function getSession(){
		return $this->session;
	}

	public function getRequest(){
		return $this->request;
	}

	public function getSeguridad(){
		return $this->seguridad;
	}

}