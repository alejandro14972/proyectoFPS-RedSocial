<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';

    session_start();

    $usuario = null;

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la pagina princiapl
     * Y si no está logueado, se redirige a la pantalla de login (index).
     */
    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];

        if(!$usuario->esAdmin()) {
            header("Location:../principal.php");
        }
    } 
    else {
        header("Location:../../index.php");
    }

    $nuevoUsuario = new Usuario();
    $repositorio = new UsuarioRepositorio();

    /**
     * Si se envía el formulario, se insertará el nuevo usuario en la Base de Datos
     */
    if(!empty($_POST)) {
        $nuevoUsuario->setNombre($_POST["nombre"]);
        $nuevoUsuario->setnombrecompleto($_POST["nombrecompleto"]);
        $nuevoUsuario->setClave($_POST["clave"]);
        $nuevoUsuario->setDescripcion($_POST["descripcion"]);
        $nuevoUsuario->setCorreo($_POST["correo"]);
        $nuevoUsuario->setTelefono($_POST["telefono"]);
        $nuevoUsuario->setRol($_POST["rol"]);
        $nuevoUsuario->setSexo($_POST["sexo"]);


        if ($_POST["activo"] == 1) { //SOLUCIONAR ESTO YA
            $nuevoUsuario->setActivo(TRUE);
        } else {
            $nuevoUsuario->setActivo(FALSE);
        }
        
        
        $nuevoUsuario->setCentro($_POST["centro"]);

        $repositorio->insertarUsuario($nuevoUsuario);
        header("Location:./usuarios.php"); //una vez insertado redireccionamos a la tabla usuario
    }
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIO | Nuevo Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="container" id="cuerpo">
    <header class="row mb-3">
        <div class="col-3 mt-1">
            <img src="./../css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid" >
        </div>    

        <div class="col-9 mt-4">
        <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
    <p class="text-right"><a href="../principal.php">Volver a Home </a><i class="fa fa-home" aria-hidden="true"></i></p>
    <p class="text-right"><a href="usuarios.php">Volver a Usuarios </a><i class="fa fa-reply" aria-hidden="true"></i></p>
    <p class="text-right"><a href="logout.php">Cerrar Sesión </a><i class='fa fa-window-close' aria-hidden='true'></i></p>
        </div>
    </header>

    
    
    <h2 id="enunciado">Añadir Usuario</h2>
    <hr>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="mb-3">

        <div class="form-group">
            <label for="exampleFormControlInput1">Introduzca los siguientes datos:</label>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" required><br>
            <input type="text" class="form-control" id="" placeholder="nombrecompleto usuario" name="nombrecompleto" required><br>
            <input type="password" class="form-control" id="" placeholder="Contraseña" name="clave" required><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" required><br>
           <!--  <input type="text" class="form-control" id="" placeholder="centro" name="centro"><br> -->
           <input type="text" class="form-control" id="" placeholder="Correo" name="correo" required><br>
           <input type="text" class="form-control" id="" placeholder="Telefono" name="telefono" required><br>

            <select id="cars" name="centro">
      
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione un rol de usuario:</label>
            <select class="form-control" id="exampleFormControlSelect1" name="sexo">
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione un rol de usuario:</label>
            <select class="form-control" id="exampleFormControlSelect1" name="rol">
                <option value="docente">Docente</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione si estará activo o no:</label>
            <select class="form-control" id="exampleFormControlSelect1" name="activo">
                <option value="1">Activo</option>
                <option value="0">No Activo</option>
            </select>
        </div>

        <input id='boton' type='submit' value='Añadir Usuario' name ='boton'> 

    </form>


    <script>
       $(document).ready(function(){
    
    $.post("./../../scripts/jqueryProyecto/recuperacionCentros.php", function(objec) {

    console.log(objec);

    for (let i = 0; i < objec.length; i++) {
            var n = $("<option></option>").addClass("centro").text(objec[i]).val(objec[i]).attr("id", objec[i]);;
           console.log(n);
            $("#cars").append(n);
        }

    });
});
    </script>

<script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

<script>
    //validaciones meter aqui script o ruta 
</script>
    

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->

</body>

</html>
