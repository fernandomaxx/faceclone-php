<?php
	require_once('../db.class.php');
	session_start();

	$groupname = $_GET['uid'];
	$email = $_SESSION['email_validated'];
	$nickname = $_SESSION['user_validated'];
	echo $nickname;

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = " SELECT idGrupo FROM grupo WHERE nomeGrupo = '$groupname'";
	$result = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($result);
	$idgroup = $data['idGrupo'];
	
	$sql = " INSERT INTO solicitagrupo(fk_nickname, fk_email, fk_idGrupo)values('$nickname','$email',$idgroup) ";
	mysqli_query($link, $sql);

	//header('Location: ../group.php?nick=');

?>