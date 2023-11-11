<?php
header("Content-Type: application/json");
//meter librearia en un php aparte o coger el de la libreria
$dsn = 'mysql:dbname=Proyecto2022;host=db';
$usuario = 'alumnado';
$clave = 'alumnado';
$bd = new PDO($dsn, $usuario, $clave);

$q = $_POST['correo'];
//$q = "admin@gmail.com";

//$consulta =  "Select * from clientes where idCliente = '".$q."'";
$consulta = "Select * from mensajeria where receptor = '".$q."'";  
    $resultado = $bd->query($consulta);

    $datos = [];
  
                foreach ($resultado as $elemento ) {
                   
                    /* $datos = [
                        ["IdCli" => $elemento['idCliente'], "Compañia" => $elemento['NombreCompania'], "Nombre" => $elemento['NombreContacto'], "cargo" => $elemento['CargoContacto'] , "Direccion" => $elemento['Direccion']],
                    ]; */

                    $mensajes = [
                        ["id" => $elemento['id'], "emisor" => $elemento['emisor'], "asunto" => $elemento['asunto'], "mensajeria" => $elemento['mensajeria']],
                    ];

                    $datos[]= $mensajes;
                   
       //si los queremos ver todos meter aqui el json encode
       
                }
                echo json_encode($datos);
                
        ?>

