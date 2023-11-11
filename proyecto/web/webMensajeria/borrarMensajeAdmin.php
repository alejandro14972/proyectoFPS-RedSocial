<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';
    require_once '../../Entidades/clasesMensajeria/mensajeria.php';
    require_once '../../Entidades/clasesMensajeria/mensajeriaRepositorio.php';

    session_start();

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la página pricipal. 
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

    $idMensajeBorrar = $_GET["mensaje_borrar"]; // Se obtiene el ID del usuario que se quiere borrar

    $repositorioMensajes = new MensajeriaRepositorio();

    $repositorioMensajes->borrarMensajePorId($idMensajeBorrar); // Se borra el usuario

    header("Location:./administracionMensajeria.php"); // Se redirige a la tabla de usuarios para mostrarla sin el usuario borrado

?>
