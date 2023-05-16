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
	 echo($exception->getMessage());  //pas diffusion sur internet qu'en mode local!'
exit('erreur de conexion a la PDO');
}

?>