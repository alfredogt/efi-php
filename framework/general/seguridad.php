<?php
namespace efi\general;

class seguridad{

	// Define el coste para la generacion de la contraseña. 
	// Por favor calcule el mejor coste segun su servidor.
	public $coste = 8;

	/**
	* Genera hash seguro para la contraseña
	* @param $password contraseña para generar el hash
	* @return String hash generado
	*/
	public function generaPasswordHash($password){
		$hash = password_hash($password,PASSWORD_DEFAULT,['cost'=>$this->coste]);
		return $hash;
	}

	/**
	* Compara que la nueva contraseña sea igual al hash generado
	* @param $password contraseña para generar el hash
	* @param $hash hash definido para comparar.
	* @return Boolean 
	*/
	public function validaPasswordHash($password, $hash){
		$resp = password_verify($password,$hash);
		return $resp;
	}

	/**
	* Genera cadena aleatoria
	* @param $longitud longitud de la cadena que se debe generar, por defecto es 32.
	* @return String Cadena generada.
	*/
	public function generaRandomString($longitud = 32){
		$cadena = substr(str_shuffle(sha1(time())),0,$longitud);
		return $cadena;
	}

	/**
	* Calcula el mejor coste, segun el servidor que esta ejecutando la aplicacion, 
	* esto es importante para no exceder el consumo del servidor.
	* Tomado desde http://php.net/manual/es/function.password-hash.php
	* @return Integer $coste
	*/
	public function calculaMejorCoste(){
		$timeTarget = 0.05; // 50 milisegundos 
		$coste = 6;
		do {
		    $coste++;
		    $inicio = microtime(true);
		    password_hash("test", PASSWORD_BCRYPT, ["cost" => $coste]);
		    $fin = microtime(true);
		} while (($fin - $inicio) < $timeTarget);

		return $coste;
	}
}
?>