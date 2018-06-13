<?php
	require_once('../db.class.php');
	session_start();

	//$option = $_GET['log'];
	$_nickname = $_GET['nick'];
	echo $_nickname;
	$email = $_SESSION['email_validated'];
	$nickname = $_SESSION['user_validated'];
	echo $nickname;

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = " SELECT email FROM pessoa WHERE nickname = '$_nickname'";
		$result = mysqli_query($link, $sql);
		$data = mysqli_fetch_array($result);
		$_email = $data['email'];

	$sql = " SELECT * FROM amizade WHERE fk_nickname = '$nickname' and fk_nicknameAmizade = '$_nickname'";
		$result = mysqli_query($link, $sql);

		if ($result) {
			$sql = "DELETE 	FROM amizade WHERE 	fk_nickname = '$_nickname' and fk_nicknameAmizade = '$nickname'";
			mysqli_query($link, $sql);

			$sql = "DELETE 	FROM amizade WHERE 	fk_nickname = '$nickname' and fk_nicknameAmizade = '$_nickname'";
			mysqli_query($link, $sql);
		}	

	$sql = " INSERT INTO bloqueiopessoa(fk_nickname, fk_nicknameBloqueio, fk_email, fk_emailBloqueio)values('$nickname','$_nickname', '$email', '$_email') ";
	mysqli_query($link, $sql);

	$sql = " INSERT INTO bloqueiopessoa(fk_nickname, fk_nicknameBloqueio, fk_email, fk_emailBloqueio)values('$_nickname','$nickname', '$_email', '$email') ";
	mysqli_query($link, $sql);

	header('Location: ../home.php?nick='.$_SESSION['user_validated']);

?>