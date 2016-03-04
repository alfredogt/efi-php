<?php
namespace efi\helpers;

class ValidadorEFI{

	public $validar;
	public $_form;
	public $estado;

	function __construct($obj){
		$this->_form = $obj;
		$this->estado = true;
	}

	public function obligatorio($arr){
		$arr = $arr[0];
		$err = Array();
		foreach ($arr as $value) {
			if(empty($this->_form->$value)){
				$err[''.$value.''] = "El campo <b>".$value."</b> es obligatorio";
				$this->estado = false;
			}
		}
		if(count($err)>0) $this->_form->_erroresEFI[] = $err;
		return $this->_form;
	}

	public function identico($arr){
		$arr = $arr[0];
		$err = Array();
		$_base = $arr[0];
		$base = $this->_form->$_base;
		unset($arr[0]);
		foreach ($arr as $value) {
			if(strcmp($base, $this->_form->$value)){
				$err[''.$value.''] = "El campo <b>".$_base."</b> debe ser identico a <b>".join(',',$arr).'</b>';
				$this->estado = false;
			}
		}
		if(count($err)>0) $this->_form->_erroresEFI[] = $err;
		return $this->_form;
	}

	public function unico($arr){		
		if(!isset($arr['class'])) throw new \Exception('El parametro Class es requerido para validar un campo único');
		$vo =  str_replace('/', '\\', $arr['class']);
		$param = $arr[0];
		$err = Array();
		foreach ($param as $value) {	
			$obj = $vo::busca()->where([$value=>$this->_form->$value])->uno();	
			if($obj !== null){
				$err[''.$value.''] = "Ya existe un registro para el valor <b>".$value.":</b> ".$this->_form->$value."";
				$this->estado = false;
			}
		}
		if(count($err)>0) $this->_form->_erroresEFI[] = $err;
		return $this->_form;
	}

	public function string($arr){
		$param = $arr[0];
		$err = Array();
		foreach ($param as $value) {
			if(!is_string($value)){
				$err[''.$value.''] = "El campo: <b>".$value.":</b> debe ser un string";
				$this->estado = false;
			}
		}
		if(count($err)>0) $this->_form->_erroresEFI[] = $err;
		return $this->_form;
	}
}