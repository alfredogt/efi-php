<?php
namespace efi\db;

use efi\db\Database;

class Query{

	private $sql;
	private $table;
	private $select;
	private $where;
	private $andwhere;
	private $orwhere;
	private $limit;
	private $offset;
	private $orderby;
	private $groupby;
	private $class;
	private $params;
	private static $database;
	public $is_new;

	function __construct($table,$class){
		self::getConnection();
		$this->class=$class;
		$this->select = " * ";
		$this->where = " 1=1 ";		
		$this->table = $table;
		$this->is_new = null;
	}

	public function ejecutaSql($sql){
		return self::$database->execute($sql, null, []);
	}

    private static function getConnection() {
        require_once ('Database.php');
        $db_config=$GLOBALS['config']['db'];
        self::$database = Database::getConnection($db_config['provider'], $db_config['host'], $db_config['user'], $db_config['pass'], $db_config['dbname']);
    }

    public function elimina($parametros){
    	$keys = $this->getPrimary();
    	print_r(in_array('per_id', $parametros));
    	$where = ' where 1=1 ';
    	foreach ($keys as $value) {
    		if(!isset($parametros[$value])){
    			echo 'El campo <b>'.$value.'</b> es obligatorio';
    			return false;
    		}
    		$where.=" and ".$value."='".$parametros[$value]."' ";
    	}
    	$sql ='delete from '.$this->table.' '.$where;    	
    	$result = self::$database->execute($sql, null, []);
    	return $result;
    }

	public function select($selc){		
		$this->select = "";
		foreach ($selc as $value) {
			$this->select.= $value.",";
		}
		$this->select = substr ($this->select, 0, strlen($this->select) - 1);
		return $this;
	}

	public function where($filtro,$params = []){
		$this->params = $params;
		foreach ($filtro as $key => $value) {
			$this->where .= " and ".$key."='".$value."'"; 
		}
		return $this;
	}	

	public function getSql(){
		$this->completa();
		return $this->sql;
	}

	public function andWhere($filtro){

	}

	public function orWhere($filtro){

	}

	public function limit($limit, $offset = null){
		$this->limit=$limit;
		if($offset!=null){
			$this->offset = $offset;
		}
		return $this;
	}

	public function orderBy($order){

	}

	public function groupBy($group){

	}

	public function todo(){
		self::getConnection();
		$obj = null;
		$this->completa();
		 $results = self::$database->execute($this->sql, null, $this->params);
        if ($results) {
            $class = $this->class;
            for ($i = 0;$i < sizeof($results);$i++) {
                $obj[] = $this->retorna(new $class(),$results[$i]);
            }
        }
        return $obj;
	}

	public function uno(){
		self::getConnection();
		$this->completa();
		 $results = self::$database->execute($this->sql, null, $this->params);
        if ($results) {
            $class = $this->class;
            return  $this->retorna(new $class(),$results[0]);
        }
        return null;
	}

	private function completa(){
		$this->sql = "select ".$this->select." from ".$this->table;
		$this->sql .= " where ".$this->where;
		if($this->limit != null) $this->sql.= " limit ".$this->limit;
		if($this->offset != null) $this->sql.= " offset ".$this->offset;
	}

	private function retorna($object,$data) {
        if ($data && sizeof($data)) {
            foreach ($data as $key => $value) {
                // $key = strtolower($key);
                $object->$key = $value;
            }
        }
        return $object;
    }

    // Insert a tabla
    public function guardaSQL($parametros) {
        $values = $this->getColumns();
        $valores = $parametros;       
        if (isset($this->is_new)){
        	if(!$this->is_new) {
	        	$columns = join(" = ?, ", $values);
	         	$columns.= ' = ?';      
	            $keys = $this->getPrimary();
	            $k = ' 1=1 ';
	            foreach ($keys as $val) {
	            	if(in_array($val, $values)){
	            		$k .= "and ".$val." = ".$valores[$val];
	            	}	            	
	            }
	            $query = "UPDATE " . $this->table . " SET $columns WHERE ".$k;
	        } else {
	        	$values = $this->arreglaColums($values, $valores);
	            $params = join(", ", array_fill(0, count($values), "?"));	            
	            $columns = join(", ", $values);
	            $query = "INSERT INTO " . $this->table . " ($columns) VALUES ($params)";
        	}
       }        
        $result = self::$database->execute($query, null, $valores);
        if ($result) {
            $result = array('error' => false, 'message' => self::$database->getInsertedID());
        } else {
            $result = array('error' => true, 'message' => self::$database->getError(),'query'=>$query);
        }
        return $result;
    }

    private function arreglaColums($columns, $params){
    	$arr = [];
    	foreach ($columns as $value) {    
    		if(array_key_exists($value, $params)){
    			$arr[] = $value;
    		}
    	}
    	return $arr;
    }

    private function getPrimary(){
    	$keys = self::$database->execute("SHOW KEYS FROM ".$this->table." WHERE Key_name = 'PRIMARY'");
    	$arr = [];
    	foreach ($keys as $value) {
    		$arr[] = $value['Column_name'];
    	}
    	return $arr;
    }

    private function getColumns(){
    	$sql = "SHOW COLUMNS FROM ".$this->table;
    	$rs = self::$database->execute($sql,null,[]);
    	$arr = [];
    	foreach ($rs as $value) {
    		$arr[] = $value['Field'];
    	}
    	return $arr;
    }
}