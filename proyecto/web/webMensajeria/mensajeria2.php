<?php
require_once('../../Entidades/UsuarioRepositorio.php');
require_once('../../Entidades/clasesMensajeria/mensajeriaRepositorio.php');
session_start();

////////
/////////////////////////////// Mensajeria para pasar correo por post
//////
$usuario = null;

/**
 * Si el usuario está logueado pero no es profesor, se redirige a la princiapl. 
 * Y si no está logueado, se redirige a la pantalla de login (index).
 */
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];

    /* if(!$usuario->esAdmin()) {
            header("Location:principal.php");    //no hace falta 
        } */
} else {
    header("Location:../../index.php");
}

//print_r($usuario);

$nuevoMensaje = new Mensajeria();
$repositorio = new MensajeriaRepositorio();

/**
 * Si se envía el formulario, se insertará el nuevo mensaje en la Base de Datos
 */
if (!empty($_POST)) {

    $nuevoMensaje->setDe(strip_tags(trim($_POST["emisor"])));
    $nuevoMensaje->setPara(strip_tags(trim($_POST["receptor"])));
    $nuevoMensaje->setAsunto(strip_tags(trim($_POST["asunto"])));
    $nuevoMensaje->setmensaje(strip_tags(trim($_POST["mensaje"])));

    $repositorio->insertarMensaje($nuevoMensaje);
?>
    <script>
        alert("Mensaje enviado con exito");
        window.location.href = "mensajeria2.php";
    </script>
<?php
    //header("Location:./mensajeria2.php"); //una vez insertado redireccionamos a la tabla usuario
}

?>

<!DOCTYPE html>
<html lang="es-es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docencia Online | Mensajeria</title>
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
                <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
                <p class="text-right" id="correo"><?= $usuario->getCorreo() ?></p>
                <p class="text-right"><a href="../principal.php">Volver </a><i class="fa fa-reply" aria-hidden="true"></i></p>
                <p class="text-right"><a href="../webUsuarios/logout.php">Cerrar Sesión </a><i class="fa fa-window-close" aria-hidden="true"></i></p>
            </div>
        </header>



        <h2>Mensajería</h2>
        <hr>

        <div class="row justify-content-between">
            <input type="button" id="boton1" class="btn btn-success col-3" value="Recibidos" onclick="verMensajes()">
            <input type="button" id="boton2" class="btn btn-primary col-3" value="Enviados" onclick="verMensajesEnviados()">
            <input type="button" id="boton3" class="btn btn-warning col-3" value="Nuevo Mensaje" onclick="nuevoMensaje()">
        </div>


        <table class="table table-striped text-center table-responsive table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th id="idCambio">id</th>
                    <th id="enviadoCambio">Enviado por:</th>
                    <th id="asuntoCambio">Asunto</th>
                    <th id="mensajeCambio">Mensaje</th>
                    <th id="verCambio">Ver</th>
                    <th id="borrarCambio">Borrar</th>
                </tr>
            </thead>
            <tbody id="mostrar" class="col-5">


            </tbody>
        </table>

        <div id="mensajeId">

        </div>


        <div id="formulario">

        </div>



    </div>


    <!--  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>

<script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

<script src="./scriptAjaxMensajeria/scriptMensajeria.js"></script>

</html>