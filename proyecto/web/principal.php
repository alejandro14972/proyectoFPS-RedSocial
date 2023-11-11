<?php
require_once "../Entidades/UsuarioRepositorio.php";

session_start();

$usuario = null;

/* Si el usuario ya está loguedo, lo mete en sesión. Y si no, la página redirige al index para que 
    se loguee. Se evita así que se pueda acceder directamente al la tortuga sin haberse logueado antes. */

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} else {
    header("Location:../index.php");
}

$repositorio = new UsuarioRepositorio();
//print_r($usuario);
?>

<!DOCTYPE html>
<html lang="es-es">

<head>
    <title>Docencia Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
</head>

<body class="container" onload="verNoticias()">

    <!-- Cabecera -->
    <header class="row align-items-center mt-3">

        <div class="col-md-3">
            <img src="" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-9  titulo mt-4">
            <a href="./webUsuarios/modificarUsuarioDocente.php?usuario_modificar=<?= $usuario->getId() ?>">
                <p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre() . " <i class='fa fa-user-o' aria-hidden='true'></i></a>
<br>" ?>
                    <a href="#"><i>Centro de trabajo: </i> <?= strtoupper($usuario->getCentro()) . "</a> <i class='fa fa-building' aria-hidden='true'></i> <br> "; ?>
                        <?php
                        if ($usuario->esAdmin()) {
                            echo "<a href='./webUsuarios/usuarios.php'>Administración de usuarios </a><i class='fa fa-database' aria-hidden='true'></i><br>";
                            echo "<a href='administracionCentros.php'>Administración de centros adscritos </a><i class='fa fa-university' aria-hidden='true'></i><br>";
                            echo "<a href='./webMensajeria/administracionMensajeria.php'>Administración de mensajes </a><i class='fa fa-paper-plane-o' aria-hidden='true'></i><br>";
                            echo "<a href='./webNoticias/administracionNoticias.php'>Administración de noticias </a><i class='fa fa-newspaper-o' aria-hidden='true'></i><br>";
                            echo "<a href='./webRecursos/administracionRecursos.php'>Administración de recursos </a><i class='fa fa-folder' aria-hidden='true'></i><br>";
                        } else {
                            echo "<a href='./webUsuarios/docentes.php'>Docentes </a><i class='fa fa-address-book' aria-hidden='true'></i><br>";
                            echo "<a href='./webMensajeria/mensajeria2.php'>Mensajeria </a><i class='fa fa-paper-plane-o' aria-hidden='true'></i><br>";
                            echo "<a href='./webRecursos/recursos2.php'>Recursos </a><i class='fa fa-folder' aria-hidden='true'></i><br>";
                        }
                        echo "<a href='./webUsuarios/logout.php' id='cerrar'>cerrar sesión </a> <i class='fa fa-window-close' aria-hidden='true'></i><br>";
                        ?>
                </p>

        </div>
    </header>

    <!-- SALUDO -->
    <div class="row mt-3">
        <div class="col-3 col-md-6">
            <i id="saludo"><?php echo $usuario->getNombre(); ?></i>
            <?php echo "<i class= text-white>" . $usuario->getNombre() . "</i>"; ?>
        </div>
        <div class="col-8 col-md-6">
            <p id="hora" class="text-right"></p>
        </div>

    </div>

    <!-- Contenidos principales -->

    <div class="row mt-3 justify-content-end">
        <main class="col-md-6">
            <div class="row p-3 text-justify ">
                <h1 class="text-light titulo1Recursos">Recursos</h1>
                <p class="miparrafo">Los usuarios con rol docente o administrador podeis subir vuestros recursos para que sean visualizados y descargados por otros usuarios. a la hora de crear cuestrs recursos tendreís la posibilidad de indicar la privacidad</p>
            </div>
        </main>
    </div>

    <div class="row justify-content-start ">
        <main class="col-md-6">
            <div class="row p-3 text-justify ">
                <h1 class="text-light titulo2Mensajeria">Mensajeria</h1>
                <p class="parrafo2">Los usuarios cor rol docente o administrador teneís la posibilidad de enviaros mensajes entre vosotros. podreís ver los mensajes de envidos y recibidos. los mensajes enviados se pueden borrar en caso de error.</p>

            </div>
        </main>
    </div>

    <div class="row justify-content-end">
        <main class="col-md-6">
            <div class="row  p-3 text-justify ">
                <h1 class="text-light">Ven a visitarnos</h1>
                <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46500.466140890945!2d-5.811593596315082!3d43.24557138138258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd36f685cadc5f4f%3A0x60ef4ab44118dbdd!2sMieres%2C%20Asturias!5e0!3m2!1ses!2ses!4v1651165373786!5m2!1ses!2ses" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </main>
    </div>

    <div class="row justify-content-start">
        <main class="col-md-6">
            <div class="row p-3 text-justify ">
                <h1 class="text-light titulo2Mensajeria">Redes Sociales</h1>
                <a class="twitter-timeline" data-height="200" data-theme="dark" href="https://twitter.com/docencia_online?ref_src=twsrc%5Etfw">Tweets by docencia_online</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>            </div>
        </main>
    </div>
    <!-- Sección -->
    <aside class="row mb-3 justify-content-between m-4">

        <h1 class="col-12 text-center text-white">Noticias</h1>

        <div class="red col-12  rounded p-2 mb-3" id="primerBloque">
            <h3 id="tituloBloque1"></h3>
            <i id="fecha1"></i>
            <p id="bloque1"></p>

        </div>

        <div class="purple col-12 rounded p-2 mb-3" id="segundoBloque">
            <h3 id="tituloBloque2"></h3>
            <i id="fecha2"></i>
            <p id="bloque2"></p>

        </div>

        <div class="grey col-12  rounded p-2 mb-3" id="tercerBloque">
            <h3 id="tituloBloque3"></h3>
            <i id="fecha3"></i>
            <p id="bloque3"></p>

        </div>

        <div class="green col-12  rounded p-2 mb-3" id="cuartoBloque">
            <h3 id="tituloBloque4"></h3>
            <i id="fecha4"></i>
            <p id="bloque4"> </p>

        </div>

    </aside>

    <!-- Pie -->
    <footer class="row">
        <div class="col-12 mt-2 mb-2">
            <a title="IBQ" href="http://www.ibq.es/" target="_blank"><img src="./css/imagenes/descarga2.png" alt="LoGO IBQ" class=" foto1" /></a>
            <a href="https://www.facebook.com/" target="_blank"><img src="./css/imagenes/descarga3.svg" alt="facebook" class="foto2"></a>
            <a href="https://twitter.com/docencia_online" target="_blank"><img src="./css/imagenes/descarga4" alt="Twitter" class="foto3"></a>
        </div>
    </footer>


    <!-- script cargar noticias -->
    <script>
        function verNoticias() {

            $.post("webNoticias/peticionNoticias.php", function(objec2) {

                console.log(objec2);

                if (objec2 == "") {
                    document.getElementById("mostrar").innerHTML = " ";
                } else {

                    ////////////////PRIMER BLOQUE/////////////////
                    var titulo1 = objec2[0][0].titulo;
                    var bloque1 = objec2[0][0].bloque;
                    var fecha1 = objec2[0][0].fecha;

                    if (titulo1 == "") {
                        $("#primerBloque").hide();
                    } else {

                        /*  reducir este codigo con un bloque for para recorrer el object2 
                        creando en cada interaccion los elementos necesarios */

                        document.getElementById("tituloBloque1").innerHTML = titulo1;
                        document.getElementById("fecha1").innerHTML = fecha1;
                        document.getElementById("bloque1").innerHTML = bloque1;
                    }

                    ////////////////SEGUNDO BLOQUE////////////////////

                    var titulo2 = objec2[1][0].titulo;
                    var bloque2 = objec2[1][0].bloque;
                    var fecha2 = objec2[1][0].fecha;

                    if (titulo2 == "") {
                        $("#segundoBloque").hide();
                    } else {
                        document.getElementById("tituloBloque2").innerHTML = titulo2;
                        document.getElementById("fecha2").innerHTML = fecha2;
                        document.getElementById("bloque2").innerHTML = bloque2;
                    }

                    ///////////////////TERCER BLOQUE//////////////////
                    var titulo3 = objec2[2][0].titulo;
                    var bloque3 = objec2[2][0].bloque;
                    var fecha3 = objec2[2][0].fecha;

                    if (titulo3 == "") {
                        $("#tercerBloque").hide();
                    } else {
                        document.getElementById("tituloBloque3").innerHTML = titulo3;
                        document.getElementById("fecha3").innerHTML = fecha3;
                        document.getElementById("bloque3").innerHTML = bloque3;
                    }

                    ///////////////////////CUARTO BLOQUE//////////////////

                    var titulo4 = objec2[3][0].titulo;
                    var bloque4 = objec2[3][0].bloque;
                    var fecha4 = objec2[3][0].fecha;

                    if (titulo4 == "") {
                        $("#cuartoBloque").hide();
                    } else {
                        document.getElementById("tituloBloque4").innerHTML = titulo4;
                        document.getElementById("fecha4").innerHTML = fecha4;
                        document.getElementById("bloque4").innerHTML = bloque4;
                    }
                }

            });

        }
    </script>



    <!-- script hora -->

    <script>
        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

        var hoy = new Date();

        var fecha = diasSemana[hoy.getDay()] + " " + hoy.getDate() + '-' + (meses[hoy.getMonth()]) + '-' + hoy.getFullYear();

        var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();

        var fechaYHora = fecha + ' ' + hora;



        $(document).ready(function() { //mantener este script debido a la asignacion de valores de etiquetas

            if (hoy.getHours() <= 12) {
                $("#saludo").text("Buenos dias, ").css({
                    "font-weight": "bold",
                    "color": "#474343"
                });
                $("a").css({
                    "font-weight": "bold",
                    "color": "#474343"
                });
                $(".fa").css({
                    "font-weight": "bold",
                    "color": "white"
                });
                $("body").css("background", "#13837a"); //color verde
                $(".img-fluid").attr("src", "./css/imagenes/docencia-online-mediana3.png");
            } else if (hoy.getHours() > 12 && hoy.getHours() <= 20) {
                $("#saludo").text("Buenas tardes, ").css({
                    "font-weight": "bold",
                    "color": "#CB5512"
                });
                $("a").css({
                    "font-weight": "bold",
                    "color": "#474343"
                });

                $(".fa").css(
                    "color", "white"
                );

                $("ul a").css({
                    "font-weight": "bold",
                    "color": "#474343"
                });
                $("body").css("background", "#0F947C");
                $("p").css("color", "white");
                $(".img-fluid").attr("src", "./css/imagenes/docencia-online-mediana2.png");
            } else if (hoy.getHours() >= 21) {
                $("#saludo").text("Buenas noches, ").css({
                    "font-weight": "bold",
                    "color": "white"
                });
                $("a").css({
                    "font-weight": "bold",
                    "color": "#474343"
                });
                $("ul a").css({
                    "font-weight": "bold",
                    "color": "black"
                });
                $("body").css("background", "#0F947C");
                $("p").css("color", "white");
                $(".img-fluid").attr("src", "./css/imagenes/docencia-online-mediana2.png"); //cambiar imagen logo
            }

            $("#hora").html("<span>Hoy es: </span>" + fecha);

        });
    </script>


    <!-- script boton logout rojo -->
    <script>
        $(document).ready(function() {
            $("#cerrar").css("color", "#F34F45");

            $("#cerrar").mouseenter(function() {
                $("#cerrar").css("font-size", "21px");
            });

            $("#cerrar").mouseleave(function() {
                $("#cerrar").css("color", "#F34F45");
                $("#cerrar").css("font-size", "16px");
            });

        });
    </script>


    <script src="./js/bootstrap.bundle.min.js"></script>

</body>




</html>