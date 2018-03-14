<?php include( 'inc/sessionadmin.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Villa Alemana</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilos.css">


</head>

<body>
    <div class="row fondo">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="text-center text-uppercase">Ilustre Municipalidad de Villa Alemana</h1>
        </div>
    </div>
    <ul class="nav nav-tabs justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>
 Incio</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link " href="adminuser.php"><i class="fa fa-users" aria-hidden="true"></i> 
 Administrar usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="inc/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
 Cerra Seccion</a>
        </li>

    </ul>
    <div class="col-sm-offset-2 col-sm-8">

        <h3 class="text-center"> <small class="mensaje"></small></h3>
    </div>
    <div class="container">
        <h3>Panel Usuarios</h3>
        <br>
        <button type="button" title="Ingresar nuevo usuario" class="editar btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-upload" aria-hidden="true"></i> Nuevo Usuario</button>
        <form action="" method="post" name="submit" class="form-signin">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ingresar usuario nuevo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                               <div class="form-group">
                                <label class="control-label">Usuario ID</label>
                                   <input type="text" name="usuario_id" class="form-control">
                               </div>
                               <div class="form-group">
                                <label class="control-label">Nombre</label>
                                   <input type="text" name="nombre" class="form-control">
                               </div>
                               <div class="form-group">
                                <label class="control-label">Password</label>
                                   <input type="password" name="pwd" class="form-control">
                               </div>
                                <label for="tipo"> Tipo </label> <br>
                                <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" name="tipo" class="custom-control-input" value="usuario">
  <label class="custom-control-label" for="customRadio1">Encargado de Digitadar decreto</label>
</div>
<div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" name="tipo" class="custom-control-input" value="usuario2">
  <label class="custom-control-label" for="customRadio2">Encargado de subir decreto</label>
</div>
                               
                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" name="ingresar" method="post"><i class="fa fa-upload" aria-hidden="true"></i> Ingresar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include 'inc/conexion.php';
if (isset($_POST['ingresar']))
    {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario_id']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $pwd = mysqli_real_escape_string($conexion, $_POST['pwd']);
    $tipo = mysqli_real_escape_string($conexion, $_POST['tipo']);
    if (!empty($user) || !empty($pwd))
        {
        $sql = "SELECT * FROM user WHERE usuario_id='$usuario'";
        $result = mysqli_query($conexion, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0)
            { ?><div class="text-center">
    <div class="alert alert-danger" role="alert">
        <strong>Usuario ID ya existe</strong>
    </div>
</div>
<?php
}
  else
    {
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (usuario_id,nombre,pwd,tipo) VALUES ('$usuario','$nombre','$hashedPwd','$tipo') ";
    $result = mysqli_query($conexion, $sql);
    if ($result)
        { ?><div class="text-center">
    <div class="alert alert-success" role="alert">
        <strong>Ingresado</strong>
    </div>
</div>
<?php } else { ?>
<div class="text-center">
    <div class="alert alert-danger" role="alert">
        <strong>ERROR CONEXION</strong>
    </div>
</div>
<?php } } }else{ ?>

<div class="text-center">
    <div class="alert alert-danger" role="alert">
        <p><strong>ERROR</strong> Campos Vacío</p>
    </div>
</div>


<?php } } ?>
    </form>
     <form action="" method="post" name="submitt" class="form-signin" ">
        <div class="modal fade" id="myModalthree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     <div class="modal-body">
                        <div class="form-group">
                                <label class="control-label">Usuario: </label>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                   <input type="hidden" name="usuario_idd" id="usuario_idd" class="form-control">
                               </div> 
                               <div class="form-group">
                                <label class="control-label">Contraseña nueva</label>
                                   <input type="password" name="pwd" class="form-control">
                               </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" name="change" method="post"><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php if (isset($_POST['change'])) {
         $usuario = mysqli_real_escape_string($conexion, $_POST['usuario_idd']);
         $pwd = mysqli_real_escape_string($conexion, $_POST['pwd']);
         if (!empty($pwd)) {
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET pwd='$hashedPwd' WHERE usuario_id = '$usuario'";
            $result = mysqli_query($conexion, $sql);
            if ($result)
                { ?>    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-success" role="alert">
                <strong>Contraseña cambiada exitosamente</strong> 
            </div>
        </div>
    </div>
    <?php } 
             
         }
         else
         {
            ?>
            <div class="text-center">
                <div class="alert alert-danger" role="alert">
                    <p><strong>ERROR</strong> Campos Vacío</p>
                </div>
            </div>
<?php 
         }
    } ?>
        <br>
        <form method="post" name="submit">
        <input type="hidden" name="usuario_id" id="usuario_id">
        <table id="dt_cliente" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Usuario ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
        </form>
        <?php
