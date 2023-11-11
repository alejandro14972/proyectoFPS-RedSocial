<?php
require_once('../../Entidades/UsuarioRepositorio.php');

session_start();

$usuario = null;

/**
 * Si el usuario está logueado pero no es profesor, se redirige a la tortuga. 
 * Y si no está logueado, se redirige a la pantalla de login (index).
 */
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];

    if (!$usuario->esAdmin()) {
        header("Location:../principal.php");
    }
} else {
    header("Location:../../index.php");
}

$repositorio = new UsuarioRepositorio();
// print_r($usuario);
?>

<!DOCTYPE html>
<html lang="es-es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docencia Online | Usuarios</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <header class="row">
            <div class="col-3">
                <img src="./../css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid">
            </div>

            <div class="col-9 mt-4">
                <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?></p>
                <p class="text-right"><a href="../principal.php">Volver a Home </a><i class="fa fa-home" aria-hidden="true"></i></p>
                <p class="text-right"><a href="nuevoUsuario.php">Añadir usuario </a><i class="fa fa-user-circle-o" aria-hidden="true"></i></p>
                <p class="text-right"><a href="logout.php">Cerrar Sesión </a><i class="fa fa-window-close" aria-hidden="true"></i></p>

            </div>
        </header>

        <div class="row">
            <h2 id="enunciado" class="col-md-7">Docentes</h2>

            <select name="filtro" id="filtro" class="col-md-4 m-3" onchange="filtroUsuarios()">
                <option value="1">Opciones</option>
                <option value="2">Ver desactivados</option>
                <option value="3">Ver activos</option>
                <option value="4">Ordenar por nombre</option>
                <option value="5">Buscar por centro</option>
            </select>
        </div>

        <div class="row centros">
            <select id="cars" name="centro" onchange="filtroCentro()">

            </select>
        </div>

        <table class="table table-striped table-bordered text-center mt-3 table-responsive contador">
            <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre completo</th>
                    <!-- <th>telefono</th> -->
                    <th>Descripción</th>
                    <th>correo</th>
                    <th>Perfil</th>
                    <th>Activo</th>
                    <th>Centro</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>desactivar / activar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody class="filas" id="mostrar">
                <tr>
                    <?php
                    //print_r($repositorio->getUsuarios());
                    ?>

                    <?php foreach ($repositorio->getUsuarios() as $usuario) : ?>

                        <td><?= $usuario->getNombre() ?></td>
                        <td><?= $usuario->getnombrecompleto() ?></td>
                        <!-- <td><?= $usuario->getTelefono() ?></td> -->
                        <td><?= $usuario->getDescripcion() ?></td>
                        <td><?= $usuario->getCorreo() ?></td>
                        <td><?= $usuario->getRol() ?></td>
                        <td><?= intval($usuario->getActivo()) ?></td>
                        <td><?= $usuario->getCentro() ?></td>

                        <td><a href="verUsuario.php?usuario_ver=<?= $usuario->getId() ?>" class="view"><i class="fa fa-eye btn btn-primary"></i></a></td>
                        <td><a href="modificarUsuario.php?usuario_modificar=<?= $usuario->getId() ?>" class="edit"><i class="fa fa-edit btn btn-success"></i></a></td>
                        <td>
                            <a href="deshabilitarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>" class="activo"><i class="fa fa-ban btn btn-warning"></i></a>
                            <a href="activarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>" class="inactivo"><i class="fa fa-check-circle btn btn-success"></i></a>
                        </td>
                        <td> <a href="borrarUsuario.php?usuario_borrar=<?= $usuario->getId() ?>" class="trash"><i class="fa fa-trash btn btn-danger"></i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

    <script>
        $(".centros").hide();
        function filtroUsuarios() {
            
            var t = document.getElementById("filtro").value;

            switch (t) {
                case '1':
                    location.reload();
                    break;

                case '2':
                    $(".centros").hide();
                    //alert("Has elegido ver usuarios desactivados");
                    $.post("ajaxUsuarios/buscarDesactivados.php", {
                        desc: 0
                    }, function(objec2) {

                        console.log(objec2);
                        $(".filas").empty();

                        if (objec2 == "") {
                            document.getElementById("mostrar").innerHTML = "No tienes usuarios desactivados";
                        } else {

                            for (let i = 0; i < objec2.length; i++) {

                                var mensajes = "<tr><td>" + objec2[i][0].nombre + "</td><td>" +
                                    objec2[i][0].nombrecompleto + "</td><td>" +
                                    objec2[i][0].descripcion + "</td><td>" +
                                    objec2[i][0].correo + "</td><td>" +
                                    objec2[i][0].rol + "</td><td>" +
                                    objec2[i][0].activo + "</td><td>" +
                                    objec2[i][0].centro + "</td><td>" +
                                    "<a href='verUsuario.php?usuario_ver=<?= $usuario->getId() ?>' class='view'><i class='fa fa-eye btn btn-primary'></i></a></td><td>" +
                                    "<a href='modificarUsuario.php?usuario_modificar=<?= $usuario->getId() ?>' class='edit'><i class='fa fa-edit btn btn-success'></i></a></td><td>" +
                                    "<a href='deshabilitarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='activo'><i class='fa fa-ban btn btn-warning'></i></a>" +
                                    "<a href='activarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='inactivo'><i class='fa fa-check-circle btn btn-success'></i></a></td><td>" +
                                    "<a href='borrarUsuario.php?usuario_borrar=<?= $usuario->getId() ?>' class='trash'><i class='fa fa-trash btn btn-danger'></i></a></td></tr>";
                                document.getElementById("mostrar").innerHTML += mensajes;

                            }
                        }

                    });

                    break;

                case '3':
                    $(".centros").hide();
                    //alert("Has elegido ver usuarios activados");
                    $.post("ajaxUsuarios/buscarActivados.php", {
                        acti: 1
                    }, function(objec2) {

                        console.log(objec2);
                        $(".filas").empty();

                        if (objec2 == "") {
                            document.getElementById("mostrar").innerHTML = "No tienes usuarios desactivados";
                        } else {

                            for (let i = 0; i < objec2.length; i++) {

                                var mensajes = "<tr><td>" + objec2[i][0].nombre + "</td><td>" +
                                    objec2[i][0].nombrecompleto + "</td><td>" +
                                    objec2[i][0].descripcion + "</td><td>" +
                                    objec2[i][0].correo + "</td><td>" +
                                    objec2[i][0].rol + "</td><td>" +
                                    objec2[i][0].activo + "</td><td>" +
                                    objec2[i][0].centro + "</td><td>" +
                                    "<a href='verUsuario.php?usuario_ver=<?= $usuario->getId() ?>' class='view'><i class='fa fa-eye btn btn-primary'></i></a></td><td>" +
                                    "<a href='modificarUsuario.php?usuario_modificar=<?= $usuario->getId() ?>' class='edit'><i class='fa fa-edit btn btn-success'></i></a></td><td>" +
                                    "<a href='deshabilitarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='activo'><i class='fa fa-ban btn btn-warning'></i></a>" +
                                    "<a href='activarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='inactivo'><i class='fa fa-check-circle btn btn-success'></i></a></td><td>" +
                                    "<a href='borrarUsuario.php?usuario_borrar=<?= $usuario->getId() ?>' class='trash'><i class='fa fa-trash btn btn-danger'></i></a></td></tr>";
                                document.getElementById("mostrar").innerHTML += mensajes;

                            }
                        }

                    });

                    break;

                case '4':
                    $(".centros").hide();
                    //alert("Has elegido ordenar alfabeticamente")
                    $.post("ajaxUsuarios/ordenarNombre.php", function(objec2) {

                        console.log(objec2);
                        $(".filas").empty();

                        if (objec2 == "") {
                            document.getElementById("mostrar").innerHTML = "ordenados";
                        } else {

                            for (let i = 0; i < objec2.length; i++) {

                                var mensajes = "<tr><td>" + objec2[i][0].nombre + "</td><td>" +
                                    objec2[i][0].nombrecompleto + "</td><td>" +
                                    objec2[i][0].descripcion + "</td><td>" +
                                    objec2[i][0].correo + "</td><td>" +
                                    objec2[i][0].rol + "</td><td>" +
                                    objec2[i][0].activo + "</td><td>" +
                                    objec2[i][0].centro + "</td><td>" +
                                    "<a href='verUsuario.php?usuario_ver=<?= $usuario->getId() ?>' class='view'><i class='fa fa-eye btn btn-primary'></i></a></td><td>" +
                                    "<a href='modificarUsuario.php?usuario_modificar=<?= $usuario->getId() ?>' class='edit'><i class='fa fa-edit btn btn-success'></i></a></td><td>" +
                                    "<a href='deshabilitarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='activo'><i class='fa fa-ban btn btn-warning'></i></a>" +
                                    "<a href='activarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='inactivo'><i class='fa fa-check-circle btn btn-success'></i></a></td><td>" +
                                    "<a href='borrarUsuario.php?usuario_borrar=<?= $usuario->getId() ?>' class='trash'><i class='fa fa-trash btn btn-danger'></i></a></td></tr>";
                                document.getElementById("mostrar").innerHTML += mensajes;

                            }
                        }

                    });

                    break;

                case '5':
                    //alert("centro");
                    $(".centros").show();
                    $(document).ready(function() {

                        $.post("./../../scripts/jqueryProyecto/recuperacionCentros.php", function(objec) {

                            console.log(objec);

                            for (let i = 0; i < objec.length; i++) {
                                var n = $("<option></option>").addClass("centro").text(objec[i]).val(objec[i]).attr("id", objec[i]);;
                                console.log(n);
                                $("#cars").append(n);
                            }

                        });
                    });

                    break;
            }
        }
    </script>


    <script>
        function filtroCentro() {
           
            var centroSeleccionado = document.getElementById("cars").value;
            console.log(centroSeleccionado);

            $.post("ajaxUsuarios/buscarPorCentro.php", {
                        centro: centroSeleccionado
                    }, function(objec2) {

                        console.log(objec2);
                        $(".filas").empty();

                        if (objec2 == "") {
                            document.getElementById("mostrar").innerHTML = "No tienes usuarios en este centro";
                        } else {

                            for (let i = 0; i < objec2.length; i++) {

                                var mensajes = "<tr><td>" + objec2[i][0].nombre + "</td><td>" +
                                    objec2[i][0].nombrecompleto + "</td><td>" +
                                    objec2[i][0].descripcion + "</td><td>" +
                                    objec2[i][0].correo + "</td><td>" +
                                    objec2[i][0].rol + "</td><td>" +
                                    objec2[i][0].activo + "</td><td>" +
                                    objec2[i][0].centro + "</td><td>" +
                                    "<a href='verUsuario.php?usuario_ver=<?= $usuario->getId() ?>' class='view'><i class='fa fa-eye btn btn-primary'></i></a></td><td>" +
                                    "<a href='modificarUsuario.php?usuario_modificar=<?= $usuario->getId() ?>' class='edit'><i class='fa fa-edit btn btn-success'></i></a></td><td>" +
                                    "<a href='deshabilitarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='activo'><i class='fa fa-ban btn btn-warning'></i></a>" +
                                    "<a href='activarUsuario.php?usuario_deshabilitar=<?= $usuario->getId() ?>' class='inactivo'><i class='fa fa-check-circle btn btn-success'></i></a></td><td>" +
                                    "<a href='borrarUsuario.php?usuario_borrar=<?= $usuario->getId() ?>' class='trash'><i class='fa fa-trash btn btn-danger'></i></a></td></tr>";
                                document.getElementById("mostrar").innerHTML += mensajes;

                            }
                        }

                    });
        }
    </script>

    <!--database-->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.contador').DataTable({
                language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "info": "Mostrando de item _START_ al _END_ de un total de  _TOTAL_ items",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>


</html>