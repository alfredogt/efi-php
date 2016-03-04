<?php
namespace efi\helpers;

use efi\general\Efi;
use efi\db\Query;
use efi\helpers\ValidadorEFI;

class FormularioEFI{

	private $_formEFI;
	public $_erroresEFI;
	public $fields;
	public $is_vo;
	public $script;
	public $validador;

	function __construct(){
		$this->_formEFI = $this;		
		$this->script = '';
		$this->_erroresEFI = [];
		$this->validador = new ValidadorEFI($this->_formEFI);
	}

	public function preparaScript($src){
		$script ='<script>';
		$script .='$(document).load(function(){ '.$scr.' });';
		$script .= '</script>';
		$this->$script.=' '.$script;
	}

	/**
	* Obtiene el nombre de la clase del formulario o el objeto VO que se pase cuando se carge el formulario.
	* @return String Nombre de la clase del formulario u Objeto VO.
	*/
	public function getName(){
		$name = get_class($this->_formEFI);
		$ls = explode("\\", $name);
		return $ls[count($ls)-1];
	}

	/**
	* Inicia la generacioón del formulario, con los parametros especificados.
	* @param ObjectVO objetoVO para generar el formulario | No obligatorio.
	* @param Array 
	*/
	public function inicia($config = [],$form = null){
		if($form !== null){
			$this->_formEFI = $form;
			$this->is_vo = true;
			$this->fields = $this->getColumns();
		}
		if(count($config)==0) throw new \Exception('El objeto FormularioEFI necesita parametros de configuracion');

		$frm = "<form method='POST' role='role' ";
		$frm .= $this->recorreArray($config);
		$frm .= ">";
		return $frm;

	}	

	/**
	* Cierra el formulario con las configuraciones definidas y campos ocultos definidos.
	* @return String cierre de formulario.
	*/
	public function fin(){
		$frm ='<input id="input_m" name="m" type="hidden" value=""/>';
		$frm .='<input id="input_f" name="f" type="hidden" value=""/>';
		$frm .='<input id="input_p" name="p" type="hidden" value=""/>';
		return $frm.'</form> '.$this->script;
	}

	/**
	* Genera el Html de un nuevo Input
	* @param string $nombre - name del input.
	* @param string $tipo - tipo del campo: text,email,password,... etc.
	* @param Array $atributos - Atributos del input html: class,placeholder,style,... etc.
	* @param Array $config - Parametros de configuración para generar el input.
	* @return String input generado.
	*/
	public function field($nombre, $tipo, $atributos = [], $config = []){
		$this->validaCampo($nombre);
		$val = '';
		if(isset($this->_formEFI->$nombre)) $val = $this->_formEFI->$nombre;
		$field  = "<div class='form-group'>";
		if(isset($config['label'])) $field .= "<label class='label-control' for='asda'>".$config['label']."</label>";
		$field .= "<input name='".$this->getName()."[".$nombre."]' class='form-control' type='".$tipo."' value='".$val."' ";
		$field .= $this->recorreArray($atributos);
		$field .= "/>";
		$field .= "</div>";
		$field .= '<div class="efi_error" id="'.$nombre.'_id"></div>';
		return $field;
	}

	/**
	* Genera el Html de un nuevo Input de tipo CheckBox
	* @param string $nombre - name del input.
	* @param Array $atributos - Atributos del input html: class,placeholder,style,... etc.
	* @param Array $config - Parametros de configuración para generar el input.
	* @return String input checkbox generado.
	*/
	public function checkBox($nombre, $atributos = [], $config = []){
		$this->validaCampo($nombre);
		$val = '';
		if(isset($this->$nombre)) $val='checked';
		$field ="<label>";
		$field .= "<input name='".$this->getName()."[".$nombre."]' type='checkbox' ".$val." ";
		$field .= $this->recorreArray($atributos);
		$field .= "/>";
		$field .= $config['label'];
		$field .= "</label>";
		$field .= '<div class="efi_error" id="'.$nombre.'_id"> </div>';
		return $field;
	}

	/**
	* Valida si el campo existe en el formulario definido, si el objeto es VO no hace validación.
	* @param string $name - nombre del campo que se quiere validar.
	* @return Void.
	*/
	private function validaCampo($name){
		if($this->is_vo){
			if(in_array($name, $this->fields)){ 
				return true;
			}else{
				throw new \Exception('El campo <b>'.$name.'</b> no esta definido en el formulario <b></b>');		
			}
		}
		if(!property_exists($this->_formEFI, $name)) throw new \Exception('El campo <b>'.$name.'</b> no esta definido en el formulario <b></b>');
		return true;
	}

	/**
	* Recorre el array y genera un string con los campos clave-valor.
	* @return String cadena generada despues de recorrer el array.
	*/
	private function recorreArray($arr){
		$str='';
		if(count($arr)){
			foreach ($arr as $key => $value) {				
				$str.= " ".$key."='".$value."'";
			}
		}
		return $str;
	}

	/**
	* Carga los datos que vienen en el formulario
	* @return Boolean | Define si los datos se cargaron correctamente.
	*/
	public function carga(){
		if($arr_form = Efi::$base->request->getForm($this->getName())){
			foreach ($arr_form as $key => $value) {
				if($this->validaCampo($key)){
					$this->$key = $value;
				}
			}
			return true;
		}
		return false;
	}

	public function cargaVO($vo){
		$this->is_vo = true;
		$this->_formEFI = $vo;
		$this->fields = $this->getColumns();
		$cls = explode('\\', get_class($vo)); $cls = array_pop($cls);
		if($arr_form = Efi::$base->request->getForm($cls)){
			foreach ($arr_form as $key => $value) {
				if($this->validaCampo($key)){
					$vo->$key = $value;
				}
			}
			return true;
		}
		return false;
	}

	public function valida(){
		$reglas = $this->reglas();
		foreach ($reglas as $value) {
			$regla = $value[1];
			if(method_exists($this->validador, $regla)){
				$this->_formEFI = $this->validador->$regla($value);
			}else{
				$clase = $this->_formEFI;
				throw new \Exception("La regla <b>".$regla."</b> definida en: <b>".get_class($clase)."</b> no es valida.");
			}
			if(!$this->validador->estado) return false;
		}
		return $this->validador->estado;
	}

	public function errores(){
		$str = '';
		if(isset($this->_formEFI->_erroresEFI)){
			$str .= '<div class="efi_error"> ';
			foreach ($this->_formEFI->_erroresEFI as $value) {
				foreach ($value as $key => $valor) {
					$str .= '<p>'.$valor.'</p>';
				}				
			}			
			$str .= ' </div>';
		}
		return $str;
	}

	private function getColumns(){
    	$sql = "SHOW COLUMNS FROM ".$this->_formEFI->nombreTabla();
    	$rs = $this->_formEFI->ejecutaSql($sql);
    	$arr = [];
    	foreach ($rs as $value) {
    		$arr[] = $value['Field'];
    	}
    	return $arr;
    }
	
}