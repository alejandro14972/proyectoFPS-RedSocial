<?php
header("Content-Type: application/json");
//meter librearia en un php aparte o coger el de la libreria
$dsn = 'mysql:dbname=Proyecto2022;host=db';
$usuario = 'alumnado';
$clave = 'alumnado';
$bd = new PDO($dsn, $usuario, $clave);

$q = $_POST['acti'];
//$q = 0;

$consulta = "Select * from usuarios where activo = '".$q."'";  
    $resultado = $bd->query($consulta);

    $datos = [];
  
                foreach ($resultado as $elemento ) {
                   
                    $usuarios = [
                        ["id" => $elemento['id'], "nombre" => $elemento['nombre'], "nombrecompleto" => $elemento['nombrecompleto'], "clave" => $elemento['clave'],
                        "descripcion"=>$elemento['descripcion'], "correo" =>$elemento['correo'], "telefono"=>['telefono'], "rol" =>$elemento['rol'],
                        "sexo"=>$elemento['sexo'], "activo"=>$elemento['activo'], "centro"=>$elemento['centro']]
                    ];

                    $datos[]= $usuarios;
                   
       //si los queremos ver todos meter aqui el json encode
       
                }
                echo json_encode($datos);
                
        ?>