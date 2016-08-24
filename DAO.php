<?php //Data Access Object 
abstract class DAO {
	protected $pdoConnection;
	protected $data;
	protected $affectedRows;
	
	public function executeSQL($sql) {
		//A query é um object(PDOStatement)
		$query = $this->pdoConnection->prepare($sql);
		$query->execute() or die(print_r($query->errorInfo(), true));
		
		//Set linhas afetadas
		//$this->affectedRows = $query->rowCount();
		
		//
		if($query->rowCount() > 0) {
			//Caso tenha sido o SELECT o comando, pegue o resultado
			if(substr(trim(strtolower($sql)), 0, 6) == "select") $this->data = $query;
			
			return 1;
		}
		else return 0;
	}
	
	public function getData($fetchOption = NULL) {
		switch ($fetchOption) {
			case "array":
				return $this->data->fetchAll(PDO::FETCH_NUM);
				break;
			case "assoc":
				return $this->data->fetchAll(PDO::FETCH_ASSOC);
				break;
			default:
				return $this->data->fetchAll(PDO::FETCH_OBJ);
		}
	}
}