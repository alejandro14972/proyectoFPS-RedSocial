<?php
    require_once("mensajeria.php");

    /**
     * Clase encargada de gestionar la conexión y diferentes consultas con la Base de Datos
     */
    class MensajeriaRepositorio {
        
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
         * Función que devuelve los cooreo recibidos 
       
         */
        public function getMensajes(string $correo): array {
            $mensajes = [];

            $pdo = $this->getPdo(); 

            if(empty($pdo)) {
                return [];
            }

            // Consulta preparada:
            $resultado = $pdo->prepare("SELECT id, emisor, receptor, asunto, mensajeria FROM mensajeria WHERE receptor=?");
            $resultado->execute([$correo]);

            foreach($resultado as $mensajesUsuario) {
                $mensaje = new Mensajeria();

                $mensaje->setId($mensajesUsuario['id']);
                $mensaje->setDe($mensajesUsuario['emisor']);
                $mensaje->setPara($mensajesUsuario['receptor']);
                $mensaje->setAsunto($mensajesUsuario['asunto']);
                $mensaje->setMensaje($mensajesUsuario['mensajeria']);

                $mensajes[] = $mensaje;
            }
                
            $pdo = null;

            return $mensajes;
        }


        public function getMensajePorId(string $id): ?Mensajeria {
            $mensaje = null;
            $pdo = $this->getPdo();

            if(empty($pdo)) {
                return null;
            }

            // Consulta preparada:
            $resultado = $pdo->prepare("SELECT emisor, receptor, asunto, mensajeria FROM mensajeria WHERE id=? LIMIT 1");
        
            $resultado->execute([$id]);

            foreach ($resultado as $datosMensaje) {
                $mensaje = new Mensajeria();

                $mensaje->setId($id);
                $mensaje->setDe($datosMensaje["emisor"]);
                $mensaje->setPara($datosMensaje["receptor"]);
                $mensaje->setAsunto($datosMensaje["asunto"]);
                $mensaje->setMensaje($datosMensaje["mensajeria"]);
            }
            
            $pdo = null;

            return $mensaje;
        } 


        public function insertarMensaje(Mensajeria $varMensaje): void {
            $pdo = $this->getPdo();
            $emisor = $varMensaje->getDe();
            $receptor = $varMensaje->getPara();
            $asunto = $varMensaje->getAsunto();
            $mensaje = $varMensaje->getMensaje();
           

            try {
                $insertarUsuario = $pdo->prepare("INSERT INTO mensajeria (emisor, receptor, asunto, mensajeria) VALUES (?, ?, ?, ?);");

                $insertarUsuario->execute([$emisor, $receptor, $asunto, $mensaje]);
            }
            catch(PDOException $e) {
                echo "Error al insertar los datos en la BBDD: ".$e->getMessage();
            } 
        }
      

        public function borrarMensajePorId(string $id) {
            $pdo = $this->getPdo();

            $borrarMensaje = $pdo->prepare("DELETE FROM mensajeria WHERE id = ?");

            $borrarMensaje->execute([$id]);
        }


        /**
         *  get mensajes para admin administracion 
         */
        public function getMensajesAdmin(): array {
            $mensajes = [];

            $pdo = $this->getPdo(); 

            if(empty($pdo)) {
                return [];
            }

            // Consulta preparada:
            $sql = 'SELECT * FROM mensajeria';
            $resultado = $pdo->query($sql);

            foreach($resultado as $mensajesUsuario) {
                $mensaje = new Mensajeria();

                $mensaje->setId($mensajesUsuario['id']);
                $mensaje->setDe($mensajesUsuario['emisor']);
                $mensaje->setPara($mensajesUsuario['receptor']);
                $mensaje->setAsunto($mensajesUsuario['asunto']);
                $mensaje->setMensaje($mensajesUsuario['mensajeria']);

                $mensajes[] = $mensaje;
            }
                
            $pdo = null;

            return $mensajes;
        }
       
        

    }
