<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';

    session_start();

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la página princiapl
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

    $idUsuarioBorrar = $_GET["usuario_borrar"]; // Se obtiene el ID del usuario que se quiere borrar

    $repositorio = new UsuarioRepositorio();

    $repositorio->borrarUsuarioPorId($idUsuarioBorrar); // Se borra el usuario

    header("Location:usuarios.php"); // Se redirige a la tabla de usuarios para mostrarla sin el usuario borrado

?>