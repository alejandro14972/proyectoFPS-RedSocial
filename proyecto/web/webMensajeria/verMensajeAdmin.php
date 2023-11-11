<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';
    require_once '../../Entidades/clasesMensajeria/mensajeria.php';
    require_once '../../Entidades/clasesMensajeria/mensajeriaRepositorio.php';

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

    $idMensaje = $_GET["mensaje_ver"]; // Se obtiene el ID del usuario para modificar
    $repositorio = new MensajeriaRepositorio();
    $centroModificar = $repositorio->getMensajePorId($idMensaje); // Se obtiene el Usuario a modificar según su ID

    //print_r($centroModificar);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDICION CENTRO | DOCENCIA ONLINE</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="container">
    <header class="row">
        <div class="col-12">
            <h1 class="text-center text-light bg-info p-2 pb-3 mt-3">DATOS MENSAJE</h1>
            <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
        </div>    
    </header>

    <p class="text-right"><a href="../principal.php">Volver a Home </a><i class="fa fa-reply" aria-hidden="true"></i></p>
    <p class="text-right"><a href="./administracionMensajeria.php">Volver a administracion de mensajes </a><i class="fa fa-paper-plane-o" aria-hidden="true"></i></p>
    <p class="text-right"><a href="../logout.php">Cerrar Sesión </a><i class="fa fa-window-close" aria-hidden="true"></i></p>
    
    <h2>Datos Mensaje</h2>
    <hr>

    <form action="<?= $_SERVER['PHP_SELF'].'?centro_modificar='.$idMensaje; ?>" method="post">

        <div class="form-group">
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $centroModificar->getDe() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Contraseña" name="ubicacion" value="<?= $centroModificar->getPara() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $centroModificar->getAsunto() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $centroModificar->getMensaje() ?>"><br>
        </div>

    </form>

  
        <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>
 

    <script>
       $(document).ready(function () {
        $("input").attr("disabled", true);
        });
        
    </script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>

</html>