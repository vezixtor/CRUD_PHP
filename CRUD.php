<?php
require_once("DAO.php");

class CRUD extends DAO {
	protected $table;
	
	public function __construct($table) {
		//pickup connection parent::__construct();
		$this->connection = $this->getConnection();
		
		//set table
		$this->table = $table;
	}
	
	public function __destruct() {
		if($this->connection != NULL) {
			mysqli_close($this->connection);
		}
	}
	
	public function create($campos=null) {
		//INSERT INTO usuario (id, nome, email) VALUES (3,'Vezi','email@vd.net')
		$sql = "INSERT INTO ".$this->table." (";
		
		for($i = 0; $i < count($campos); $i++) {
			$sql .= key($campos);
			
			//Montando separação de variaveis
			if($i < (count($campos) - 1)) {
				$sql .= ", ";
			}else {
				$sql .= " ";
			}
			
			//proxima chave(key) do array
			next($campos);
		}
		
		$sql .= ") VALUES (";
		
		reset($campos);
		
		for($i = 0; $i < count($campos); $i++) {
			$sql .= is_numeric( $campos[key($campos)] ) ? $campos[key($campos)] : "'".$campos[key($campos)]."'";
			
			//Montando separação de variaveis
			if($i < (count($campos) - 1)) {
				$sql .= ", ";
			}else {
				$sql .= " ";
			}
			next($campos);
		}
		$sql .= ")";
		echo $sql;
		$query = mysqli_query($this->connection, $sql);
	}
	
	public function select($where=null) {
		$sql = "SELECT * FROM ".$this->table;
		if ($where != null) {
			$sql .= " ".$where;
		}
		echo $sql;
		
		//Executa o SQL
		$query = mysqli_query($this->connection, $sql);
		echo "<br>Linhas afetadas = ".mysqli_affected_rows($this->connection);
		
		//Retorna dados
		//$data = mysqli_fetch_object($query);
		
		//mysqli_fetch_assoc
		//mysqli_fetch_object
		//mysqli_fetch_array
		while ($row = mysqli_fetch_assoc($query)){
			echo "<br>";
			foreach($row as $element){
				//echo " / ".$element;
				//$data[] = $element;
			}
			$data[] = $row;
		}
		
		
		return $data;
	}
	
	public function update($campos, $where) {
		//UPDATE `usuario` SET `sobrenome` = 'Master' WHERE `usuario`.`id` = 21;
		$sql = "UPDATE ".$this->table." SET ";
		
		for($i = 0; $i < count($campos); $i++) {
			$sql .= key($campos)." = ";
			$sql .= is_numeric( $campos[key($campos)] ) ? $campos[key($campos)] : "'".$campos[key($campos)]."'";
			
			if($i < count($campos) - 1) $sql .= ", ";
			else $sql .= " ";
			
			next($campos);
		}
		$sql .= $where;
		
		echo $sql;
		$query = mysqli_query($this->connection, $sql);
		echo "<br>Linhas afetadas = ".mysqli_affected_rows($this->connection);
	}
	
	public function delete($where=null) {
		//DELETE FROM `usuario` WHERE 1
		$sql = "DELETE FROM ".$this->table." ".$where;
		echo $sql;
		
		$query = mysqli_query($this->connection, $sql);
		echo "<br>Linhas afetadas = ".mysqli_affected_rows($this->connection);
	}
}
?>