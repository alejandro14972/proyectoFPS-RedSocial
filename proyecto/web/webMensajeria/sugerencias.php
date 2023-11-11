<?php

header("Content-Type: application/json");
//meter librearia en un php aparte o coger el de la libreria
$dsn = 'mysql:dbname=Proyecto2022;host=db';
$usuario = 'alumnado';
$clave = 'alumnado';
$bd = new PDO($dsn, $usuario, $clave);

$consulta = "Select correo from usuarios";  
    $resultado = $bd->query($consulta);

    $datos = [];
  
                foreach ($resultado as $elemento ) {
                   
                    $usuarios = 
                        $elemento['correo']
                    ;

                    $datos[]= $usuarios;
                   
       //si los queremos ver todos meter aqui el json encode
       
                }
                //print_r($datos);


$id = $_REQUEST['letra'];

if (empty($id)) {
    echo json_encode("Sin registros");
}else{

$idm = strtolower($id);
$idM = strtoupper($id);

$cuenta = count($datos);
$all = [];

for ($i=0; $i <$cuenta ; $i++) { 
    
    if ($datos[$i] == strstr($datos[$i], $idm)) {

$all[]=$datos[$i] . ", "; 

    }

}

echo json_encode($all);
}

?>
