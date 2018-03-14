<?php
	$server = "localhost";
	$user = "root";
	$password = "chofun1942r";
	$bd = "decreto";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	
//CREATE TABLE `decreto`.`decreto` ( `decreto_id` INT NOT NULL , `fecha` VARCHAR(255) NOT NULL , `materia` VARCHAR(255) NOT NULL , `pdf` VARCHAR(255) NOT NULL , PRIMARY KEY (`decreto_id`)) ENGINE = InnoDB; 

?>

