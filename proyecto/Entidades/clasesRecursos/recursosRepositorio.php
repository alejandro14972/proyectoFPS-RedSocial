<?php
require_once("recursos.php");

/**
 * Clase encargada de gestionar la conexión y diferentes consultas con la Base de Datos
 */
class RecursosRepositorio{

    private function getPdo(): PDO
    {
        try {
            $dbUser = 'alumnado';
            $dbPassword = 'alumnado';
            $dsn = 'mysql:dbname=Proyecto2022;host=db';
            $pdo = new PDO($dsn, $dbUser, $dbPassword);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();

            return null;
        }

        return $pdo;
    }

    /**
     * Devuelve un recursos
     */
    public function getRecursos(): array
    {
        $recursos = [];

        $pdo = $this->getPdo();

        if (empty($pdo)) {
            return [];
        }

        $sql = 'SELECT * FROM recursos';
        $resultado = $pdo->query($sql);

        foreach ($resultado as $datos) {
            $recurso = new Recursos();

            $recurso->setId($datos['id']);
            $recurso->setSubido($datos['subido']);
            $recurso->setnombreRecurso($datos['nombreRecurso']);
            $recurso->setDescripcion($datos['descripcion']);
            $recurso->setRecurso($datos['nombre']);
            $recurso->setPrivacidad($datos['privacidad']);

            $recursos[] = $recurso;
        }

        $pdo = null;

        return $recursos;
    }

    public function insertarRecurso(Recursos $varRecurso): void {
        $pdo = $this->getPdo();
        $emisor = $varRecurso->getSubido();
        $nombreRecurso = $varRecurso->getnombreRecurso();
        $descripcion = $varRecurso->getDescripcion();
        $nombre = $varRecurso->getRecurso();
        $privacidad = $varRecurso->getPrivacidad();
       

        try {
            $insertarUsuario = $pdo->prepare("INSERT INTO recursos (nombreRecurso, subido, descripcion, nombre, privacidad) VALUES (?, ?, ?, ?, ?);");

            $insertarUsuario->execute([$nombreRecurso, $emisor, $descripcion, $nombre, $privacidad]);
        }
        catch(PDOException $e) {
            echo "Error al insertar los datos en la BBDD: ".$e->getMessage();
        } 
    }

    public function borrarRecursoPorId(string $id) {
        $pdo = $this->getPdo();

        $borrarRecurso = $pdo->prepare("DELETE FROM recursos WHERE id = ?");

        $borrarRecurso->execute([$id]);
    }

}