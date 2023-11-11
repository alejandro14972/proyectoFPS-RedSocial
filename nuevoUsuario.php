<?php
require_once './proyecto/Entidades/Usuario.php';
require_once './proyecto/Entidades/UsuarioRepositorio.php';

$nuevoUsuario = new Usuario();
$repositorio = new UsuarioRepositorio();

/**
 * Si se envía el formulario, se insertará el nuevo usuario en la Base de Datos
 */
if (!empty($_POST)) {
    $nuevoUsuario->setNombre($_POST["nombre"]);
    $nuevoUsuario->setnombrecompleto($_POST["nombrecompleto"]);
    $nuevoUsuario->setClave($_POST["clave"]);
    $nuevoUsuario->setDescripcion($_POST["descripcion"]);
    $nuevoUsuario->setCorreo($_POST["correo"]);
    $nuevoUsuario->setTelefono($_POST["telefono"]);
    $nuevoUsuario->setRol($_POST["rol"]);
    $nuevoUsuario->setSexo($_POST["sexo"]);

    $nuevoUsuario->setCentro($_POST["centro"]);

    if ($_POST["activo"] == 1) {
        $nuevoUsuario->setActivo(TRUE);
    } else {
        $nuevoUsuario->setActivo(FALSE);
    }

    $repositorio->insertarUsuario($nuevoUsuario);
?>
    <script>
        alert("usuario creado correctamente, en unos días el administrador le dará de alta");
    </script>
<?php
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
    <header class="row">
        <div class="col-md-3">
            <img src="./proyecto/web/css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid">
        </div>
        <div class="col-9">
            <h1 class="text-center text-light bg-info p-2 mt-5 ">NUEVO USUARIO</h1>
        </div>
    </header>

    <div class="row">
        <h2 class="col-6">Página de subscripción de docentes</h2>
        <h4 class="col-3 text-right">Bienvenidos a Docencia Online</h4>
        <a href="./proyecto/index.php" class="col-3 text-right text-warning">Login</a>
    </div>
    <hr>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="mb-3">

        <div class="form-group">
            <label for="exampleFormControlInput1">Introduzca los siguientes datos:</label>
            <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre usuario" name="nombre" required><br>
            <pre id="comprobacionNombreUsuario"></pre>
            <input type="text" class="form-control" id="nombreCompleto" placeholder="nombrecompleto usuario" name="nombrecompleto" required><br>
            <pre id="comprobacionNombreCompleto"></pre>
            <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="clave" required><br>
            <pre id="comprobacionContraseña"></pre>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion" required><br>
            <pre id="comprobacionDescripcion"></pre>
            <input type="email" class="form-control" id="mail" placeholder="Correo" name="correo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required><br>
            <pre id="comprobacionMail"></pre>
            <input type="tel" class="form-control" id="telefono" placeholder="Telefono" name="telefono" pattern="[0-9]{9}" required><br>
            <pre id="comprobacionTelefono"></pre>
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

        <div class="form-group desactivar">
            <label for="exampleFormControlSelect1">Seleccione un rol de usuario:</label>
            <select class="form-control" id="exampleFormControlSelect2" name="rol">
                <option value="docente">Docente</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <div class="form-group desactivar">
            <label for="exampleFormControlSelect1">Seleccione si estará activo o no:</label>
            <select class="form-control" id="exampleFormControlSelect3" name="activo">
                <option value="1">Activo</option>
                <option value="0">No Activo</option>
            </select>
        </div>

        <input id='botonVerificar' type='button' value='Verificación de campos' name='boton'>
        <button submit id="btnEnviar" disabled>Enviar</button>
    </form>


    <script>
        $(document).ready(function() {

            $.post("./proyecto/scripts/jqueryProyecto/recuperacionCentros.php", function(objec) {

                console.log(objec);

                for (let i = 0; i < objec.length; i++) {
                    var n = $("<option></option>").addClass("centro").text(objec[i]).val(objec[i]).attr("id", objec[i]);;
                    console.log(n);
                    $("#cars").append(n);
                }
            });
        });
    </script>

    <script src="./proyecto/scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

    <script>
        //desactivacion de campos
        $(".desactivar").hide();
    </script>

    <script>
        document.getElementById("botonVerificar").addEventListener('click', validartodo, false);

        //Expresiones_regulares:
        var emailExpresion = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
        var nombreExpresion = new RegExp(/^[a-z]{0,10}[0-9]{0,10}$/);
        var ApellidosExpresion = new RegExp(/^[a-zA-Z ]{1,50}$/);
        var ContraseñaExpresion = new RegExp(/^[0-9]{0,8}$/);
        var telefonoExpresion = new RegExp(/^[0-9]{9}$/);
        var nombreCompletoExpresion = new RegExp(/[A-Z][a-z]+/);
        var descripcion = new RegExp(/[A-Z][a-z]+/)

        var botonEnviar = document.getElementById("btnEnviar"); //boton 


        function validartodo() {
           var t =  validarNombre(); //almacenar true o false
           var d = validarEmail();
           var c = validarContraseña();
           var g = validarTelefono();
           var l = validarNombreCompleto();
           var y = validarDescripcion();


           var todo = d && t && c && g && l;

            if (todo) {
                console.log("ok");
                botonEnviar.disabled = false;
                $("#botonVerificar").hide();
            } else {
                console.log("no");
            }
        }

        function validarEmail() {
            var comMail = document.getElementById("mail").value;
            var comMail2 = document.getElementById("mail");

           // console.log("correo" + comMail);
            // comprobar si campo esta vacio
            if (comMail == "") {
                // alert("Campo email vacio");
                document.getElementById("comprobacionMail").innerHTML = "   El campo de email esta vacio";
                comMail2.style.border = "1px solid red";
                return false;
            } else if (emailExpresion.test(comMail) || comMail == "") {
                //alert("todo ok");
                comMail2.style.border = "1px solid green";
                document.getElementById("comprobacionMail").innerHTML = "  Correo eletrónico correcto";
                return true;
            } else {
                //alert("no es un correo");
                document.getElementById("comprobacionMail").innerHTML = "   El correo electronico no es valido";
                comMail2.style.border = "1px solid red";
                return false;
            }
        }

        function validarNombre() {
            var comNombre = document.getElementById("nombreUsuario").value;
            var comNombre2 = document.getElementById("nombreUsuario");;
            // comprobar si campo esta vacio
            if (comNombre == "") {
                // alert("Campo email vacio");
                document.getElementById("comprobacionNombreUsuario").innerHTML = "   El campo de nombre de usuario esta vacio";
                comNombre2.style.borderColor = "red";
                return false;
            } else if (nombreExpresion.test(comNombre) || comNombre == "") {
                //alert("todo ok");
                comNombre2.style.borderColor = "green";
                document.getElementById("comprobacionNombreUsuario").innerHTML = " Nombre correcto";
                return true;
            } else {
                document.getElementById("comprobacionNombreUsuario").innerHTML = "   El nombre no es valido";
                comNombre2.style.borderColor = "red";
                return false;
            }
        }

        function validarContraseña() {
            var comContraseña = document.getElementById("contraseña").value;
            var comContraseña2 = document.getElementById("contraseña");;
            // comprobar si campo esta vacio
            if (comContraseña == "") {
                // alert("Campo email vacio");
                document.getElementById("comprobacionContraseña").innerHTML = "   El campo de la contraseña esta vacio";
                comContraseña2.style.borderColor = "red";
                return false;
            } else if (ContraseñaExpresion.test(comContraseña) || comContraseña == "") {
                //alert("todo ok");
                comContraseña2.style.borderColor = "green";
                document.getElementById("comprobacionContraseña").innerHTML = " La contraseña es valida";
                return true;
            } else {
                document.getElementById("comprobacionContraseña").innerHTML = "   La contraseña no es valido";
                comContraseña2.style.borderColor = "red";
                return false;
            }
        }

        function validarTelefono() {
            var comTelefono = document.getElementById("telefono").value;
            var comTelefono2 = document.getElementById("telefono");;
            // comprobar si campo esta vacio
            if (comTelefono == "") {
                // alert("Campo email vacio");
                document.getElementById("comprobacionTelefono").innerHTML = "   El campo del telefono esta vacio";
                comTelefono2.style.borderColor = "red";
                return false;
            } else if (telefonoExpresion.test(comTelefono) || comTelefono == "") {
                //alert("todo ok");
                comTelefono2.style.borderColor = "green";
                document.getElementById("comprobacionTelefono").innerHTML = " El telefono es valido";
                return true;
            } else {
                document.getElementById("comprobacionTelefono").innerHTML = "   El telefono no es valido";
                comTelefono2.style.borderColor = "red";
                return false;
            }
        }

        function validarNombreCompleto() {
            var comNombreCompleto = document.getElementById("nombreCompleto").value;
            var comNombreCompleto2 = document.getElementById("nombreCompleto");;
            // comprobar si campo esta vacio
            if (comNombreCompleto == "") {
                // alert("Campo email vacio");
                document.getElementById("comprobacionNombreCompleto").innerHTML = "   El campo nombre completo esta vacio";
                comNombreCompleto2.style.borderColor = "red";
                return false;
            } else if (nombreCompletoExpresion.test(comNombreCompleto) || comNombreCompleto == "") {
                //alert("todo ok");
                comNombreCompleto2.style.borderColor = "green";
                document.getElementById("comprobacionNombreCompleto").innerHTML = " El nombre completo es valido";
                return true;
            } else {
                document.getElementById("comprobacionNombreCompleto").innerHTML = "   El Nombre con apellidos no es valido";
                comNombreCompleto2.style.borderColor = "red";
                return false;
            }
        }

        function validarDescripcion() {
            var comDescripcion = document.getElementById("descripcion").value;
            var comDescripcion2 = document.getElementById("descripcion");
            // comprobar si campo esta vacio
            if (comDescripcion == "") {
                // alert("Campo email vacio");
                document.getElementById("comprobacionDescripcion").innerHTML = "   El campo descripcion esta vacio";
                comDescripcion2.style.borderColor = "red";
                return false;
            } else if (descripcion.test(comDescripcion) || comDescripcion == "") {
                //alert("todo ok");
                comDescripcion2.style.borderColor = "green";
                document.getElementById("comprobacionDescripcion").innerHTML = " La descripcion es valida";
                return true;
            } else {
                document.getElementById("comprobacionDescripcion").innerHTML = "   La descripción no es valido";
                comDescripcion2.style.borderColor = "red";
                return false;
            }
        }


    </script>



</body>

</html>