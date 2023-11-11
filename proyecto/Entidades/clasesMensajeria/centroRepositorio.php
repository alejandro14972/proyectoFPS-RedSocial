<?php
    require_once("centro.php");

    /**
     * Clase encargada de gestionar la conexión y diferentes consultas con la Base de Datos
     */
    class centroRepositorio {
        
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
         * Función que devuelve la información sobre el nombre, la descripción, el rol y si están activos o no 
         * de todos los usuarios de la base de datos
         */
        public function getCentros(): array {
            $centros = [];

            $pdo = $this->getPdo(); 

            if(empty($pdo)) {
                return [];
            }

            $sql = 'SELECT * FROM centros';
            $resultado = $pdo->query($sql);

            foreach($resultado as $datosCentro) {
                $centro = new Centro();

                $centro->setId($datosCentro['id']);
                $centro->setNombre($datosCentro['nombreCentro']);
              
                $centro->setDescripcion($datosCentro['descripcion']);
              
                $centro->setUbicacion($datosCentro['ubicacion']);

                $centros[] = $centro;
            }
                
            $pdo = null;

            return $centros;
        }

        public function insertarCentro(Centro $centro): void {
            $pdo = $this->getPdo();
            $nombreNuevoCentro = $centro->getNombre();
            
            $descripcionNuevoCentro = $centro->getDescripcion();
            
            $centroNuevoUbicacion = $centro->getUbicacion();

            try {
                $insertarCentro = $pdo->prepare("INSERT INTO centros (nombreCentro, descripcion, ubicacion) VALUES (?, ?, ?);");

                $insertarCentro->execute([$nombreNuevoCentro, $descripcionNuevoCentro, $centroNuevoUbicacion]);
            }
            catch(PDOException $e) {
                echo "Error al insertar los datos en la BBDD: ".$e->getMessage();
            } 
        }

        public function getCentroPorId(string $id): ?Centro {
            $usuario = null;
            $pdo = $this->getPdo();

            if(empty($pdo)) {
                return null;
            }

         
            $resultado = $pdo->prepare("SELECT nombreCentro, descripcion, ubicacion  FROM centros WHERE id=? LIMIT 1");
        
            $resultado->execute([$id]);

            foreach ($resultado as $datosCentro) {
                $centro = new Centro();

                $centro->setId($id);
                $centro->setNombre($datosCentro["nombreCentro"]);
                $centro->setDescripcion($datosCentro["descripcion"]);
                $centro->setUbicacion($datosCentro["ubicacion"]);
              
            }
            
            $pdo = null;

            return $centro;
        }

        public function modificarCentro(Centro $centro): void {
            $pdo = $this->getPdo();

            $idUsuarioModificado = $centro->getId();

            $nombreCentroModificado = $centro->getNombre();
         
            $descripcionCentroModificado = $centro->getDescripcion();
          
            $UbicacionCentroModificado = $centro->getUbicacion();

            $modificarUsuario = $pdo->prepare("UPDATE centros SET
                    nombreCentro = ?,
                    descripcion = ?,
                    ubicacion = ?
                   
                WHERE id = ?;");
        
            $modificarUsuario->execute([
                $nombreCentroModificado, 
              
                $descripcionCentroModificado, 

                $UbicacionCentroModificado,
               
                $idUsuarioModificado
            ]);
            
            $pdo = null;
        }
        

        public function borrarCentroPorId(string $id) {
            $pdo = $this->getPdo();

            $borrarUsuario = $pdo->prepare("DELETE FROM centros WHERE id = ?");

            $borrarUsuario->execute([$id]);
        }
/*
        public function DesactivarUsuarioPorId(string $id) {
            $pdo = $this->getPdo();

            $activarUsuario = $pdo->prepare("UPDATE usuarios set activo = '0' where id = ?");
            $activarUsuario->execute([$id]);
        }

        public function activarUsuarioPorId(string $id) {
            $pdo = $this->getPdo();

            $activarUsuario = $pdo->prepare("UPDATE usuarios set activo = '1' where id = ?");
            $activarUsuario->execute([$id]);
        } */

    }
    
?>