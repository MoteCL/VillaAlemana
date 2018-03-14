<?php

	include 'conexion.php';
		$anno= $_GET["anno"];
	//	$anno=date("Y");

	$query = "SELECT * FROM decreto WHERE fecha='$anno' ORDER BY decreto_id ASC;";

	$resultado = mysqli_query($conexion, $query);
	

	if (!$resultado) {
	die("Error");
	}else {
		while ($data = mysqli_fetch_assoc($resultado)) {
			$arreglo["data"][] =  $data;
		}
		echo json_encode($arreglo);
	}
	mysqli_free_result($resultado);
	mysqli_close($conexion);

	