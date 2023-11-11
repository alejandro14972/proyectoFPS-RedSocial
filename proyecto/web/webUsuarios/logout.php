<?php 
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Docencia Online | logout</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="container">
    <h2 class="text-center">Sesión cerrada correctamente</h2>
    <p class="text-center">¡Hasta pronto!</p>
    <p class="text-center"><a href="../../index.php" class="text-warning">Volver al login</a></p>

</body>
    <script src="./../../scripts/jqueryProyecto/estilosJQUERYhora.js"></script>
</html>