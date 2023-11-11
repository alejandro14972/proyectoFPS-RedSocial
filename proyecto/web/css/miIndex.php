<?php
    session_start();
   require_once "../../Entidades/UsuarioRepositorio.php";



    $usuario = null;

    /* Si el usuario ya está loguedo, lo mete en sesión. Y si no, la página redirige al index para que 
    se loguee. Se evita así que se pueda acceder directamente al la tortuga sin haberse logueado antes. */

    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    }
    else {
        header("Location:../../index.php");
    }

    $repositorio = new UsuarioRepositorio();

?>
<!DOCTYPE html>
<html lang="es-es">

<head>
    <title>Cultural</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">

</head>

<body class="container">


    <!-- Cabecera -->
    <header class="row align-items-end ">

        <div class="col-md-4">
            <img src="./imagenes//cultural.png" alt="" class="img-fluid">
        </div>
        <div class="col-md-8  titulo">
            <p class="text-primary">El rincón alegre para disfrutar</p>
<p class="text-right"><i>Usuario:</i> <?= $usuario->getNombre(); ?> | 
                <?php 
                    if($usuario->esProfe()){
                        echo "<a href='usuarios.php'>Ver Usuarios</a><br>";
                        echo "<a href='http://localhost:30080/usuarios'>Enlace laravel</a>";
                    }
                ?>
            </p>

        </div>
    </header>
    <hr>

    <!-- Contenidos principales -->

    <div class="row mt-3">

        <main class="col-md-8 ">
            <div class="row bg-success p-3 text-justify rounded">
                <h1 class="text-light">La idea</h1>
                <div class="primerBloque">
                    <p>Estás en una página que reúne jóvenes creadores para dar a conocer el talento que bulle en todas las vías posibles: arte, música, literatura...</p>
                    <p>Todas las semanas incorporamos novedades y estamos abiertos a descubrir lo que nos hacen llegar para darle difusión si es que, en nuestra humilde opinión, lo merece.</p>
                    <p>Resulta fantástico investigar, encontrar y perderse en las obras de colaboradores, amigos, conocidos y desconocidos disfrutando de cada iniciativa.</p>
                    </p> Acompáñanos y no te arrepentiras.</p>
                </div>
            </div>

            <div class="row bg-primary p-3 text-justify mt-3 mb-3 rounded">
                <h1>Titirilandia</h1>
                <!-- <h3>El paraíso de las marionetas</h3> -->
                <p>Imagina una ciudad poblada de muñecos animados. Calles, plazas, teatros, iglesias, museos y patios históricos son los escenarios.<span> Es el Festival Internacional de Teatro de Títeres de Paramio.</span>
                </p>
                <p>El visitante mira el plano de la pequeña localidad con los lugares donde se celebran los espectáculos. “¡Qué variedad!”, exclama. Revisa los horarios de las actuaciones2 y la distancia entre los improvisados escenarios. “¿Me dará tiempo?”,
                    se pregunta. Entonces, comienza a organizar la visita.
                </p>
                <p>
                    El ritmo es frenético. La ciudad no descansa durante seis días. A lo largo del festival se realizan unas 40 funciones de media en algunas jornadas. Cuando termina una actuación, se están celebrando más o están a punto de empezar otras en diferentes espacios.
                    Artistas argelinos, franceses, alemanes o españoles exhiben sus estilos. En 2022, el festival se celebra del 2 al 5 de abril y tiene en cartel a compañías de diferentes países. <br>
                    <a href="#" class="text-warning">Seguir leyendo...</a>
                </p>
            </div>

        </main>


        <!-- Sección Lateral -->

        <aside class="col-md-4  rounded">

            <p class="text-center concurso">Concurso de cortos</p>
            <p class="text-center">
                ¡Ya tenemos finalistas! El <span>día 31 a las 20:00 </span> visionado y entrega de premios. No te pierdas la ceremonia en el hotel Magister.
            </p>
            <div class="red row m-1 rounded p-1">
                <p> <img src="./imagenes/claqueta.svg" alt="" class="icon"> Invierno</p>
                <p>Gina repasa su vida cuando un inesperado encuentro revive un antiguo trauma... </p>
            </div>

            <div class="purple row m-1 rounded p-1">
                <p><img src="./imagenes/claqueta.svg" alt="" class="icon"> La herida</p>
                <p>La salud y la enfermedad conviven y se complementan ¿o no?</p>
            </div>

            <div class="grey row m-1 rounded p-1">
                <p><img src="./imagenes/claqueta.svg" alt="" class="icon"> Agua... no, por favor</p>
                <p>Dos compañeros de trabajo y además vecinos, compiten por un ascenso...</p>
            </div>

            <div class="green row m-1 rounded p-1">

                <p><img src="./imagenes/claqueta.svg" alt="" class="icon"> Eso que siempre te quise decir</p>
                <p>¿Cómo te explicarías si nadie pudiera verte ni oirte? </p>
            </div>

            <div class="white row m-1 rounded p-1">
                <p><img src="./imagenes/claqueta.svg" alt="" class="icon"> Boom!</p>
                <p>La cuenta atrás ya ha empezado, te esperan 15 angustiosos minutos acompañando al protagonista en su día explosivo.</p>
            </div>
        </aside>

    </div>

    <!-- Tabla libros -->
    <div>
        <p class="libros row p-3 text-justify rounded">Libros más vendidos del mes</p>
    </div>

    <div class="row">
        <table class="table table-responsive table-striped table-hover tabla">
            <thead>
                <th>Genero</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Genero</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
            </thead>

            <tr>
                <td>Ficción</td>
                <td>Sira</td>
                <td>María Dueñas</td>
                <td>Planeta</td>
                <td>No ficción</td>
                <td>El humor de mi vida</td>
                <td>Paz Padilla</td>
                <td>Harper Collins</td>
            </tr>
            <tr>
                <td>Ficción</td>
                <td>El italiano</td>
                <td>Arturo Pérez-Reverte</td>
                <td>Alfaguara</td>
                <td>No ficción</td>
                <td>El infinito en un junco</td>
                <td>Irene Vallejo</td>
                <td>Siruela</td>
            </tr>
            <tr>
                <td>Ficción</td>
                <td>Los vencejos</td>
                <td>Fernando Aramburu</td>
                <td>Tusquets</td>
                <td>No ficción</td>
                <td>Sin miedo</td>
                <td>Rafael Santandreu</td>
                <td>Grijalbo</td>
            </tr>
        </table>

    </div>


    <!-- Pie -->
    <footer class="col-12">
        <p>Contacta con nosotros en info@cultural.as o llámanos al 902902902</p>
    </footer>

    <script src="./jquery-3.5.1.js"></script>
    <script src="./bootstrap.bundle.min.js"></script>

</body>

</html>