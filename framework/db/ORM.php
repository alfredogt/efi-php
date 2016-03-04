<?php
namespace efi\db;

use efi\db\Query;

class ORM {  

    public static $query;

    function __construct(){
        self::$query = new Query($this->nombreTabla(),get_called_class());
    }

    public static function busca(){
        self::$query = new Query(static::nombreTabla(),get_called_class());
        return self::$query;
    }

    public function elimina(){
         $params = get_object_vars($this);
         $query = self::$query;
         $result = $query->elimina($params);
        if($result['error']){
            $str = "Error de MYSQL";
            $str .= '<br>Error: '.$result['error'];
            $str .= '<br>Mensaje: '.$result['message'];
            echo $str;
            exit;
        }
        return true;
    }

    public function actualiza(){
        $params = get_object_vars($this);
        $query = self::$query;
        $query->is_new = false;
        $result = $query->guardaSQL($params);
        if($result['error']){
            $str = "Error de MYSQL";
            $str .= '<br>Error: '.$result['error'];
            $str .= '<br>Mensaje: '.$result['message'];
            echo $str;
            exit;
        }
        return true;
    }

    public function registra(){
        $params = get_object_vars($this);
        $query = self::$query;
        $query->is_new = true;
        $result = $query->guardaSQL($params);
        if($result['error']){
            $str = "Error de MYSQL";
            $str .= '<br>Error: '.$result['error'];
            $str .= '<br>Mensaje: '.$result['message'];
            $str .= '<br>Sql: '.$result['query'];
            echo $str;
            exit;
        }
        return true;
    }

    public static function ejecutaSql($sql){
        // self::$query = new Query(static::nombreTabla(),get_called_class());
        return self::$query->ejecutaSql($sql);
    }


}