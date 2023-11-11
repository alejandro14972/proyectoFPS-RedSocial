<?php
require_once('../../Entidades/UsuarioRepositorio.php');
require_once('../../Entidades/clasesRecursos/recursosRepositorio.php');
session_start();

$usuario = null;

$directorio = "./../../../../../ficheros_subidos";
$i = scandir($directorio);

//print_r($i);

/**
 * Si el usuario está logueado pero no es profesor, se redirige a la princiapl. 
 * Y si no está logueado, se redirige a la pantalla de login (index).
 */

$nuevoRecurso = new Recursos;
$repositorio = new RecursosRepositorio();

///subir recurso a carpta recursos
if (isset($_FILES['archivo'])) {
    $origen = $_FILES['archivo']["tmp_name"];
    $aux2 = $_FILES['archivo']['name']; //esta variable me almacena el nombre del recurso 
    $destino = "./../../../../../ficheros_subidos/" . $_FILES['archivo']['name'];
    move_uploaded_file($origen, $destino);
}

/**
 * Si se envía el formulario, se insertará el nuevo mensaje en la Base de Datos
 */
if (!empty($_POST)) {

    $nuevoRecurso->setSubido(strip_tags(trim($_POST["emisor"])));
    $nuevoRecurso->setnombreRecurso(strip_tags(trim($_POST["nombre"])));
    $nuevoRecurso->setDescripcion(strip_tags(trim($_POST["descripcion"])));
    $nuevoRecurso->setPrivacidad(strip_tags(trim($_POST["privacidad"])));
    $nuevoRecurso->setRecurso($aux2);

    $repositorio->insertarRecurso($nuevoRecurso);
}
?>

<!DOCTYPE html>
<html lang="es-es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docencia Online | Recursos</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <header class="row">
            <div class="col-3 mt-1">
                <img src="./../css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid">
            </div>

            <div class="col-9 mt-4">
                <p class="text-right"><i>Usuario invitado: </i><i class="text-right" id="correo"></i></p>
                <p class="text-right"><a href="../webUsuarios/logout.php">Cerrar Sesión </a><i class="fa fa-window-close" aria-hidden="true"></i></p>
            </div>
        </header>

        <h2>Recursos públicos</h2>
        <hr>
        <table class=" table1 table table-striped text-center mt-3 table-responsive table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nº</th>
                    <th>Subido por:</th>
                    <th>Nombre asignado</th>
                    <th>Descripción</th>
                    <th>Nombre fichero</th>
                    <th>Privacidad</th>
                    <th>Descargar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    //print_r($repositorio->getRecursos())
                    ?>
                    <?php foreach ($repositorio->getRecursos() as $noticia) : ?>
                        <?php
                        if ($noticia->getPrivacidad() == "publico") {
                        ?>
                            <td><?= $noticia->getId() ?></td>
                            <td><?= $noticia->getSubido() ?></td>
                            <td><?= $noticia->getnombreRecurso() ?></td>
                            <td><?= $noticia->getDescripcion() ?></td>
                            <td><?= $noticia->getRecurso() ?></td>
                            <td><?= $noticia->getPrivacidad() ?></td>
                            <td><a href='/ficheros_subidos/<? echo $noticia->getRecurso() ?>' download='<? echo $noticia->getnombreRecurso() ?>'><i class='fa fa-cloud-download text-warning' aria-hidden='true'></i></a></td>
                </tr>
            <?php
                        }
            ?>
        <?php endforeach; ?>
            </tbody>

    </div>


    <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

    <script>
        $(document).ready(function() {
            var data = sessionStorage.getItem('key');
            console.log("usuario: "+data);
            $("#correo").text(data)
        });
    </script>




    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>


</html>