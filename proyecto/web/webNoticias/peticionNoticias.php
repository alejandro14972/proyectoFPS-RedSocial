<?php
header("Content-Type: application/json");
//meter librearia en un php aparte o coger el de la libreria
$dsn = 'mysql:dbname=Proyecto2022;host=db';
$usuario = 'alumnado';
$clave = 'alumnado';
$bd = new PDO($dsn, $usuario, $clave);

$consulta = "Select * from noticias";  
    $resultado = $bd->query($consulta);

    $datos = [];
  
                foreach ($resultado as $elemento ) {

                    $noticias = [
                        ["id" => $elemento['id'], "titulo" =>$elemento['titulo'], "fecha"=>$elemento['fecha'], "bloque" => $elemento['bloque']],
                    ];

                    $datos[]= $noticias;
       
                }
                echo json_encode($datos);
                
        ?>