<?php
require_once("noticias.php");

/**
 * Clase encargada de gestionar la conexión y diferentes consultas con la Base de Datos
 */
class NoticiasRepositorio
{

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
     * Devuelve un noticias
     */
    public function getNoticias(): array
    {
        $noticias = [];

        $pdo = $this->getPdo();

        if (empty($pdo)) {
            return [];
        }

        $sql = 'SELECT * FROM noticias';
        $resultado = $pdo->query($sql);

        foreach ($resultado as $datos) {
            $noticia = new Noticias();

            $noticia->setId($datos['id']);
            $noticia->setBloque($datos['bloque']);
            $noticia->setTitulo($datos['titulo']);

            $noticias[] = $noticia;
        }

        $pdo = null;

        return $noticias;
    }


    //////idnoticia

    public function getNoticiaPorId(string $id): ?Noticias {
        $usuario = null;
        $pdo = $this->getPdo();

        if(empty($pdo)) {
            return null;
        }

     
        $resultado = $pdo->prepare("SELECT titulo, bloque FROM noticias WHERE id=? LIMIT 1");
    
        $resultado->execute([$id]);

        foreach ($resultado as $datosCentro) {
            $noticia = new Noticias();

            $noticia->setId($id);
            $noticia->setTitulo($datosCentro["titulo"]);
            $noticia->setBloque($datosCentro["bloque"]);
        }
        
        $pdo = null;

        return $noticia;
    }



    ////// psar id de la noticia para editar update

    public function modificarNoticia(Noticias $noticia): void
    {
        $pdo = $this->getPdo();

        $idNoticiasModificado = $noticia->getId();

        $titulo = $noticia->getTitulo();

        $descripcion = $noticia->getBloque();

        $modificarUsuario = $pdo->prepare("UPDATE noticias SET
                    titulo = ?,
                    bloque = ?
                WHERE id = ?;");

        $modificarUsuario->execute([
            $titulo,
            $descripcion,
            $idNoticiasModificado
        ]);

        $pdo = null;
    }
}
