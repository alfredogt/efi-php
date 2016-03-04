<?php
namespace app\Funcionalidad\ListadoPersonas;

use app\Funcionalidad\ListadoPersonas\Modelo;
use efi\general\base\ControladorG;
use efi\vo\PersonaVO;
use efi\general\Efi;
use efi\helpers\FormularioEFI;

class Controlador extends ControladorG{

	public $pagina;
	public $funcionalidad;	
	

	public function paginaIndex(){
		$personas = PersonaVO::busca()->todo();
		return $this->vista('index',['personas'=>$personas]);
	} 

	public function paginaNuevo(){
		$persona = new PersonaVO();
		$formEFI = new FormularioEFI();
		if($formEFI->cargaVO($persona)){
			if($persona->registra()){
				return '<b>Nueva persona registrada</b>';
			}
		}

		return $this->vista('nuevo',['persona'=>$persona]);
	}

	public function paginaEditar(){
		$id = Efi::$base->request->post('per_id');
		$persona = PersonaVO::busca()->where(['per_id'=>$id])->uno();
		$formEFI = new FormularioEFI();
		if($formEFI->cargaVO($persona)){
			if($persona->actualiza()){
				return 'Datos de persona Actualizados';
			}
		}
		return $this->vista('edita',['persona'=>$persona]);
	}

	public function paginaEliminar(){
		$id = Efi::$base->request->post('per_id');
		$persona = PersonaVO::busca()->where(['per_id'=>$id])->uno();
		if($persona->elimina()) return 'La persona, ha sido eliminada';
	}

	
}