<?php 
    require_once('../../Entidades/UsuarioRepositorio.php');
    require_once('../../Entidades/clasesNoticias/noticiasRepositorio.php');
    session_start();
    
    $usuario = null;

    /**
     * Si el usuario está logueado pero no es profesor, se redirige a la princiapl. 
     * Y si no está logueado, se redirige a la pantalla de login (index).
     */
    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];

        if(!$usuario->esAdmin()) {
            header("Location:principal.php");
        }
    } 
    else {
        header("Location:../../index.php");
    }

    $repositorio = new NoticiasRepositorio(); 
   // print_r($usuario); //mostrar datos del usuario 
?>

<!DOCTYPE html>
<html lang="es-es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docencia Online | NOTICIAS</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <header class="row">
        <div class="col-3 mt-1">
            <img src="./../css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid" >
        </div>        

        <div class="col-9 mt-4">
            <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
            <p class="text-right"><a href="../principal.php">Volver </a><i class="fa fa-reply" aria-hidden="true"></i></p>
            <p class="text-right"><a href="../webUsuarios/logout.php">Cerrar Sesión </a><i class="fa fa-window-close" aria-hidden="true"></i></p>
        </div>
        </header>

      

        <h2>Noticias</h2>
        <hr>
        
        <table class="table table-striped text-center mt-3 table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Nº</th>
                    <th>Titulo</th>
                    <th>Bloque</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    // print_r($repositorio->getNoticias());
                    ?>
              
                <?php foreach ($repositorio->getNoticias() as $noticia): ?> 
                    <td><?= $noticia->getId() ?></td>
                    <td><?= $noticia->getTitulo() ?></td>
                    <td><?= $noticia->getBloque() ?></td>
                    <td><a href="./editarNoticia.php?noticia_modificar=<?= $noticia->getId()?>" class="edit"><i class="fa fa-edit btn btn-success"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>
    

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
</body>


</html>