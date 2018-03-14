  <?php
include 'conexion.php';

$decreto = mysqli_real_escape_string($conexion, $_POST['decreto']);
$fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
$materia = mysqli_real_escape_string($conexion, $_POST['materia']);
$decreto = preg_replace('[\s+]', '', $decreto);
$fecha = preg_replace('[\s+]', '', $fecha);

if ($fecha)
    {
    $fecha = strtotime($fecha);
    $anno = date('Y', $fecha);
    $fecha = date('Y-m-d', $fecha);
    $decreto_id = $anno . $decreto;
    }
  else
    {
    $fecha = "";
    $decreto_id = "";
    $anno = "";
    }

if ($decreto == "" || $fecha == "")
    {
    echo 2;
    }
  else
    {
    $sql = "SELECT * FROM decreto WHERE decreto_id='$decreto_id'";
    $result = mysqli_query($conexion, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0)
        {
        echo 0;
        }
      else
        {
        $sql = "INSERT INTO decreto (decreto_id,anno,materia,decreto,fecha) VALUES ('$decreto_id','$fecha','$materia','$decreto','$anno')";
        $result = mysqli_query($conexion, $sql);
        if ($result)
            { //Funciono
            echo 1;
            header("Refresh:0");
            exit();
            }
        }
    }