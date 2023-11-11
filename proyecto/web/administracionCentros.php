<?php 
    require_once('../Entidades/UsuarioRepositorio.php');
    require_once('../Entidades/clasesCentros/centroRepositorio.php');
    session_start();
    
    $usuario = null;

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la princiapl. 
     * Y si no está logueado, se redirige a la pantalla de login (index).
     */
    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];

        if(!$usuario->esAdmin()) {
            header("Location:principal.php");
        }
    } 
    else {
        header("Location:../index.php");
    }

    $repositorio = new centroRepositorio(); 
   // print_r($usuario); //mostrar datos del usuario 
?>

<!DOCTYPE html>
<html lang="es-es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docencia Online | Centros</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="./js/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <header class="row">
        <div class="col-3 mt-1">
            <img src="./css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid" >
        </div>        

        <div class="col-9 mt-4">
            <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
            <p class="text-right"><a href="principal.php">Volver </a><i class="fa fa-reply" aria-hidden="true"></i></p>
            <p class="text-right"><a href="./webCentros/añadirCentro.php">Añadir nuevo centro </a><i class="fa fa-university" aria-hidden="true"></i></p>
            <p class="text-right"><a href="logout.php">Cerrar Sesión </a><i class="fa fa-window-close" aria-hidden="true"></i></p>
        </div>
        </header>

      

        <h2>Centros adscritos</h2>
        <hr>
        
        <table class="table table-striped text-center mt-3 table-responsive contador">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Nombre Centro</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                     //print_r($repositorio->getCentros());
                    ?>
              
                <?php foreach ($repositorio->getCentros() as $centro): ?> 
                    <td><?= $centro->getId() ?></td>
                    <td><?= $centro->getNombre() ?></td>
                    <td><?= $centro->getDescripcion() ?></td>
                    <td><?= $centro->getUbicacion() ?></td>
                   
                    <td><a href="./webCentros/verCentro.php?centro_ver=<?= $centro->getId() ?>" class="view"><i class="fa fa-eye btn btn-primary"></i></a></td>
                    <td><a href="./webCentros/editarCentro.php?centro_modificar=<?= $centro->getId()?>" class="edit"><i class="fa fa-edit btn btn-success"></i></a></td>
                    <td> <a href="./webCentros/borrarCentro.php?centro_borrar=<?= $centro->getId() ?>" class="trash"><i class="fa fa-trash btn btn-danger"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>
    
    <!--database-->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
                    $('.contador').DataTable({
                            language: {
                                    "processing": "Procesando...",
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "zeroRecords": "No se encontraron resultados",
                                    "emptyTable": "Ningún dato disponible en esta tabla",
                                    "info": "Mostrando de item _START_ al _END_ de un total de  _TOTAL_ items",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "search": "Buscar:",
                                    "infoThousands": ",",
                                    "loadingRecords": "Cargando...",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    },
                                    "aria": {
                                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                                    }
                                }
                            });
                    });
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>


</html>