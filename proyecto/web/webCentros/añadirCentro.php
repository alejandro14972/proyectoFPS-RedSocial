<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';
    require_once '../../Entidades/clasesCentros/centro.php';
    require_once '../../Entidades/clasesCentros/centroRepositorio.php';

    session_start();

    $usuario = null;

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la pagina princiapal. 
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

    $nuevoCentro = new Centro();
    $repositorio = new centroRepositorio();

    /**
     * Si se envía el formulario, se insertará el nuevo centro en la Base de Datos
     */
    if(!empty($_POST)) {
        $nuevoCentro->setNombre($_POST["nombre"]);
        $nuevoCentro->setDescripcion($_POST["descripcion"]);
        $nuevoCentro->setUbicacion($_POST["ubicacion"]);

        $repositorio->insertarCentro($nuevoCentro);

        header("Location:./../administracionCentros.php"); //una vez modicado regerasr a la vista de centros
    }
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIO | Nuevo Centro</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   
    <script src="./../js/jquery-3.5.1.js"></script>
</head>

<body class="container" id="cuerpo">
    <header class="row">
    <div class="col-3 mt-1">
            <img src="./../css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid" >
        </div>     

        <div class="col-9 mt-4">
        <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
    <p class="text-right"><a href="../principal.php">Volver a la página principal </a><i class="fa fa-home" aria-hidden="true"></i></p>
    <p class="text-right"><a href="./../administracionCentros.php">Volver a Centros </a><i class="fa fa-reply" aria-hidden="true"></i></p>
    <p class="text-right"><a href="./../logout.php">Cerrar Sesión </a><i class='fa fa-window-close' aria-hidden='true'></i></p>
        </div>
    </header>

    
    
    <h2>Añadir Centro</h2>
    <hr>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

        <div class="form-group">
            <label for="exampleFormControlInput1">Introduzca los siguientes datos del centro:</label>
            <input type="text" class="form-control" id="" placeholder="Nombre centro" name="nombre"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion"><br>
            <input type="text" class="form-control" id="" placeholder="Ubicación" name="ubicacion"><br> 
        </div>

        <input id='boton' type='submit' value='Añadir nuevo centro' name ='boton'> 

    </form>


    <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>
    

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->

</body>

</html>
