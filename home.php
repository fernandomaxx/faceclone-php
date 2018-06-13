<?php
  require_once('db.class.php');  
  session_start();
  $objDb = new db();
  $link = $objDb->conecta_mysql();

  if(!isset($_SESSION['email'])){
    header('Location: index.php?erro=1');
  }

  $_SESSION['feed'] = $_GET['nick'];
  echo $_SESSION['feed'];
  $_SESSION['user_validated'] = $_SESSION['nickname'];
  echo $_SESSION['user_validated'];
  $_SESSION['email_validated'] = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>FaceClone</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <!-- nav -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.html">FaceClone</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.html">Home</a></li>
        <li><a href="profile.html">Profile</a></li>
        <li><a href="-logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
  <!-- ./nav -->

  <!-- main -->
  <main class="container">
    <div class="row">
      <div class="col-md-3">
        <!-- profile brief -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4><?= $_SESSION['feed'] ?></h4>
            <p>I love to code!</p>
          </div>
        </div>
        <!-- ./profile brief -->

        <!-- friend requests -->

        <div class="panel panel-default">
          <div class="panel-body">
            <h4>friend requests</h4>
            <?php
              $sql = "SELECT * FROM solicitaamizade where fk_nickname = 'bia'";
              $result = mysqli_query($link, $sql);
              if ($result) {
             ?><ul><?php
              while($solicit_user = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
                <li>
                  <a href="#"><?php echo $solicit_user['fk_nicknameSolicitaAmizade']; ?></a> 
                  <br>
                  <a class="text-success" href="#">[accept]</a> 
                  <a class="text-danger" href="#">[decline]</a>
                </li>
              <?php
              } 
              ?></ul><?php
            } else {
              ?>
                <p class="text-center">No users to add!</p>
              <?php
            }
          ?>
          </div>
        </div>
        <!-- ./friend requests -->
      </div>
      <div class="col-md-6">
        <!-- post form -->
        <form method="post" action="-create-post.php">
          <div class="input-group">
            <input class="form-control" type="text" name="content" placeholder="Make a post...">
            <span class="input-group-btn">
              <button class="btn btn-success" type="submit" name="post">Post</button>
            </span>
          </div>
        </form><hr>
        <!-- ./post form -->

        <!-- feed -->
        <div>
          <!-- post -->
          <?php
          $nickname = $_SESSION['feed']; 
          $sql1 = "SELECT idMural FROM mural WHERE fk_nickname = '$nickname' ";
          $result = mysqli_query($link, $sql1);
          $data = mysqli_fetch_array($result);
          $idFeed = $data['idMural'];

          $sql = " SELECT * FROM postagem JOIN mural ON (mural.idMural = postagem.fk_idMural) ";
          $sql.= " WHERE idMural = $idFeed";
          $result = mysqli_query($link, $sql);

          if ($result) {
            while($post = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              ?>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <p><?php echo $post['texto']; ?></p>
                  </div>
                  <div class="panel-footer">
                    <span>posted 2017-5-27 20:45:01 by <?php echo $post['nome']; ?></span> 
                    <span class="pull-right"><a class="text-danger" href="#">[delete]</a></span>
                  </div>
                </div>
          <?php
            }
          } else {
            ?>
              <p class="text-center">No posts yet!</p>
            <?php
          }
        ?>
          <!-- ./post -->
        </div>
        <!-- ./feed -->
      </div>
      <div class="col-md-3">
      <!-- add friend -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>add friend</h4>
            <?php
              //$nickname = $_SESSION['feedatual'];
              $sql = "SELECT nickname FROM pessoa";
              $result = mysqli_query($link, $sql);
              if ($result) {
             ?><ul><?php
              while($fc_user = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
                <li>
                  <a <?php echo 'href="home.php?nick='.$fc_user['nickname'].'';?>">
                    <?php echo $fc_user['nickname']; ?>
                  </a> 
                  <a <?php echo 'href="-solicitacion-friend.php?uid='.$fc_user['nickname'].''; ?>">[add]</a>
                </li>
              <?php
              }
              ?></ul><?php
            } else {
              ?>
                <p class="text-center">No users to add!</p>
              <?php
            }
          ?>
          </div>
        </div>
        <!-- ./add friend -->

        <!-- friends -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>friends</h4>
            <ul>
              <li>
                <a href="#">peterpan</a> 
                <a class="text-danger" href="#">[unfriend]</a>
              </li>
            </ul>
          </div>
        </div>
        <!-- ./friends -->
      </div>
    </div>
  </main>
  <!-- ./main -->

  <!-- footer -->
  <footer class="container text-center">
    <ul class="nav nav-pills pull-right">
      <li>FaceClone - Made by [your name here]</li>
    </ul>
  </footer>
  <!-- ./footer -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>