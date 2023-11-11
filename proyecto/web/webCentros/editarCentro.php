<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';
    require_once '../../Entidades/clasesCentros/centro.php';
    require_once '../../Entidades/clasesCentros/centroRepositorio.php';

    session_start();

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la tortuga. 
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

    $idCentroModificar = $_GET["centro_modificar"]; // Se obtiene el ID del usuario para modificar
    $repositorio = new centroRepositorio();
    $centroModificar = $repositorio->getCentroPorId($idCentroModificar); // Se obtiene el Usuario a modificar según su ID

    //print_r($centroModificar);


    /**
     * Si se envía el formulario, se insertarán los nuevos datos del usuario en la Base de Datos
     */
    if(!empty($_POST)) {
        $centroModificar->setNombre($_POST["nombre"]);
        
        $centroModificar->setDescripcion($_POST["descripcion"]);
       
        $centroModificar->setUbicacion($_POST["ubicacion"]);

        $repositorio->modificarCentro($centroModificar);

        header("Location:./../administracionCentros.php");
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDICION CENTRO | DOCENCIA ONLINE</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>

<body class="container">
    <header class="row">
        <div class="col-12">
            <h1 class="text-center text-light bg-info p-2 pb-3">EDICIÓN CENTROS</h1>
            <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
        </div>    
    </header>

    <p class="text-right"><a href="../principal.php">Volver a Home </a><i class="fa fa-home" aria-hidden="true"></i></p>
    <p class="text-right"><a href="../administracionCentros.php">Volver a centros adscritos </a><i class="fa fa-reply" aria-hidden="true"></i></p>
    <p class="text-right"><a href="../logout.php">Cerrar Sesión </a><i class='fa fa-window-close' aria-hidden='true'></i></p>
    
    <h2>Editar Centro</h2>
    <hr>

    <form action="<?= $_SERVER['PHP_SELF'].'?centro_modificar='.$idCentroModificar; ?>" method="post">

        <div class="form-group">
            <label for="exampleFormControlInput1">Datos para modificar:</label>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $centroModificar->getNombre() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Contraseña" name="ubicacion" value="<?= $centroModificar->getUbicacion() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $centroModificar->getDescripcion() ?>"><br>
        </div>
        <input id='boton' type='submit' value='Modificar Centro' name ='boton'> 

    </form>

    


    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>
<script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>


</html>
