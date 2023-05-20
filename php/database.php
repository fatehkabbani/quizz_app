<?php
$config = array(
	'host'      => 'localhost',
	'username'  => 'root',
	'password' => '',
	'database'  => 'project'
);


try{
	$laison = new PDO('mysql:dbname='.$config['database'].';host='.$config['host'].";charset=utf8",$config['username'],$config['password']);	
} 
catch(PDOException $exception){
	 echo($exception->getMessage());  
exit('erreur de conexion a la PDO');
}

?>