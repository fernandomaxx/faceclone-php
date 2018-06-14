<?php

  session_start();

  //if(!isset($_SESSION['email'])){
  //  header('Location: index.php?erro=1');
  //}

  require_once('../db.class.php');

  $content = $_POST['content'];
  $nickname = $_SESSION['namegroup'];
  $email = $_SESSION['email_validated'];
  $username = $_SESSION['user_validated'];
  //$id = 1;
  //echo "oiiiiii";
  //if($texto_post == '' || $nickname == ''){
  //  die();
  //}

  $sql = " SELECT idGrupo FROM grupo WHERE nomeGrupo = '$nickname'";
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $result = mysqli_query($link, $sql);

  if ($result) {
     echo "deu merda aqui";
   } 
  $data = mysqli_fetch_array($result);
  $idgroup = $data['idGrupo'];
  echo "$idgroup";

  $sql = " SELECT idMural FROM mural WHERE fk_idGrupo = '$idgroup'";
  $result = mysqli_query($link, $sql);
  if ($result) {
     echo "deu merda aqui 2 fs";
   }  
  $data = mysqli_fetch_array($result);
  $id = $data['idMural'];
  echo "$id";
  echo "$username";
  echo "$email";
  echo "$nickname";
  echo "$content";

  $sql1 = " INSERT INTO postagem(nome, fk_email, fk_nickname, texto, fk_idMural)values('$username','$email', '$username', '$content', $id) ";

  if (mysqli_query($link, $sql1)) {
     echo "deu merda aqui 3";
   }  
  header('Location: ../group.php?namegroup='.$_SESSION['namegroup']);

?>