<?php include( 'include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
    <title>Oficina Municipal de Intermediación laboral</title>
   

</head>
<body>

<?php 


				header('Content-Description: File Transfer');
 				header("Content-type: application/pdf");
 				readfile('file/'.$_GET['pdf']);
 
 
 ?>
 

</body>
</html>