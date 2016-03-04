<?php
namespace app\helpers;

class VistaHelper{

	public static function GrupoOpciones($opciones){
		$str = '';
		if(isset($opciones['ver'])){ 
			$param = self::construyeUrl($opciones['ver']);
			$prm = json_encode($opciones['params']);
			$str .= "<a href='#' onclick='peticion_param(".$param.",".$prm.",event)' class='btn btn-success btn-circle'><i class='fa fa-eye'></i></a>"; 
		}
		if(isset($opciones['edita'])){
			$param = self::construyeUrl($opciones['edita']);
			$prm = json_encode($opciones['params']);
			$str .= "<a href='#' onclick='peticion_param(".$param.",".$prm.",event)' class='btn btn-info btn-circle'><span class='fa fa-pencil'></span></a>";
		}
		if(isset($opciones['elimina'])){
			$param = self::construyeUrl($opciones['elimina']);
			$prm = json_encode($opciones['params']);
			$str .= "<a href='#' onclick='peticion_param(".$param.",".$prm.",event)' data-confirm='¿Seguro que desea eliminar este registro?' class='btn btn-danger btn-circle'><span class='fa fa-trash-o'></span></a>";
		}
		return $str;
	}

	public static function construyeUrl($url){
		$arr = explode('/', $url);
		$pg = "\"".array_pop($arr)."\"";
		$arr[count($arr)] = $pg;
		$param = join(',',$arr);
		return $param;
	}
}