<?php
session_start();

require_once "Entidades/UsuarioRepositorio.php";

// Si el usuario ya está logueado, redirige a la página principal
if (isset($_SESSION["usuario"])) {
  header("Location:./web/principal.php");
}

$repositorio = new UsuarioRepositorio();

$nombre = "";
$clave = "";

// Obtengo el valor de la contraseña para loguear al usuario
if (isset($_POST["clave"])) {
  $clave = strip_tags(trim($_POST["clave"]));
}

if (isset($_POST["nombre"])) {
  $nombre = strip_tags(trim($_POST["nombre"]));
}


$usuario = $repositorio->getUsuarioLogin($nombre, $clave); //devuelve nombre y rol

// Si las credenciales son correctas, mete al usuario en sesión y redirige a la página principal
if ($usuario !== null && $usuario->getActivo() == "1") { //comprobacion de actividad rol 
  $_SESSION["usuario"] = $usuario;
  header("Location:./web/principal.php");
} else {
  if (isset($_POST["nombre"])) {
?>
    <script>
      alert("Error de autentificación o el usuario no está activo");
    </script>
<?php
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Docencia online | Login</title>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>

<body class="container mt-3">
  <div class="row align-items-center">
    <div class="col-md-3">
      <img src="./web/css/imagenes/docencia-online-mediana.png" alt="logo" class="img-fluid">
    </div>
    <div class="col-md-9">
      <h1 class="text-center text-light bg-info p-2 pb-3">Docencia online</h1>
    </div>

  </div>

  <div class="row" id="login">
    <h2 class="col-12 text-center">Login</h2>
  </div>
  <hr>
  <div class="row mb-3" id="unirse">
    <a href="./../nuevoUsuario.php" class="col-12 text-center text-warning">Unirse</a>
  </div>
  <form action="index.php" method="post" id="formularioUser">
    <div class="form-group col-12">
      <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp" placeholder="User name" required>
    </div>
    <div class="form-group col-12">
      <input type="password" class="form-control" id="contraseña" name="clave" placeholder="Password" required>
    </div>
    <div class="row justify-content-center">
      <input type="submit" class="btn btn-primary " value="Entrar" id="btn">
    </div>
  </form>


  <div class="row" id="enlaceInvitado">
    <a href="#" class="col-12 text-center mt-2 text-warning" onclick="pulsarInvitado()">Entrar como invitado</a>
  </div>

  <div class="row" id="regresar">
    <a href="#" class="col-12 text-center mt-2 text-warning" onclick="regresarLogin()">Regresar</a>
  </div>

  <div class="form-group col-12 correoInvitado">
    <form>
      <label for="" class="col-12">Ingrese un correo:
          <input type="email" class="form-control" id="emailUser" name="" placeholder="email" required>
      </label>
      <div class="row justify-content-center">
        <input type="button" class="btn btn-primary " value="Entrar como invitado" id="" onclick="entrarInvitado()">
    </div><br>
    </form>
    <i>Los usuarios invitados tienen acceso a descargar recursos de uso público</i>
  </div>


  <script src="./scripts/jqueryProyecto/estilosJQUERYhora.js"></script>

  <script>

    $(document).ready(function() {
      $(".correoInvitado").hide();
      $("#regresar").hide();
    });

    function pulsarInvitado() {
      $("#formularioUser").hide();
      $("#login").hide();
      $("#enlaceInvitado").hide();
      $("#unirse").hide();
      $("#regresar").show();
      $(".correoInvitado").show();
    }

    function entrarInvitado() { 
      var invitado = document.getElementById("emailUser").value;
      console.log(invitado);
      sessionStorage.setItem('key', invitado); //guardar sesion email
      window.location.assign("./web/webInvitado/principalInvitado.php");
     }

    

     function regresarLogin() {
      location.reload();
       }


  </script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script> -->
</body>

</html>