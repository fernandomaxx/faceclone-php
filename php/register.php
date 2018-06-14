<?php

	require_once('../db.class.php');

	$username = $_POST['username'];
	$nickname = $_POST['nickname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sex = $_POST['sex'];
	$date = $_POST['date'];
	$date = date("Y-m-d",strtotime(str_replace('/','-',$date)));

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = " insert into pessoa(nome, email, senha, sexo, dataNascimento, nickname) values ('$username', '$email', '$password', $sex, '$date', '$nickname') ";
	echo $sql;
	//executar a query
	if(mysqli_query($link, $sql)){
		echo 'Usuário registrado com sucesso!';
	} else {
		echo 'Erro ao registrar o usuário!';
	}

	$sql1 = "insert into mural(fk_email, fk_nickname) values ('$email', '$nickname') ";

	if(mysqli_query($link, $sql1)){
		echo 'mural registrado com sucesso!';
		header("Location: ../index.php");
	} else {
		echo 'Erro ao registrar o mural!';
	}
