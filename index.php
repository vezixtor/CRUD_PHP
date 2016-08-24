<?php
require_once("config.php");

try { //Declarando dependencia
	$pdo = new PDO("mysql:host=localhost;dbname=learning", "root", "");
}
catch(PDOException $e) {
	echo $e->getMessage();
}

//Injetando a dependencia
$obj = new CRUD($pdo, "crud");

$campos = array(
            'name' => 'Vezi0',
            'tel' => '981334279',
            'date' => '2016-08-23',
        );
//vd($campos);

//Create
//$obj->create($campos);

//Read"id != 1"
$obj->select();
	vd( $obj->getData("assoc") );


//Update
//$obj->update($campos, "id = 1");/**/


//Delete
//$obj->delete("id = 1");



/**/
//$result = $obj->select("where nome='Rivqah'");
//$result = $obj->select();
//vd($result);
/*/
foreach($result as $row) {
	for($i = 0; $i < count($row); $i++) {
		echo "[".key($row)."] => ".$row[key($row)].'<br>';
		next($row);
	}
	echo '<br>';
}/**/
