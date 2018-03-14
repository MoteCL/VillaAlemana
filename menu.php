<?php include( 'inc/sessionn.php'); ?>
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
    <ul class="nav nav-tabs justify-content-end">
        <li class="nav-item active">
            <a class="nav-link " href="menu.php"><i class="fa fa-home" aria-hidden="true"></i>
 Incio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="inc/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
 Cerra Seccion</a>
        </li>

    </ul>
    <div class="row">
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventana de edición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form action="" method="post" name="submit"> 
      <div class="modal-body">
         <input type="hidden" name="new_decreto_id" id="new_decreto_id" >
         <div class="form-group">
            <label for="new_decreto" class="col-form-label">N° decreto:</label>
            <input type="text" class="form-control" id="new_decreto" name="new_decreto">
          </div>

          <div class="form-group">
              <label for="new_fecha" class="form-control-label">Fecha:</label> 
            <input type="date" class="form-control" id="new_fecha" name="new_fecha">
          </div>
          <div class="form-group">
            <label for="new_materia" class="col-form-label">Materia:</label>
            <textarea class="form-control" id="new_materia" name="new_materia" rows="4"></textarea>
          </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
         <button type="submit" class="btn btn-success" name="update" method="post"><i class="fa fa-pencil" aria-hidden="true"></i>
   Editar</button>
      </div>
  </form>
    </div>

  </div>
</div>
   
 <?php

if (isset($_POST['update'])) {
    $decreto_id = mysqli_real_escape_string($conexion, $_POST['new_decreto_id']);
    $decreto = mysqli_real_escape_string($conexion, $_POST['new_decreto']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['new_fecha']);
    $materia = mysqli_real_escape_string($conexion, $_POST['new_materia']);
    $fecha=strtotime($fecha);
    $anno=date('Y',$fecha);
    $fecha=date('Y-m-d',$fecha);
    $decreto_id =$anno.$decreto;
    if (!empty($decreto) || !empty($fecha) || !empty($materia))
        {
        $sql = "UPDATE decreto SET decreto='$decreto', anno='$fecha', materia='$materia' WHERE decreto_id='$decreto_id'";
        $result = mysqli_query($conexion, $sql);
        if ($result) {?>
    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-success" role="alert">
                <strong>Bien! decreto n° <?php echo $decreto." del año ".$anno; ?> actualizado exitosamente</strong>
            </div>
        </div>
    </div>
    <?php 
            
        }

        }
        else 
        {
             ?>
    <div class="mensaje" id="mensaje">
        <div class="text-center">
            <div class="alert alert-danger" role="alert">
                <strong>Error campos vacios</strong>
            </div>
        </div>
    </div>
    <?php 
        }
    }
  ?>
    <div class="row">
        <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
            <div class="col-sm-offset-2 col-sm-8">
                <h3 class="text-center"> <small class="mensaje"></small></h3>
            </div>
            <div class="table-responsive col-sm-12">
                <table id="dt_cliente" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>N°</th>
                            <th>Fecha</th>
                            <th>Materia</th>
                            <th>PDF</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
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
        window.location = "menu.php";
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
                [0, "desc"],
                [1, "desc"]
            ],
            "destroy": true,
            "ajax": {
                "method": "POST",
                "url": "inc/listar.php?anno=" + year //Año
            },
            "columns": [{
                "data": "fecha"
            }, {
                "data": "decreto"
            }, {
                "data": "anno"
            }, {
                "data": "materia",
                "searchable": false,
                "sortable": false
            }, {
                "data": "pdf",
                "searchable": false,
                "sortable": false,
                "render": function(pdf) {
                    if (!pdf) {
                        return "";
                    } else {
                        return '<a href="ver.php?pdf=' + pdf + '" target="_blank"><img src="img/pdf-icon.png"> Ver decreto</a>'
                    }
                }
            }, {
                "searchable": false,
                "sortable": false,
                "defaultContent": "<button type='button' class='editar btn btn-success' data-toggle='modal' data-target='#myModal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Editar </button>"
            }],

            "language": idioma_espanol
        });
        obtener_data("#dt_cliente tbody", table);
    }
    var obtener_data = function(tbody, table) {
        $(tbody).on("click", "button.editar", function() {
            $('#update').prop('disabled', false);
            var data = table.row($(this).parents("tr")).data();
            var id = $("#new_decreto_id").val(data.decreto_id),
                idd = $("#new_decreto").val(data.decreto),
                fecha = $("#new_fecha").val(data.anno),
                materia = $("#new_materia").val(data.materia);
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

</body>

</html>