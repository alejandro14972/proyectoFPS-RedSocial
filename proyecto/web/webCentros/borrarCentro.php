<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';
    require_once '../../Entidades/clasesCentros/centro.php';
    require_once '../../Entidades/clasesCentros/centroRepositorio.php';

    session_start();

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la Tortuga. 
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

    $idCentroBorrar = $_GET["centro_borrar"]; // Se obtiene el ID del usuario que se quiere borrar

    $repositorioCentro = new centroRepositorio();

    $repositorioCentro->borrarCentroPorId($idCentroBorrar); // Se borra el usuario

    header("Location:./../administracionCentros.php"); // Se redirige a la tabla de usuarios para mostrarla sin el usuario borrado

?>