<?php
    require_once '../../Entidades/Usuario.php';
    require_once '../../Entidades/UsuarioRepositorio.php';

    session_start();

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la tortuga. 
     * Y si no está logueado, se redirige a la pantalla de login (index).
     */
    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];

        /* if(!$usuario->esAdmin()) { //DESACTIVAR EN ALGUNOS CASOS
            header("Location:principal.php");
        } */
    } 
    else {
        header("Location:../index.php");
    }

    $idUsuarioModificar = $_GET["usuario_modificar"]; // Se obtiene el ID del usuario para modificar
    $repositorio = new UsuarioRepositorio();
    $usuarioModificar = $repositorio->getUsuarioPorId($idUsuarioModificar); // Se obtiene el Usuario a modificar según su ID

    //print_r($usuario);
    print_r($usuarioModificar);

    /**
     * Si se envía el formulario, se insertarán los nuevos datos del usuario en la Base de Datos
     */
    if(!empty($_POST)) {
        $usuarioModificar->setNombre($_POST["nombre"]);
        $usuarioModificar->setClave($_POST["clave"]);
        $usuarioModificar->setDescripcion($_POST["descripcion"]);
        $usuarioModificar->setRol($_POST["rol"]);
        $usuarioModificar->setActivo($_POST["activo"]);
        $usuarioModificar->setCentro($_POST["centro"]);
        $usuarioModificar->setCorreo($_POST["correo"]);
        $usuarioModificar->setTelefono($_POST["telefono"]);
        $usuarioModificar->setSexo($_POST["sexo"]);
        $usuarioModificar->setnombrecompleto($_POST["nombrecompleto"]);


        $repositorio->modificarUsuario($usuarioModificar);

        header("Location:./usuarios.php"); //una vez insertado redireccionamos a la tabla usuario
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDICION USUARIO | Nuevo Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="container">
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


    
    <h2>Editar Usuario</h2>
    <hr>

    <form action="<?= $_SERVER['PHP_SELF'].'?usuario_modificar='.$idUsuarioModificar; ?>" method="post">

        <div class="form-group">
            <label for="exampleFormControlInput1">Datos para modificar:</label>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $usuarioModificar->getNombre() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombrecompleto" value="<?= $usuarioModificar->getnombrecompleto() ?>"><br>
            <input type="password" class="form-control" id="" placeholder="Contraseña" name="clave" value="<?= $usuarioModificar->getClave() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $usuarioModificar->getDescripcion() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="correo" value="<?= $usuarioModificar->getCorreo() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="telefono" value="<?= $usuarioModificar->getTelefono() ?>"><br>
           <!--  <input type="text" class="form-control" id="" placeholder="Descripción" name="centro" value="<?= $usuarioModificar->getCentro() ?>"><br> -->


            <!-- centro option -->

            <select id="centros" name="centro" value="<?= $usuarioModificar->getCentro() ?>">

            </select>

        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione un rol de usuario:</label>
            <select class="form-control" id="exampleFormControlSelect1" name="sexo">
                <option value="Hombre" <?= $usuarioModificar->getSexo() == 'Hombre' ? 'selected' : "" ;?>>Hombre</option>
                <option value="Mujer" <?= $usuarioModificar->getSexo() == 'Mujer' ? 'selected' : "";?>>Mujer</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione un rol de usuario:</label>
            <select class="form-control" id="exampleFormControlSelect1" name="rol">
                <option value="docente" <?= $usuarioModificar->getRol() == 'docente' ? 'selected' : "" ;?>>Docente</option>
                <option value="admin" <?= $usuarioModificar->getRol() == 'admin' ? 'selected' : "";?>>administrador</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione si estará activo o no:</label>
            <select class="form-control" id="exampleFormControlSelect1" name="activo">
                <option value="1" <?= $usuarioModificar->getActivo() == '1' ? 'selected' : ""; ?>>Activo</option>
                <option value="0" <?= $usuarioModificar->getActivo() == '0' ? 'selected' : ""; ?>>No Activo</option>
            </select>
        </div>

        <input id='boton' type='submit' value='Modificar Usuario' name ='boton'> 

    </form>

    <script>
        //script para cargar centros adscritos
       $(document).ready(function(){
    
    $.post("./../../scripts/jqueryProyecto/recuperacionCentros.php", function(objec) {

    console.log(objec);
    
        $.each(objec, function (i, valor) { 
            var n = $("<option></option>").addClass("centro" + i ).text(objec[i]).val(objec[i]);

            if (objec[i] == "<?= $usuarioModificar->getCentro() ?>" ) { //coger el centro de ese usuario y dejarlo marcado al cargar "error"
                $(this).css("color", "red");
            }

            $("#centros").append(n);

        });


    });
  
});
    </script>

<script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>

</html>
