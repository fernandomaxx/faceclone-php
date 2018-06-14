<?php
  require_once('db.class.php');  
  session_start();
  $objDb = new db();
  $link = $objDb->conecta_mysql();

  if(!isset($_SESSION['email'])){
    header('Location: index.php?erro=1');
  }

  $_SESSION['namegroup'] = $_GET['namegroup'];
  echo $_SESSION['namegroup'];
  $_SESSION['user_validated'] = $_SESSION['nickname'];
  echo $_SESSION['user_validated'];
  $_SESSION['email_validated'] = $_SESSION['email'];
  $autorized = "true";
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
        <div class="navbar-brand">
        <img src="img/faceLogo.png" style="width: 160px; height: 50px; margin-top:-15px;">
        </div>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register-group.php">Edit group</a></li>
        <li><a href="group.php">Group</a></li>
        <li><a <?php echo 'href="home.php?nick='.$_SESSION['user_validated'].'"';?>>Home</a></li>
        <li><a href="profile.html">Profile</a></li>
        <li><a href="php/logout.php">Logout</a></li>
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

        <!-- groups -->

        <div class="panel panel-default">
          <div class="panel-body">
            <h4>groups</h4>
            <?php
              $aux = $_SESSION['user_validated'];
              $sql = "SELECT * FROM administragrupo where fk_nicknameAdm = '$aux' ORDER BY fk_nicknameAdm";
              $result = mysqli_query($link, $sql);
              if ($result) {
             ?><ul><?php
              while($idgroup = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $sql = "SELECT nomeGrupo FROM grupo where idGrupo = ".$idgroup['fk_idGrupo'];
                $resultname = mysqli_query($link, $sql);
                $namegroup = mysqli_fetch_array($resultname, MYSQLI_ASSOC);
              ?>
                <li>
                  <a <?php echo 'href="group.php?namegroup='.$namegroup['nomeGrupo'].'"';?>><?php echo $namegroup['nomeGrupo']; ?> (admin) </a> 
                  <br>
                  <!--a class="text-success" <?php echo 'href="php/add-friend.php?nick='.$namegroup['nomeGrupo'].'&log=accept"'; ?>>[accept]</a> 
                  <a class="text-danger" <?php echo 'href="php/add-friend.php?nick='.$namegroup['nomeGrupo'].'&log=decline"'; ?>>[decline]</a-->
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
        <!-- ./groups -->
      </div>
      <div class="col-md-6">
        <!-- post form -->

        <form method="post" action="php/create-group-post.php">
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
          $nickname = $_SESSION['namegroup']; 
          $sql = " SELECT idGrupo FROM grupo WHERE nomeGrupo = '$nickname'";
          $link = $objDb->conecta_mysql();
          $result = mysqli_query($link, $sql);
          $data = mysqli_fetch_array($result);
          $idgroup = $data['idGrupo'];
          $sql1 = "SELECT idMural FROM mural WHERE fk_idGrupo = '$idgroup' ";
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
      <!-- add group -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>add group</h4>
            <?php
              //$nickname = $_SESSION['feedatual'];
              $sql = "SELECT nomeGrupo FROM grupo ORDER BY nomeGrupo";
              $result = mysqli_query($link, $sql);
              if ($result) {
             ?><ul><?php
              while($fc_user = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
                <li>
                  <a <?php echo 'href="home.php?nick='.$fc_user['nomeGrupo'].'';?>">
                    <?php echo $fc_user['nomeGrupo']; ?>
                  </a> 
                  <a <?php echo 'href="php/solicitacion-group.php?uid='.$fc_user['nomeGrupo'].''; ?>">[add]</a>
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
        <!-- ./add group -->

        <!-- friends -->
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>friends</h4>
            <?php
              $namegroup = $_SESSION['namegroup'];
              $sql = "SELECT idGrupo FROM grupo WHERE nomeGrupo = '$namegroup'";
              $result = mysqli_query($link, $sql);
              $idgroup = mysqli_fetch_array($result, MYSQLI_ASSOC);
              if ($result) {
             ?><ul><?php
              $sql = "SELECT fk_nicknameAdm FROM administragrupo WHERE fk_idGrupo =".$idgroup['idGrupo'];
              $result = mysqli_query($link, $sql);

              while($nicknameAdm = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
                <li>
                  <a <?php echo 'href="home.php?nick='.$nicknameAdm['fk_nicknameAdm'].'';?>">
                    <?php echo $nicknameAdm['fk_nicknameAdm']; ?>
                  </a>  
                  <a class="text-info" href="#">[adm]</a>
                </li>
              <?php
              }
              ?>
              <?php
              $sql = "SELECT fk_nickname FROM participagrupo WHERE fk_idGrupo =".$idgroup['idGrupo'];
              $result = mysqli_query($link, $sql);
              while($nickname = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
                <li>
                  <a <?php echo 'href="home.php?nick='.$nickname['fk_nickname'].'';?>">
                    <?php echo $nickname['fk_nickname']; ?>
                  </a>  
                  <a class="text-danger" href="#">[unfriend]</a>
                </li>
              <?php
              }
              ?>
              </ul><?php
            } else {
              ?>
                <p class="text-center">No users to add!</p>
              <?php
            }
          ?>
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