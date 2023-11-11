<?php
require_once('../../Entidades/UsuarioRepositorio.php');
require_once('../../Entidades/clasesRecursos/recursosRepositorio.php');
session_start();

$usuario = null;

$directorio = "./../../../../../ficheros_subidos";
$i = scandir($directorio);

//print_r($i);

/**
 * Si el usuario está logueado pero no es profesor, se redirige a la princiapl. 
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
$nuevoRecurso = new Recursos;
$repositorio = new RecursosRepositorio();

///subir recurso a carpta recursos
if (isset($_FILES['archivo'])) {
    $origen = $_FILES['archivo']["tmp_name"];
    $aux2 = $_FILES['archivo']['name']; //esta variable me almacena el nombre del recurso 
    $destino = "./../../../../../ficheros_subidos/" . $_FILES['archivo']['name'];
        if (file_exists($destino)) {
            ?>
            <script>
                alert("El archivo ya existe o cambie el nombre del fichero");
            </script>
            <?php
        }else{
    move_uploaded_file($origen, $destino);


/**
 * Si se envía el formulario, se insertará el nuevo mensaje en la Base de Datos
 */
if (!empty($_POST)) {

    $nuevoRecurso->setSubido(strip_tags(trim($_POST["emisor"])));
    $nuevoRecurso->setnombreRecurso(strip_tags(trim($_POST["nombre"])));
    $nuevoRecurso->setDescripcion(strip_tags(trim($_POST["descripcion"])));
    $nuevoRecurso->setPrivacidad(strip_tags(trim($_POST["privacidad"])));
    $nuevoRecurso->setRecurso($aux2);

    $repositorio->insertarRecurso($nuevoRecurso);

?>
    <script>
        alert("recurso enviado con exito");
        window.location.href = "administraciónRecursos.php";
    </script>
<?php
}
}
}

?>

