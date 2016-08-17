<?php
require_once("CRUD.php");

function vd($var) { //Alternativa para o var_dump
	echo '<hr><pre>';
	print_r($var);
	echo '</pre><hr>';
}


$obj = new CRUD("usuario");
//vd($obj);

/**/
//$result = $obj->select("where nome='Rivqah'");
$result = $obj->select();
//vd($result);
foreach($result as $row) {
	for($i = 0; $i < count($row); $i++) {
		echo "[".key($row)."] => ".$row[key($row)].'<br>';
		next($row);
	}
	echo '<br>';
}/**/
$campos = array(
            'id' => 10,
            'nome' => 'Rivqah',
            'sobrenome' => 'Precious',
            'senha' => md5('leitora'),
            'email' => 'rivqah@precious.net'
        );
//vd($campos);

//$obj->create($campos); //Create
//$obj->select(); //Read
//$obj->update($campos, "WHERE id = 10"); //Update
//$obj->delete("WHERE id = 10"); //Delete

?>