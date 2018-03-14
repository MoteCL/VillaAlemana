<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Villa Alemana</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

</head>

<body>
    <div class="row fondo">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="text-center text-uppercase">Ilustre Municipalidad de Villa Alemana</h1>
        </div>
    </div>
   <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Bienvenido </h1>
            <div class="account-wall">
                <img class="profile-img" src="img/login.png"
                    alt="">
                <form method="post" name="submit" class="form-signin">
                <input type="text"  name="usuario" class="form-control" placeholder="Email" required autofocus>
                <input type="password" name="pwd" class="form-control" placeholder="Contraseña" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Ingresar</button>
                
              
                </form>
            </div>
            
        </div>
    </div>
</div>
<?php
include 'inc/conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
  $myusername = mysqli_real_escape_string($conexion, $_POST['usuario']);
  $mypassword = mysqli_real_escape_string($conexion, $_POST['pwd']);
  $sql = "SELECT * FROM user WHERE usuario_id = '$myusername'";
  $result = mysqli_query($conexion, $sql);
  $count = mysqli_num_rows($result);
  if ($count < 1)
    {
    header("Location: login.php?error");
    exit();
    }
    else
    {
    if ($row = mysqli_fetch_assoc($result))
      {
      $hashedPwd = password_verify($mypassword, $row['pwd']);
      if ($hashedPwd == false)
        {
        header("Location: login.php?error");
        exit();
        }
      elseif ($hashedPwd == true)
        {
        if($row['tipo']=="usuario"){
        $_SESSION['login_user'] = $myusername;
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['tipo'] = $row['tipo'];
        header("Location: menu.php");
        }else if($row['tipo']=="usuario2") {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['tipo'] = $row['tipo'];
        header("Location: menu2.php");
        }else if ($row['tipo']=="admin") {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['tipo'] = $row['tipo'];
        header("Location: admin.php");
        }
        }
      }
    }
  }

?>

<div class="col-sm-offset-2 col-sm-8">
                <h3 class="text-center"> <small class="mensaje"></small></h3>
            </div>
    
    <!-- Footer -->
    <footer class="bg-faded text-center py-5">

        <div class="container">

       
        <ul class="list-inline text-center ">
            <li>
                <a href="https://www.facebook.com/MunicipalidadVillaAlemana/" target="_blank"> <i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
            </li>
            <li>
                <a href="https://twitter.com/@munivillalemana" target="_blank"> <i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
            </li>
            <li> <a href="https://www.youtube.com/user/TheIMVA/" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i> Youtube</a>
            </li>
            <li> <a href="https://www.flickr.com/photos/munivillalemana/" target="_blank"><i class="fa fa-flickr" aria-hidden="true"></i> Flickr</a>
            </li>
        </ul>
        </div>

    </footer>
    <!-- Bootstrap core JavaScript -->

    <script src="js/jquery-1.12.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <!--botones DataTables-->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.bootstrap.min.js"></script>


</body>

</html>