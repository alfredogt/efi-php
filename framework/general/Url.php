<?php
namespace efi\general;
/*
 Clase para el manejo de las Url, se usa para evitar problmeas de rutas.
*/

class Url{

	/**
	* Genera Url apropiada para evitar inconvenientes de rutas.
	* @return String url.
	*/
	public static function creaUrl($url, $ajx = false){
		$url = explode('/', $url);
		$link = explode('/',$_SERVER["REQUEST_URI"]);
		$base = $link[1];
		$link ='';
		if(count($url)>1){
			if($ajx){
				$pg = array_pop($url);
				$url[count($url)] = "'".$pg."'";
				$link = join(',',$url);
				return $link;
			} 
			$link = join('/',$url);
		}else{
			$req = Efi::$base->request;
			if($ajx) return $req->getM().",".$req->getF().",'".$url[0]."'";
			$link = $req->getM().'/'.$req->getF().'/'.$url[0];
		}
		if($ajx) return str_replace('/', ',', $link);
		return '/'.$base.'/'.$link;
	}

	/**
	* Genera Link Para consumir la API de EFI. todas las peticiones se hacen por AJAx
	* @param String|Array $url
	* @return String url.
	*/
	public static function link($url,$valor,$params = []){
		$url = self::creaUrl($url,true);
		$lnk = "<a href='#' ".self::recorreArray($params)." onclick=\"peticion_general(".$url.",event)\" >".$valor."</a>";
		return $lnk;
	}

	/**
	* Genera <a> para ir a una pagina
	* @param String|Array $url
	* @return String url.
	*/
	public static function a($url,$valor,$params = []){
		$url = self::creaUrl($url);
		$lnk = "<a href='".$url."' ".self::recorreArray($params)." >".$valor."</a>";
		return $lnk;
	}

	/**
	* Genera Link Para consumir la API de EFI. Se usa para enviar un formulario
	* @param String|Array $url
	* @return String url.
	*/
	public static function linkF($url,$valor,$form,$params){
		$url = self::creaUrl($url,true);

		if(isset($params['params'])){
			$url = str_replace("'", '"', $url);
			// throw new \Exception("Error".$url);
			$prm = json_encode($params['params']);
			$lnk = "<a href='#' ".self::recorreArray($params)." onclick='peticion_paramF(".$url.",".$prm.",\"".$form."\",event)' >".$valor."</a>";
		}else{
			$lnk = "<a href='#' ".self::recorreArray($params)." onclick=\"peticion_form(".$url.",'".$form."',event)\" >".$valor."</a>";
		}		
		return $lnk;
	}

	/**
	* Genera Url para una imagen apropiada para evitar inconvenientes de rutas.
	* @return String url a la imagen.
	*/
	public static function imagen($url){
		$link = explode('/',$_SERVER["REQUEST_URI"]);
		$base = $link[1];
		return '/'.$base.'/web/img/'.$url;
	}

	/**
	* Recorre el array y genera un string con los campos clave-valor.
	* @return String cadena generada despues de recorrer el array.
	*/
	public static function recorreArray($arr){
		$str='';
		if(count($arr)){
			foreach ($arr as $key => $value) {		
				if(!is_array($value)){
					$str.= " ".$key."='".$value."'";
				}
			}
		}
		return $str;
	}
}