<!DOCTYPE html>
<html lang="es-es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docencia Online | Recursos</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
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

        <h2>Recursos</h2>
        <hr>
        <div class="row justify-content-between">
            <input type="button" id="boton1" class="btn btn-success col-3" value="Ver recursos" onclick="verRecursos()">
            <input type="button" id="boton2" class="btn btn-primary col-3" value="Ver mis recursos" onclick="verMisRecursos()">
            <input type="button" id="boton3" class="btn btn-warning col-3" value="Subir recurso" onclick="nuevoRecurso()">
        </div>
        <hr>
        <div id="contadorOcultar">
            <table class=" table1 table contador1 table-striped text-center mt-3 table-responsive table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Subido por:</th>
                        <th>Nombre asignado</th>
                        <th>Descripción</th>
                        <th>Nombre fichero</th>
                        <th>Privacidad</th>
                        <th>Descargar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        //print_r($repositorio->getRecursos())
                        ?>
                        <?php foreach ($repositorio->getRecursos() as $noticia) : ?>
                            <td><?= $noticia->getId() ?></td>
                            <td><?= $noticia->getSubido() ?></td>
                            <td><?= $noticia->getnombreRecurso() ?></td>
                            <td><?= $noticia->getDescripcion() ?></td>
                            <td><?= $noticia->getRecurso() ?></td>
                            <td><?= $noticia->getPrivacidad() ?></td>
                            <td><a href='/ficheros_subidos/<? echo $noticia->getRecurso() ?>' download='<? echo $noticia->getnombreRecurso() ?>'><i class='fa fa-cloud-download text-warning' aria-hidden='true'></i></a></td>
                            <td><a href='./borrarRecurso.php?recurso_borrar=<? echo $noticia->getId() ?>'><i class='fa fa-trash text-warning'></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div id="formulario">
        </div>

        <div class="table2">
            <table class="table table-striped text-center mt-3 table-responsive table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Subido por:</th>
                        <th>Nombre archivo</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Privacidad</th>
                        <th>Descargar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody id="mostrar">

                </tbody>

        </div>
        </table>
    </div>
    </div>

    <script>
        $(".table").css("color","white")
    </script>

    <!--database-->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.contador1').DataTable({
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



    <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

    <script>
        $(".table2").hide(); //ocultar tabla 2 al cargar 

        function verRecursos() { //boton ver recursos recarga pagina
            location.reload();
        }

        $(document).ready(function() {
            $("#boton1").attr('disabled','disabled');
        });


        function verMisRecursos() {
            $(".table1").hide();
            $(".table2").show();
            $(".borrar2").remove(); //elimina el formulario
            $("#contadorOcultar").hide();
            $("#formulario").hide("form");
            $("#boton2").attr('disabled','disabled');
            $("#boton1").removeAttr('disabled');
            $("#boton3").removeAttr('disabled');

            var auxUser = document.getElementById("correo").innerHTML;

            console.log(auxUser);


            $.post("peticionRecursosSubidos.php", {
                correo: auxUser
            }, function(objec2) {

                console.log(objec2);

                if (objec2 == "") {

                    document.getElementById("mostrar").innerHTML = "No tienes recursos subidos";
                } else {

                    for (let i = 0; i < objec2.length; i++) {

                        var recursos = "<tr class= 'borrar'><td>" + objec2[i][0].id + "</td><td>" +
                            objec2[i][0].subido + "</td><td> " +
                            objec2[i][0].nombre + "</td><td>" +
                            objec2[i][0].descripcion + "</td><td>" +
                            objec2[i][0].fecha + "</td><td>" +
                            objec2[i][0].privacidad + "</td><td>" +
                            "<a href='/ficheros_subidos/" + objec2[i][0].nombre + "' download='" + objec2[i][0].nombreRecurso + "'><i class='fa fa-cloud-download text-warning' aria-hidden='true'></i></a></td><td>" +
                            "<a href = ./borrarRecurso.php?recurso_borrar=" +
                            objec2[i][0].id + "><i class='fa fa-trash text-warning'></i></a></td><tr>";
                        document.getElementById("mostrar").innerHTML += recursos;

                    }
                }

            });

               /*  $('.contador2').DataTable({
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
                }); */
            }

        function nuevoRecurso() {
            $(".table1").hide();
            $("#formulario").show();
            $(".table2").hide();
            $("#contadorOcultar").hide();
            $(".borrar").remove();
            $("#boton3").attr("disabled", "true");
            $("#boton2").removeAttr('disabled');
            $("#boton1").removeAttr('disabled');
            var aux = document.getElementById("correo").innerHTML;

            console.log(aux);

            var formulario =
                "<form action='recursos2.php' enctype='multipart/form-data' method='post' class='borrar2'>" +
                "<div class='form-group'><br>" +
                "<label><input type='text' id='emisor2' class='form-control' name='emisor' value=" + aux + " required></label><br>" +
                "<label>Nombre recurso: <input type='text' id='nombre' class='form-control busqueda' name='nombre' required/></label><br>" +
                "Descripción:<textarea id='mensaje' name='descripcion' rows='10' cols='50' class='form-control' placeholder='250 carácteres' size='250' required></textarea><br>" +
                "<div class='form-group'>" +
                "<label for='exampleFormControlSelect1'>Seleccione la privacidad:</label>" +
                "<select class='form-control' id='exampleFormControlSelect1' name='privacidad'>" +
                "<option value='privado'>Privado</option>" +
                "<option value='publico'>Público</option>" +
                "</select>" +
                "</div>" +
                "<label>Recurso: <br><input type='file'name='archivo'></label><br>" +
                "<input id='boton' type='submit' value='Enviar mensaje' name ='boton' class='btn-primary'>" +
                "</div>" +
                "</form>";

            document.getElementById("formulario").innerHTML += formulario;

            $("#emisor2").hide(); //se oculta el input emisor
        }
    </script>





    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>


</html>