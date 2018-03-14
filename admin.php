<?php include( 'inc/sessionadmin.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Villa Alemana</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
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
    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item active">
            <a class="nav-link " href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>
 Incio</a>
        </li>
         <li class="nav-item">
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
     <div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12">
            <form action="" method="post" name="submit" class="form-horizontal">
                <div class="form-group">
                    <h3 class="col-sm-offset-2 col-sm-8 text-center">                   
                    Formulario de Registro para decretos alcaldicios nuevos </h3>
                </div>

                <div class="form-group">

                    <label for="deceto" class="col-sm-2 control-label">N° Decreto</label>
                    <div class="col-sm-1">
                        <input id="decreto" name="decreto" type="text" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-2">
                        <input id="fecha" name="fecha" type="date" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="materia" class="col-sm-2 control-label">Materia</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="materia" id="materia" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <input type="submit" name="save" id="save" class="btn btn-primary" value="Guardar" />
                    </div>
                   
                </div>
                <div>
                    <div class="mensaje" id="mensaje">
                    </div>
                </div>
            </form>
        </div>
     <div class="container">
               
                <div class="form-group col-sm-2">
                    <label for="id-select" class="col-form-label">Período</label>
                     <select id="id-select" name="id-select" class="form-control">
                              <?php
                            include 'inc/conexion.php';
                            $query = "SELECT DISTINCT (fecha) FROM decreto WHERE fecha IN (SELECT fecha FROM decreto GROUP BY fecha HAVING count( fecha ) >0) ORDER BY fecha DESC;";
                            $result = mysqli_query($conexion, $query);

                            while ($row = mysqli_fetch_assoc($result))
                                {
                            ?>
            <option value="<?php echo $row['fecha']; ?>"><?php echo $row['fecha']; ?></option>
                            <?php
                                }
                            ?>
                    </select>
                </div>
            </div>
    <form action="#" method="post" name="submit" class="form-signin" enctype="multipart/form-data">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar decreto alcaldicios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <label for="file" class="col col-form-label">Seguro?</label>
                            <div class="col-sm-8">
                            
                                <input type="hidden" name="decreto_post" id="decreto_post">
                                <input type="hidden" name="pdf_delete" id="pdf_delete">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning" name="delete" method="post"><i class="fa fa-upload" aria-hidden="true"></i> Eliminar Decreto</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
include 'inc/conexion.php';

if (isset($_POST['delete']))
	{
	$pdf_delete = mysqli_real_escape_string($conexion, $_POST['pdf_delete']);
	$post_id = mysqli_real_escape_string($conexion, $_POST['decreto_post']);
    $location = "file/";
    
    
	
	$sql = "DELETE FROM  decreto WHERE decreto_id = '$post_id'";
	$result = mysqli_query($conexion, $sql);
	if ($result)
        chdir($location);
    if ($pdf_delete) {
       unlink($pdf_delete);
    }

		{ ?>
    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-danger" role="alert">
                <strong>Decreto N° <?php echo $post_id ?></strong> Eliminado
            </div>
        </div>
    </div>
    <?php } } ?>
    <form action="" method="post" name="submitt" class="form-signin" enctype="multipart/form-data">
        <div class="modal fade" id="myModaltwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Subir decreto Alcaldicios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <label for="file" class="col col-form-label">PDF</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control-file" name="file" id="file" accept="application/pdf">
                                 <input type="hidden" name="fecha" id="fechaa">
                                <input type="hidden" name="decreto_id" id="decreto_idd">
                                <input type="hidden" name="decreto" id="decretoo">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" name="subir" method="post"><i class="fa fa-upload" aria-hidden="true"></i> Subir Decreto</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php


if (isset($_POST['subir']))
    {
    $decreto_id = mysqli_real_escape_string($conexion, $_POST['decreto_id']);
    $decreto = mysqli_real_escape_string($conexion, $_POST['decreto']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];
    $tipo = $_FILES['file']['type'];
    $location = 'file/';
    $maxsize = 9097152;
    $acceptable = array('application/pdf');
     $fecha=strtotime($fecha);
     $hoy=date('Y',$fecha);
   
    
    if (isset($name))
        {
        $name = $hoy . "ad" . $decreto . ".pdf";
        if (move_uploaded_file($temp_name, $location . $name))
            {
            $sql = "UPDATE decreto SET pdf='$name' WHERE decreto_id = '$decreto_id'";
            $result = mysqli_query($conexion, $sql);
            if ($result)
                { ?>    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-success" role="alert">
                <strong>PDF decreto N° <?php echo $decreto_id ?>Subido</strong> Exitosamente
            </div>
        </div>
    </div>
    <?php } }else { ?>
    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-danger" role="alert">
                <strong>Error</strong> Seleccione PDF
            </div>
        </div>
    </div>
    <?php } } } ?>
    <?php

if (isset($_POST['delete_pdf']))
    {
    $pdf_delete = mysqli_real_escape_string($conexion, $_POST['pdf_deletee']);
    $decreto_idd = mysqli_real_escape_string($conexion, $_POST['decreto_iddd']);
    $location = "file/";
    chdir($location);
    unlink($pdf_delete);
    $sql = "UPDATE decreto SET pdf=NULL WHERE decreto_id='$decreto_idd'";
    $result = mysqli_query($conexion, $sql);
    if ($result)
        { ?>
    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-danger" role="alert">
                <strong>Decreto N° <?php echo $decreto_idd ?></strong> Eliminado
            </div>
        </div>
    </div>
    <?php } } ?>
    <div class="row">
        <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
            <div class="col-sm-offset-2 col-sm-8">
                <h3 class="text-center"> <small class="mensaje"></small></h3>
            </div>
            <form method="post" name="submit">
                <input type="hidden" name="decreto_idd" id="decreto_idd">
                <input type="hidden" name="pdf_delete" id="pdf_delete">
                <input type="hidden" name="decreto_iddd" id="decreto_iddd">
                <input type="hidden" name="pdf_deletee" id="pdf_deletee">
                <div class="table-responsive col-sm-12">
                    <table id="dt_cliente" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr><th>Año</th>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Materia</th>
                                <th>PDF</th>
                                <th></th>
                                <th></th>
                                <thead></thead>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
        </div>

    </div>
    <div>
    </div>

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
    function redireccion() {
        window.location = "admin.php";
    }
    $(function() {
        $("#save").on('click', function(e) {
            e.preventDefault();
            var decreto = $('#decreto').val();
            var fecha = $('#fecha').val();
            var materia = $('#materia').val();
            $.ajax({
                type: "POST",
                url: "inc/guardar.php",
                data: ('decreto=' + decreto + '&fecha=' + fecha + '&materia=' + materia),
                success: function(respuesta) {
                    if (decreto == "" || materia == "" || fecha=="") {
                        $('#mensaje').html('<div class="text-center"><div class="alert alert-danger" role="alert"><strong>Verificar campos </strong></div></div>');
                    } else {
                        if (respuesta == 1) {
                           $('#mensaje').html('<div class="text-center"><div class="alert alert-success" role="alert"><strong>Decreto ingresado </strong> exitosamente</div></div>');
                            var temp = setTimeout(redireccion, 1900);
                            document.addEventListener("click", function() {
                                clearTimeout(temp);
                                temp = setTimeout(redireccion, 1900);
                            })
                        } else if (respuesta == 0) {
                            $('#mensaje').html('<div class="text-center"><div class="alert alert-danger" role="alert"><strong>Numero de decreto ya existente</strong></div></div>');
                            $('#decreto').val("");
                        }
                    }
                }
            })
        })
    })
</script>
    <script>
        $(document).on("ready", function() {
            var anno = $select.val();
            listar(anno);
            mostrar_mensaje();
        });

        var $select = $("#id-select").change(function() {
            // esta funcion se ejecuta cuando se cambie el año
            var anno = $select.val(); // obtenemos el valor
            listar(anno); // cargamos la lista
        });
        var listar = function(year) {
            var table = $("#dt_cliente").DataTable({
                "order": [
                    [0,"desc"],
                    [1,"desc"]
                ],
                "destroy": true,
                "ajax": {
                    "method": "POST",
                    "url": "inc/listar.php?anno=" + year //Año
                },
                "columns": [
                {
                    "data": "fecha",
                    "width" :"20px"
                }, {
                    "data": "decreto",
                    "width" :"45px"
                }, {
                    "data": "anno",
                    "width" :"40px"
                }, {
                    "data": "materia",
                "searchable": true,
                "sortable": false
                }, {
                    "data": "pdf",
                    "searchable": false,
                    "sortable": false,
                    "render": function(pdf) {
                        if (!pdf) {
                            return "";
                        } else {
                            return '<a href="ver.php?pdf=' + pdf + '" target="_blank"><img src="img/pdf-icon.png"> Ver decreto </a>'
                        }
                    }
                },
                {
                    "data": "pdf",
                    "searchable": false,
                    "sortable": false,
                    "render": function(pdf) {
                        if (!pdf) {
                            return '<button type="button" title="Subir PDF" class="editar btn btn-primary" data-toggle="modal" data-target="#myModaltwo"> <i class="fa fa-upload" aria-hidden="true"></i> Adjuntar</button>'
                        } else {
                            return '<button type="submit" title="Eliminar PDF" class="eliminarr btn btn-danger" name="delete_pdf" method="post" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Eliminar</i></button>';
                        }
                    }

                },{
                    "data": null,
                    "searchable": false,
                    "sortable": false,
      "defaultContent": "<button type='button' title='Eliminar' class='eliminar btn btn-danger' data-target='#myModal' name='delete' data-toggle='modal'   ><i class='fa fa-trash-o' aria-hidden='true'></i>  </i></button>"
                }],

                "language": idioma_espanol
            });
            obtener_data("#dt_cliente tbody", table);
            delete_post("#dt_cliente tbody", table);
            delete_pdf("#dt_cliente tbody", table);
        }

     
        var delete_post = function(tbody, table) {
            $(tbody).on("click", "button.eliminar", function() {
                var data = table.row($(this).parents("tr")).data();
                var id = $("#decreto_post").val(data.decreto_id),
                    pdff = $("#pdf_delete").val(data.pdf);
            });
        }
        var delete_pdf = function(tbody, table) {
            $(tbody).on("click", "button.eliminarr", function() {
                var data = table.row($(this).parents("tr")).data();
                var id = $("#decreto_iddd").val(data.decreto_id),
                    pdff = $("#pdf_deletee").val(data.pdf);
            });
        }
         var obtener_data = function(tbody, table) {
            $(tbody).on("click", "button.editar", function() {
                var data = table.row($(this).parents("tr")).data();
                var id = $("#decreto_idd").val(data.decreto_id),
                    idd = $("#decretoo").val(data.decreto),
                    fecha = $("#fechaa").val(data.anno);

            });
        }
        var mostrar_mensaje = function() {
            $(".mensaje").fadeOut(4000, function() {
                $(this).html("");
                $(this).fadeIn(3000);
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
        $('#myModaltwo').modal(options)
    </script>
</body>

</html>