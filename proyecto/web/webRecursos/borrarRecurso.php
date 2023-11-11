<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';
    require_once '../../Entidades/clasesRecursos/recursos.php';
    require_once '../../Entidades/clasesRecursos/recursosRepositorio.php';

    session_start();

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la página pricipal. 
     * Y si no está logueado, se redirige a la pantalla de login (index).
     */
    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } 
    else {
        header("Location:../index.php");
    }

    $idRecursoBorrar = $_GET["recurso_borrar"]; // Se obtiene el ID del usuario que se quiere borrar

    $repositorioMensajes = new RecursosRepositorio();

    $repositorioMensajes->borrarRecursoPorId($idRecursoBorrar); // Se borra el usuario

    header("Location:./recursos2.php"); // Se redirige a la tabla de usuarios para mostrarla sin el usuario borrado

?>