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

        if(!$usuario->esAdmin()) {
            header("Location:../principal.php");
        }
    } 
    else {
        header("Location:../../index.php");
    }

    $idUsuarioVer = $_GET["usuario_ver"]; // Se obtiene el ID del usuario para modificar
    $repositorio = new UsuarioRepositorio();
    $usuarioModificar = $repositorio->getUsuarioPorId($idUsuarioVer); // Se obtiene el Usuario a modificar según su ID

    //print_r($usuarioModificar);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VER USUARIO </title>
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
    
    <h2>Datos usuario</h2>
    <hr>

   

        <div class="form-group">
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $usuarioModificar->getNombre() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $usuarioModificar->getnombrecompleto() ?>"><br>
            <input type="password" class="form-control" id="" placeholder="Contraseña" name="clave" value="<?= $usuarioModificar->getClave() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $usuarioModificar->getDescripcion() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $usuarioModificar->getCorreo() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Nombre usuario" name="nombre" value="<?= $usuarioModificar->getTelefono() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $usuarioModificar->getActivo() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Descripción" name="descripcion" value="<?= $usuarioModificar->getRol() ?>"><br>
            <input type="text" class="form-control" id="" placeholder="Centro" name="centro" value="<?= $usuarioModificar->getCentro() ?>"><br>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
</body>

<script>
    //desactivar los campos
    $(document).ready(function(){
        $("input").attr('disabled','disabled');
        $("select").attr('disabled','disabled');
});
</script>

<script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

</html>
