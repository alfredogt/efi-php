<?php
namespace app\Funcionalidad\Login;

use app\Funcionalidad\login\Modelo;
use efi\general\base\ControladorG;
use efi\general\Efi;
use efi\vo\PersonaVO;
use efi\vo\UsuarioVO;
use app\Widgets\WidgetMenuPrincipal;
use app\Formularios\LoginForm;
use app\Formularios\RegistraForm;

class Controlador extends ControladorG{

	public $pagina;
	public $funcionalidad;
	public $plantilla = 'layout';

	public function restricciones(){
		return [
		'logout'=>'isPost'
		];
	}

	public function paginaLogin(){		
		// si el usuario ya se ha logueado redirige a la pagina index.
		if(Efi::$base->session->isActivo()) return $this->redirige('/index');

		// Verifica si hay una peticion post con datos para proceder a hacer el login
		$form = new LoginForm();
		if($form->carga()){
			$model = new Modelo();
			if($model->login($form)) return $this->redirige('/index');			
		}
		// Define la plantilla de login;
		$this->plantilla = 'login';
		// Retorna la vista Login;
		return $this->vista('login',['form'=>$form]);		
	}

	public function paginaIndex(){
		// If el usuario no se ha logueado redirige al login.
		if(!Efi::$base->session->isActivo()) return $this->redirige('/login');
		return $this->vista('index');
	}

	public function paginaLogout(){
		// Destruye la variable de session.
		Efi::$base->session->destruye();
		return $this->redirige('index');
	}

	public function paginaRegistra(){
		$this->plantilla = 'login';
		$form = new RegistraForm();
		if($form->carga()){
			if($form->valida()){
				$model = new Modelo();
				if($model->registraUser($form)) return $this->redirige('login');
			}
		}
		return $this->vista('registra',['form'=>$form]);
	}

}