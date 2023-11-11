<?php
    $dsn = 'mysql:host=db';
    $dbUsuario = 'alumnado';
    $dbClave = 'alumnado';
    $dsn2 = 'mysql:dbname=Proyecto2022;host=db';

    //DESACTIVAR/ACTIVAR LLAMADAS

    crearBaseDatos($dsn, $dbUsuario, $dbClave);
    /* crearTablaUsuarios($dsn2, $dbUsuario, $dbClave);
    insertarUsuarios($dsn2, $dbUsuario, $dbClave);
    crearTablaCentrosAdscrito($dsn2, $dbUsuario, $dbClave);
    insertarCentros($dsn2, $dbUsuario, $dbClave);
    crearTablaMensajeria($dsn2, $dbUsuario, $dbClave);
    insertarMensajes($dsn2, $dbUsuario, $dbClave);
    crearTablaNoticias($dsn2, $dbUsuario, $dbClave);
    insertarNoticias($dsn2, $dbUsuario, $dbClave); 
    crearTablaRecursos($dsn2, $dbUsuario, $dbClave);
    insertarRecursos($dsn2, $dbUsuario, $dbClave); */
    

    //borrarBaseDatos($dsn2, $usuario, $clave, $nombrebbdd);

    function crearBaseDatos($dsn, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn, $dbUsuario, $dbClave);
            $dbQuery = "CREATE DATABASE Proyecto2022 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            
            if ($bd->query($dbQuery)) {
                echo "<p>Base de datos creada correctamente.</p>\n";
            } 
            else {
                echo "<p>Error al crear la base de datos.</p>\n";
            }
            
            $bd = null;
        } 
        catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }
    }

    function crearTablaUsuarios($dsn2, $dbUsuario, $dbClave){
        try { 
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);

            $crearTablaUsuarios = "CREATE TABLE usuarios (
                id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(32) UNIQUE,
                nombrecompleto VARCHAR(50),
                clave VARCHAR(64),
                descripcion VARCHAR(300),
                correo VARCHAR(50) UNIQUE,
                telefono INTEGER(9),
                rol VARCHAR(20),
                sexo VARCHAR(6),
                activo boolean, 
		        centro VARCHAR(60),
                PRIMARY KEY(id)
            )";

            if ($bd->query($crearTablaUsuarios)) {
                echo "<p>Tabla de Usuarios creada correctamente.</p>\n";
            } 
            else {
                echo "<p>Error al crear la tabla de Usuarios.</p>\n";
            }
            
            $bd = null;
        } 
        catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }
    }

    // Inserción de datos en la tabla de docentes
    function insertarUsuarios($dsn2, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            require_once "proyecto/lib/libreria_usuarios.php"; 
            $resultado = $bd->query($datosInsertar);

            if($resultado) {
                echo "Filas insertadas: " . $resultado->rowCount() . "<br>";
            } 
            else {
                print_r( $bd -> errorinfo());
            }
        } 
        catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }
    }

//creacion de tabla en bbdd centros adscritos 
    function crearTablaCentrosAdscrito($dsn2, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
        
            $crearTablaCentros = "CREATE TABLE centros (
                id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                nombreCentro VARCHAR(32),
                descripcion VARCHAR(300),
                ubicacion VARCHAR(300),
                PRIMARY KEY(id)
            )";

            if ($bd->query($crearTablaCentros)) {
                echo "<p>Tabla de Usuarios creada correctamente.</p>\n";
            } 
            else {
                echo "<p>Error al crear la tabla de Usuarios.</p>\n";
            }
            
            $bd = null;
        } 
        catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }
    }

    function insertarCentros($dsn2, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            require_once "proyecto/lib/libreria_centros.php"; 
            $resultado = $bd->query($datosInsertar);

            if($resultado) {
                echo "Filas insertadas: " . $resultado->rowCount() . "<br>";
            } 
            else {
                print_r( $bd -> errorinfo());
            }
        } 
        catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }
    }

    //creacion tabla mensajeria usuarios

    function crearTablaMensajeria($dsn2, $dbUsuario, $dbClave){
        try { 
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            $crearTablaMensajeria = "CREATE TABLE mensajeria (
                id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                emisor VARCHAR(32),
                receptor VARCHAR(50),
                asunto VARCHAR(30),
                mensajeria VARCHAR(250),
                PRIMARY KEY(id)
            )";

            if ($bd->query($crearTablaMensajeria)) {
                echo "<p>Tabla de Mensajeria creada correctamente.</p>\n";
            } 
            else {
                echo "<p>Error al crear la tabla de mensajeria.</p>\n";
            }
            
            $bd = null;
        } 
        catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }
    }

  
    function insertarMensajes($dsn2, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            require_once "proyecto/lib/libreria_mensajes.php"; 
            $resultado = $bd->query($datosInsertar);

            if($resultado) {
                echo "Filas insertadas: " . $resultado->rowCount() . "<br>";
            } 
            else {
                print_r( $bd -> errorinfo());
            }
        } 
        catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }
    }


    //creacion tabla bloques admin noticias

    function crearTablaNoticias($dsn2, $dbUsuario, $dbClave){
        try { 
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            $crearTablaMensajeria = "CREATE TABLE noticias (
                id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                titulo VARCHAR (100),
                bloque VARCHAR(2052),
                fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            )";

            if ($bd->query($crearTablaMensajeria)) {
                echo "<p>Tabla de noticias creada correctamente.</p>\n";
            } 
            else {
                echo "<p>Error al crear la tabla de noticias.</p>\n";
            }
            
            $bd = null;
        } 
        catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }
    }

    //insertar noticias

    function insertarNoticias($dsn2, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            require_once "proyecto/lib/libreria_noticias.php"; 
            $resultado = $bd->query($datosInsertar);

            if($resultado) {
                echo "Filas insertadas: " . $resultado->rowCount() . "<br>";
            } 
            else {
                print_r( $bd -> errorinfo());
            }
        } 
        catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }
    }

    //tabla recursos

    function crearTablaRecursos($dsn2, $dbUsuario, $dbClave){
        try { 
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            $crearTablaRecursos = "CREATE TABLE recursos (
                id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                nombreRecurso VARCHAR (50),
                subido VARCHAR(500),
                descripcion varchar(200),
                nombre varchar(200),
                privacidad varchar(15),
                fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            )";

            if ($bd->query($crearTablaRecursos)) {
                echo "<p>Tabla de recursos creada correctamente.</p>\n";
            } 
            else {
                echo "<p>Error al crear la tabla de recursos.</p>\n";
            }
            
            $bd = null;
        } 
        catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }
    }

    //insertar recurso

    function insertarRecursos($dsn2, $dbUsuario, $dbClave){
        try {
            $bd = new PDO($dsn2, $dbUsuario, $dbClave);
            require_once "proyecto/lib/libreria_recursos.php"; 
            $resultado = $bd->query($datosInsertar);

            if($resultado) {
                echo "Filas insertadas: " . $resultado->rowCount() . "<br>";
            } 
            else {
                print_r( $bd -> errorinfo());
            }
        } 
        catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }
    }

    
    /* function borrarBaseDatos($dsn, $usuario, $clave, $nombrebbdd){
        try {
            $bd = new PDO($dsn2, $usuario, $clave);
            $consulta = "DROP DATABASE $nombrebbdd"; //nombre
                if ($bd->query($consulta)) {
                echo "<p>Base de datos borrada correctamente.</p>\n";
                } else {
                echo "<p>Error al borrar la base de datos.</p>\n";
                }
            $bd = null;
            } catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
            }
    } */

?>
