<?php
	require_once('../db.class.php');
	session_start();

	$option = $_GET['log'];
	$_nickname = $_GET['nick'];
	echo $_nickname;
	$email = $_SESSION['email_validated'];
	$nickname = $_SESSION['user_validated'];
	echo $nickname;

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	if ($option != "accept") {
		$sql = " SELECT email FROM pessoa WHERE nickname = '$_nickname'";
		$result = mysqli_query($link, $sql);
		$data = mysqli_fetch_array($result);
		$_email = $data['email'];

		$sql = " INSERT INTO amizade(fk_nickname, fk_nicknameAmizade, fk_email, fk_emailAmizade)values('$nickname','$_nickname', '$email', '$_email') ";
		mysqli_query($link, $sql);

		$sql = " INSERT INTO amizade(fk_nickname, fk_nicknameAmizade, fk_email, fk_emailAmizade)values('$_nickname','$nickname', '$_email', '$email') ";
		mysqli_query($link, $sql);

	}

	$sql = "DELETE 	FROM solicitaamizade WHERE 	fk_nicknameSolicitaAmizade = '$_nickname' and fk_nickname = '$nickname'";
	mysqli_query($link, $sql);

	//header('Location: ../home.php?nick='.$_SESSION['user_validated']);

?>