include 'inc/conexion.php';

if (isset($_POST['delete']))
    {
    $usuario_id = mysqli_real_escape_string($conexion, $_POST['usuario_id']);
        
    $sql = "DELETE FROM  user WHERE usuario_id='$usuario_id'";
    $result = mysqli_query($conexion, $sql);
    if ($result)

        { ?>
    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-danger" role="alert">
                <strong>Eliminado</strong> 
            </div>
        </div>
    </div>
    <?php } } ?>

        <div>


            <!-- Footer -->
            <footer class="bg-faded text-center py-5">
                <div class="container">

                    <div class="text-center">
                        <img src="img/footer.png" class="rounded">
                    </div>
                    <p class="m-0"> Dirección: Buenos Aires N° 850 • Teléfono: (+56) (032) 3251635</p>
                </div>
                <ul class="list-inline text-center">
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

            </footer>
            <!-- Bootstrap core JavaScript -->

            <script src="js/jquery-1.12.3.js"></script>
             <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          
            <script src="js/jquery.dataTables.min.js"></script>
            <script src="js/dataTables.bootstrap.js"></script>
            <!--botones DataTables-->
            <script src="js/dataTables.buttons.min.js"></script>
            <script src="js/buttons.bootstrap.min.js"></script>
            <script>
    $(document).on("ready", function() {

        listar();
        mostrar_mensaje();

    });
   var listar = function() {
            var table = $("#dt_cliente").DataTable({
                
                "destroy": true,
                "ajax": {
                    "method": "POST",
                    "url": "inc/user.php"
                },
                "columns": [
                {
                    "data": "usuario_id",
                    "searchable": false,
                    "sortable": false
                }, {
                    "data": "nombre",
                    "searchable": false,
                    "sortable": false
                }, {
                    "data": "tipo",
                    "render": function(tipo) {
                        if (tipo=="usuario") {
                            return 'Encargado de digitar';
                        } else if (tipo=="usuario2"){
                              return 'Encargado de subir decreto';
                        }else if(tipo=="admin") {
                                return 'Administrador';
                        }
                    }
                },{
                    "data": null,
      "defaultContent": "<button type='submit' title='Eliminar usuario' class='eliminar btn btn-danger' name='delete' method='post' ><i class='fa fa-trash-o' aria-hidden='true'></i>  </i></button> <button type='button' title='Cambiar contraseña' class='change btn btn-warning' data-toggle='modal' data-target='#myModalthree'  ><i class='fa fa-key' aria-hidden='true'></i>  </i></button>"

                }],

                "language": idioma_espanol
            });
        
            delete_data("#dt_cliente tbody", table);
            obtener_data("#dt_cliente tbody", table);


        }


    var delete_data = function(tbody, table) {
        $(tbody).on("click", "button.eliminar", function() {
            var data = table.row($(this).parents("tr")).data();
            var id = $("#usuario_id").val(data.usuario_id);

        });
    }
     var obtener_data = function(tbody, table) {
            $(tbody).on("click", "button.change", function() {
                var data = table.row($(this).parents("tr")).data();
                var idd = $("#usuario_idd").val(data.usuario_id),
                    nombre = $("#nombre").val(data.nombre);

            });
        }

    var mostrar_mensaje = function() {
        $(".mensaje").fadeOut(4000, function() {
            $(this).html("");
            $(this).fadeIn(1000);
        });
    }
     var idioma_espanol = {    
            "sProcessing":      "Procesando...",
                "sLengthMenu":      "Mostrar _MENU_ registros",
                "sZeroRecords":     "No se encontraron resultados",
                "sEmptyTable":      "Ningún dato disponible en esta tabla",
                "sInfo":            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":       "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":     "",
                "sSearch":          "Buscar:",
                "sUrl":             "",
                "sInfoThousands":   ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {        
                "sFirst":     "Primero",
                        "sLast":      "Último",
                        "sNext":      "Siguiente",
                        "sPrevious": "Anterior"    
            },
                "oAria": {        
                "sSortAscending":   ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"    
            }
        }
</script>

<script type="text/javascript">
    $('#myModal').modal(options)
</script>
</body>

</html>