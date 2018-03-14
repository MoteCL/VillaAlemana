<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Villa Alemana</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
   
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="page">
   <nav class="navbar navbar-light bg-faded">
  <a class="navbar-brand" href="#">
    <img src="img/logo-main.png" class="img-thumbnail" alt="Foto">
    <h1>Ilustre Municipalidad Villa Alemana <?php echo date("Y"); ?></h1>
  </a>
  <div class="navbarr">
  <ul class="nav justify-content-end">
  <a href="login.php"><button class="btn btn-warning"><i class="fa fa-user" aria-hidden="true"></i> Intranet</button></a>
  </ul>
  </div>
</nav>
</div>
    <div class="container">  
        <div class="row">
            <div class="callout-bubble text-center fade-in-b col-md-auto">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="rounded mx-auto d-block" src="img/slide1.png" alt="Logo1">
      <h2>Municipalidad de  <b>Villa Alemana</b></h2>
                <p>Ley N° 20.285 – sobre acceso a la información pública. Decretos alcaldicios</p>
    </div>
    
    
  </div>
  
</div>
               
            </div>
        </div>
    </div>
    <div class="row">
        <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
            <div class="col-sm-offset-2 col-sm-8">

                <h3 class="text-center"> <small class="mensaje"></small></h3>
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
            <div class="table-responsive col-sm-12">
                <table id="dt_cliente" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>N° Decreto</th>
                            <th>Fecha</th>
                            <th>Materia</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
</div>
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

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <!--botones DataTables-->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.bootstrap.min.js"></script>
    <script>
        $(document).on("ready", function() {
            var anno = $select.val();
            listar(anno);
        });

        var $select = $("#id-select").change(function() {
            // esta funcion se ejecuta cuando se cambie el año
            var anno = $select.val(); // obtenemos el valor
            listar(anno); // cargamos la lista
        });
        // cargamos el año por defecto

        var listar = function(year) {
            var table = $("#dt_cliente").DataTable({
                "order": [
                    [0, "desc"]
                ],
                "destroy": true,
                "ajax": {
                    "method": "POST",
                    "url": "inc/listar.php?anno=" + year //Año
                },
                "columns": [{
                    "data": "decreto"
                }, {
                    "data": "anno"
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
                            return '<a href="ver.php?pdf=' + pdf + '" target="_blank"><img src="img/pdf-icon.png"> Ver decreto</a>'
                        }
                    }
                }],

                "language": idioma_espanol
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