<?php
  session_start();
  require_once('../db.class.php');

  $groupname = $_POST['groupname'];
  $description = $_POST['description'];
  $privacy = $_POST['privacy'];
  $nickname = $_SESSION['user_validated'];
  $email = $_SESSION['email_validated'];

  $objDb = new db();
  $link = $objDb->conecta_mysql();

  $sql = " INSERT into administrador(nickname, email) values ('$nickname', '$email') ";
  mysqli_query($link, $sql);

  $sql = " INSERT into grupo(nomeGrupo, descricaoGrupo, privacidade) values ('$groupname', '$description', '$privacy') ";
  mysqli_query($link, $sql);

  $sql = " SELECT idGrupo FROM grupo WHERE nomeGrupo = '$groupname'";
  $result = mysqli_query($link, $sql);
  $data = mysqli_fetch_array($result);
  $idgroup = $data['idGrupo'];

  $sql = " INSERT into administragrupo(fk_emailAdm, fk_nicknameAdm, fk_idGrupo) values ('$email', '$nickname', '$idgroup') ";
  mysqli_query($link, $sql);

  header('Location: ../home.php?nick='.$_SESSION['user_validated']);