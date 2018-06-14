<?php
	require_once('../db.class.php');
	session_start();

	$option = $_GET['log'];
	$nickname = $_GET['nick'];
	$email = $_GET['email'];
	$idgroup = $_GET['idgroup'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	if ($option == "accept") {
		$sql = " INSERT INTO participagrupo(fk_nickname, fk_idGrupo, fk_email)values('$nickname','$idgroup', '$email') ";
		mysqli_query($link, $sql);
	}

	$sql = "DELETE 	FROM solicitagrupo WHERE fk_nickname = '$nickname' and fk_idGrupo = '$idgroup'";
	if(mysqli_query($link, $sql)){
	}

	header('Location: ../register-group.php');

?>