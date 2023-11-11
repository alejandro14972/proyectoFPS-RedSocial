<?php
$directorio = "./../../../../../ficheros_subidos";
$i = scandir($directorio);
    echo "
    <form enctype='multipart/form-data'action='pruebarecursosborrar.php'method='post'>
    <input type='file'name='archivo'>
    <input type='submit'name='enviar'value='Enviar'>
    </form>";

    //print_r($_FILES);
    if (isset($_FILES['archivo'])) {
        //recuperar ese archivo del tmp
        $origen = $_FILES['archivo']["tmp_name"];
        $destino = "./../../../../../ficheros_subidos/".$_FILES['archivo']['name'];
        move_uploaded_file($origen, $destino);
        echo "enviado";

    }