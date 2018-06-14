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
    </div>
  </nav>
  <!-- ./nav -->

  <!-- main -->
  <main class="container">
  <h1 class="text-center">Bem-Vindo ao FaCIbok!<br><small>O Facebook do CI</small></h1>

    <div class="row">
      <div class="col-md-6">
        <br><br>
        <img src="img/ciufpb.png" style="width: 469px; height: 323px; margin-top: -75px;" >
        <h4>Faça o login</h4>

        <!-- login form -->
        <form method="post" action="php/login.php">
          <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="Email">
          </div>

          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Senha">
          </div>

          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="login" value="Login">
          </div>
        </form>
        <!-- ./login form -->
      </div>
      <div class="col-md-6">
        <h4>Não tem Conta? Registre-se!</h4>

        <!-- register form -->
        <form method="post" action="php/register.php">

          <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Nome">
          </div>

          <div class="form-group">
            <input class="form-control" type="text" name="nickname" placeholder="Nickname">
          </div>

          <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email">
          </div>

          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Senha">
          </div>

          <div class="radio">
              
              <label>
                <input type="radio" id="sex" name ="sex" value="'M'"> Masculino
              </label> 

              <label>
                <input type="radio" id="sex" name ="sex" value="'F'"> Feminino
              </label> 
              
          </div>

          <div class="form-group">
            <input class="form-control" type="date" name="date" placeholder="Date">
          </div>

          <div class="form-group">
            <input class="btn btn-success" type="submit" name="register" value="Register">
          </div>
        </form>
        <!-- ./register form -->
      </div>
    </div>
  </main>
  <!-- ./main -->

  <!-- footer -->
  <footer class="container text-center">
    <ul class="nav nav-pills pull-right">
      <li></li>
    </ul>
  </footer>
  <!-- ./footer -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>