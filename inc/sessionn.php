<?php
   include 'conexion.php';
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $user_name = $_SESSION['nombre'];
   $user_type = $_SESSION['tipo'];
   
   $ses_sql = mysqli_query($conexion,"SELECT usuario_id from user where usuario_id = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $user_name;
   
   if($user_type=="usuario"){
      //Menu
 
   }else{
      session_destroy();
       header("location:login.php");
   }
   
?>