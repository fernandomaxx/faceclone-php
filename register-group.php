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
        <li><a href="group.php">Group</a></li>
        <li><a href="home.php">Home</a></li>
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

        <!-- friend requests -->

        <div class="panel panel-default">
          <div class="panel-body">
            <h4>friend requests</h4>
            <?php
              $aux = $_SESSION['user_validated'];
              $sql = "SELECT * FROM administragrupo where fk_nicknameAdm = '$aux' ORDER BY fk_nicknameAdm";
              $result = mysqli_query($link, $sql);
              if ($result) {
             ?><ul><?php
              while($solicit_user = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $sql = "SELECT * FROM solicitagrupo where fk_idGrupo = ".$solicit_user['fk_idGrupo'];
                $result1 = mysqli_query($link, $sql);
                while ($data_user = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                  $sql = "SELECT * FROM grupo where idGrupo = ".$data_user['fk_idGrupo'];
                  $result2 = mysqli_query($link, $sql);
                  $data_group = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                  ?>
                <li>
                  <a href="#"><?php echo $data_user['fk_nickname']; echo " (".$data_group['nomeGrupo'].")"?></a> 
                  <br>
                  <a class="text-success" <?php echo 'href="php/add-group.php?nick='.$data_user['fk_nickname'].'&email='.$data_user['fk_email'].'&idgroup='.$data_user['fk_idGrupo'].'&log=accept"'; ?>>[accept]</a> 
                  <a class="text-danger" <?php echo 'href="php/add-group.php?nick='.$data_user['fk_nickname'].'&email='.$data_user['fk_email'].'&idgroup='.$data_user['fk_idGrupo'].'&log=decline"'; ?>>[decline]</a>
                </li>
              <?php
                }
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
      </dir>
    </div>

    <div class="row">
      <div class="col-md-6">
           <form method="post" action="php/create-group.php">

          <div class="form-group">
            <input class="form-control" type="text" name="groupname" placeholder="Groupname">
          </div>

          <div class="form-group">
            <input class="form-control" type="text" name="description" placeholder="Description">
          </div>

          <div class="radio">
              
              <label>
                <input type="radio" id="privacy" name ="privacy" value="1"> Public
              </label> 

              <label>
                <input type="radio" id="privacy" name ="privacy" value="0"> Private
              </label> 
              
          </div>

          <div class="form-group">
            <input class="btn btn-success" type="submit" name="create" value="Create">
          </div>
        </form>
      </div>
    </div>
  </main>
  <!-- ./main -->

  <!-- footer -->
  <!--footer class="container text-center">
    <ul class="nav nav-pills pull-right">
      <li>FaceClone - Made by [your name here]</li>
    </ul>
  </footer-->
  <!-- ./footer -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>