<?php
abstract class DAO {
	protected $server = "localhost";
	protected $db = "estoque";
	protected $user = "root";
	protected $password = "";
	protected $connection;
	
	public function getConnection() {
		//Connect to the MySQL server
		$this->connection = mysqli_connect($this->server, $this->user, $this->password) or mysqli_connect_error(); 
		
		//select database
		mysqli_select_db($this->connection, $this->db) or mysqli_connect_error();
		
		return $this->connection;
	}
}
?>