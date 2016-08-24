<?php //Create, Read, Update and Delete
require_once("DAO.php");

class CRUD extends DAO {
	protected $table;
	
	public function __construct($pdoConnection, $table) {
		//Pickup connection - parent::__construct();
		$this->pdoConnection = $pdoConnection;
		
		//Set $table
		$this->table = $table;
	}
	
	//public function __destruct() {}
	
	public function create($fields_and_values = null) {
		//Para cada informação do array
		foreach ($fields_and_values as $key => $value) {
			$fields[] = $key;
			$values[] = $value;
		}
		
		//Formata a string para o padrao SQL 
		$fields = implode(", ", $fields);
		$values = "'" . implode("', '", $values) . "'";
		
		$sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
		
		return $this->executeSQL($sql);
	}
	
	public function select($where=null) {
		$sql = "SELECT * FROM ".$this->table;
		if ($where != null) {
			$sql .= " WHERE ".$where;
		}
		//echo $sql;
		return $this->executeSQL($sql);
	}
	
	public function update($campos = NULL, $where = NULL) {
		//Se faltar informaçoes PARE!
		if($campos == NULL || $where == NULL) return false;
		
		$sql = "UPDATE {$this->table} SET ";
		
		for($i = 0; $i < count($campos); $i++) {
			$sql .= key($campos)." = ";
			$sql .= is_numeric( $campos[key($campos)] ) ? $campos[key($campos)] : "'".$campos[key($campos)]."'";
			
			if($i < count($campos) - 1) $sql .= ", ";
			else $sql .= " ";
			
			//Va para o proximo campo do array
			next($campos);
		}
		$sql .= "WHERE ".$where;
		
		//echo $sql;
		return $this->executeSQL($sql);
	}
	
	public function delete($where=null) {
		if($where == NULL) return false;
		
		$sql = "DELETE FROM {$this->table} WHERE {$where}";
		
		//echo $sql;
		return $this->executeSQL($sql);
	}
}