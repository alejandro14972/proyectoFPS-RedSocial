<?php
header("Content-Type: application/json");
//meter librearia en un php aparte o coger el de la libreria
$dsn = 'mysql:dbname=Proyecto2022;host=db';
$usuario = 'alumnado';
$clave = 'alumnado';
$bd = new PDO($dsn, $usuario, $clave);

$q = $_POST['id'];
//$q = "admin@gmail.com";

//$consulta =  "Select * from clientes where idCliente = '".$q."'";
$consulta = "Select * from mensajeria where id = '".$q."'";  
    $resultado = $bd->query($consulta);

    $datos = [];
  
                foreach ($resultado as $elemento ) {

                    $mensajes = [
                        ["id" => $elemento['id'], "receptor" => $elemento['receptor'], "asunto" => $elemento['asunto'], "mensajeria" => $elemento['mensajeria']],
                    ];

                    $datos[]= $mensajes;
                   
       
       
                }
                echo json_encode($datos);
                
        ?>