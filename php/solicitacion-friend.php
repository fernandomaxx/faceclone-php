<?php
	session_start();

	require_once('db.class.php');

	$_nickname = $_GET['uid'];
	$nickname = $_SESSION['user_validated'];
	$email = $_SESSION['email_validated'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = " SELECT email FROM pessoa WHERE nickname = '$_nickname'";
	$result = mysqli_query($link, $sql);
	$data = mysqli_fetch_array($result);
	$_email = $data['email'];

	$sql = " insert into solicitaamizade(fk_nicknameSolicitaAmizade, fk_nickname, fk_email, fk_emailSolicitaAmizade) values ('$nickname', '$_nickname', '$_email', '$email' ) ";

	if(mysqli_query($link, $sql)){
		echo 'solicitação enviada com sucesso!';
		header("Location: home.php?nick=".$nickname);
	} else {
		echo 'Erro ao registrar o mural!';
	}