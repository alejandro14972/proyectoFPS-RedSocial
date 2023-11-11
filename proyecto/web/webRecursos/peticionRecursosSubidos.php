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
$consulta = "Select * from recursos where subido = '".$q."'";  
    $resultado = $bd->query($consulta);

    $datos = [];
  
                foreach ($resultado as $elemento ) {

                    $recursos = [
                        ["id" => $elemento['id'], "nombreRecurso" => $elemento['nombreRecurso'] , "subido" => $elemento['subido'], "descripcion" => $elemento['descripcion'], "fecha" => $elemento['fecha'],"privacidad" => $elemento['privacidad'] , "nombre" => $elemento['nombre']],
                    ];

                    $datos[]= $recursos;
                   
       //si los queremos ver todos meter aqui el json encode
       
                }
                echo json_encode($datos);
                
        ?>