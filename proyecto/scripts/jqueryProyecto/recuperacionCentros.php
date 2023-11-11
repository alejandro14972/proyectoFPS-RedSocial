<?php
header("Content-Type: application/json");
include './../../lib/libreria_conexion_bbdd.php';

$consulta =  "Select * from centros" ;
    $resultado = $bd->query($consulta);

    $n = [];
  
                foreach ($resultado as $elemento ) {
                   
                    $n[] = $elemento['nombreCentro'];
                    
                }

                echo json_encode($n);
        ?>