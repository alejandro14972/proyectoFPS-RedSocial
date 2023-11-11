<?php
    require_once("Usuario.php");

    /**
     * Clase encargada de gestionar la conexión y diferentes consultas con la Base de Datos
     */
    class UsuarioRepositorio {
        
        private function getPdo(): PDO {
            try {
                $dbUser = 'alumnado';
                $dbPassword = 'alumnado';
                $dsn = 'mysql:dbname=Proyecto2022;host=db';
                $pdo = new PDO($dsn, $dbUser, $dbPassword);
            } 
            catch (PDOException $e) {
                echo 'Falló la conexión: '.$e->getMessage();
    
                return null;
            }
    
            return $pdo;
        }

        /**
         * Devuelve un Usuario si coincide con las credenciales del login
         */
        public function getUsuarioLogin(string $nombre, string $clave) {
            $usuario = null;
            $pdo = $this->getPdo();

            if(empty($pdo)) {
                return null;
            }

            // Consulta preparada:
            $resultado = $pdo->prepare("SELECT id, nombre, rol, activo, centro, correo FROM usuarios WHERE nombre=? and clave=? LIMIT 1");
        
            $resultado->execute([$nombre, $clave]);

            foreach ($resultado as $datosUsuario) {
                $usuario = new Usuario();

                $usuario->setNombre($datosUsuario["nombre"]);
                $usuario->setRol($datosUsuario["rol"]);
                $usuario->setActivo($datosUsuario["activo"]);
                $usuario->setCentro($datosUsuario["centro"]);
                $usuario->setId($datosUsuario["id"]);
                $usuario->setCorreo($datosUsuario["correo"]);
                //añadir mas para pasar como centro o descripcion?
            }
            
            $pdo = null;

            return $usuario;
        }

        /**
         * Función que devuelve la información sobre el nombre, la descripción, el rol y si están activos o no 
         * de todos los usuarios de la base de datos
         */
        public function getUsuarios(): array {
            $usuarios = [];

            $pdo = $this->getPdo(); 

            if(empty($pdo)) {
                return [];
            }

            $sql = 'SELECT * FROM usuarios';
            $resultado = $pdo->query($sql);

            foreach($resultado as $datosUsuario) {
                $usuario = new Usuario();

                $usuario->setId($datosUsuario['id']);
                $usuario->setNombre($datosUsuario['nombre']);
                $usuario->setnombrecompleto($datosUsuario['nombrecompleto']);
                $usuario->setCorreo($datosUsuario['correo']);
                $usuario->setTelefono($datosUsuario['telefono']);
                $usuario->setclave($datosUsuario['clave']);
                $usuario->setDescripcion($datosUsuario['descripcion']);
                $usuario->setRol($datosUsuario['rol']);
                $usuario->setActivo($datosUsuario['activo']);
                $usuario->setCentro($datosUsuario['centro']);

                $usuarios[] = $usuario;
            }
                
            $pdo = null;

            return $usuarios;
        }

        public function insertarUsuario(Usuario $usuario): void {
            $pdo = $this->getPdo();
            $nombreNuevoUsuario = $usuario->getNombre();
            $claveNuevoUsuario = $usuario->getClave();
            $descripcionNuevoUsuario = $usuario->getDescripcion();
            $rolNuevoUsuario = $usuario->getRol();
            $activoNuevoUsuario = 0;

            /* if ($usuario->getActivo()) {
                $activoNuevoUsuario = TRUE;
            } else {
                $activoNuevoUsuario = TRUE;
            } */


            $centroNuevoUsuario = $usuario->getCentro();
            $nombrecompletoNuevoUsuario = $usuario->getnombrecompleto();
            $correoNuevoUsuario = $usuario->getCorreo();
            $TelefonoNuevoUsuario = $usuario->getTelefono();
            $sexoNuevoUsuario = $usuario->getSexo();

            try {
                $insertarUsuario = $pdo->prepare("INSERT INTO usuarios (nombre, nombrecompleto, clave, descripcion, correo, telefono, rol, sexo, activo, centro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

                $insertarUsuario->execute([$nombreNuevoUsuario, $nombrecompletoNuevoUsuario, $claveNuevoUsuario, $descripcionNuevoUsuario, $correoNuevoUsuario,  $TelefonoNuevoUsuario, $rolNuevoUsuario, $sexoNuevoUsuario, $activoNuevoUsuario, $centroNuevoUsuario]);
            }
            catch(PDOException $e) {
                echo "Error al insertar los datos en la BBDD: ".$e->getMessage();
            } 
        }

        public function getUsuarioPorId(string $id): ?Usuario {
            $usuario = null;
            $pdo = $this->getPdo();

            if(empty($pdo)) {
                return null;
            }

            // Consulta preparada:
            $resultado = $pdo->prepare("SELECT nombre,nombrecompleto, clave, descripcion, correo, telefono, rol, sexo, activo, centro FROM usuarios WHERE id=? LIMIT 1");
        
            $resultado->execute([$id]);

            foreach ($resultado as $datosUsuario) {
                $usuario = new Usuario();

                $usuario->setId($id);
                $usuario->setNombre($datosUsuario["nombre"]);
                $usuario->setnombrecompleto($datosUsuario["nombrecompleto"]);
                $usuario->setClave($datosUsuario["clave"]);
                $usuario->setDescripcion($datosUsuario["descripcion"]);
                $usuario->setCorreo($datosUsuario["correo"]);
                $usuario->setTelefono($datosUsuario["telefono"]);
                $usuario->setRol($datosUsuario["rol"]);
                $usuario->setSexo($datosUsuario["sexo"]);
                $usuario->setActivo($datosUsuario["activo"]);
                $usuario->setCentro($datosUsuario["centro"]);
                
            }
            
            $pdo = null;

            return $usuario;
        }

        public function modificarUsuario(Usuario $usuario): void {
            $pdo = $this->getPdo();

            $idUsuarioModificado = $usuario->getId();
            $nombreUsuarioModificado = $usuario->getNombre();
            $claveUsuarioModificado = $usuario->getClave();
            $descripcionUsuarioModificado = $usuario->getDescripcion();
            $rolUsuarioModificado = $usuario->getRol();
            $activoUsuarioModificado = intval($usuario->getActivo());
            $centroUsuarioModificado = $usuario->getCentro();

            //

            $nombrecompletoUsuarioModificado = $usuario->getnombrecompleto();
            $correoUsuarioModificado = $usuario->getCorreo();
            $telefonoUsuarioModificado = $usuario->getTelefono();
            $sexoUsuarioModificado = $usuario->getSexo();

            $modificarUsuario = $pdo->prepare("UPDATE usuarios SET
                    nombre = ?,
                    nombrecompleto = ?,
                    clave = ?,
                    descripcion = ?,
                    correo = ?,
                    telefono = ?,
                    rol = ?,
                    sexo =?,
                    activo = ?,
                    centro = ?
                WHERE id = ?;");
        
            $modificarUsuario->execute([
                $nombreUsuarioModificado,
                $nombrecompletoUsuarioModificado, 
                $claveUsuarioModificado, 
                $descripcionUsuarioModificado,
                $correoUsuarioModificado,
                $telefonoUsuarioModificado,
                $rolUsuarioModificado, 
                $sexoUsuarioModificado,
                $activoUsuarioModificado, 
                $centroUsuarioModificado,
                $idUsuarioModificado
            ]);
            
            $pdo = null;
        }

        public function borrarUsuarioPorId(string $id) {
            $pdo = $this->getPdo();

            $borrarUsuario = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");

            $borrarUsuario->execute([$id]);
        }

        public function DesactivarUsuarioPorId(string $id) {
            $pdo = $this->getPdo();

            $activarUsuario = $pdo->prepare("UPDATE usuarios set activo = '0' where id = ?");
            $activarUsuario->execute([$id]);
        }

        public function activarUsuarioPorId(string $id) {
            $pdo = $this->getPdo();

            $activarUsuario = $pdo->prepare("UPDATE usuarios set activo = '1' where id = ?");
            $activarUsuario->execute([$id]);
        }

    }
    
?>