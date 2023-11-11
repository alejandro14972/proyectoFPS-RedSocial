<?php
class Centro {
    private int $id;
    private string $nombre;
    private string $descripcion;
    private string $ubicacion;

    //metodos

    function getId(): int {
        return $this->id;
    }

    function setId(string $id): void {
        $this->id = $id;
    }

    function getNombre(): string {
        return $this->nombre;
    }

    function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    function getDescripcion(): string {
        return $this->descripcion;
    }

    function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    function getUbicacion(): string {
        return $this->ubicacion;
    }

    function setUbicacion(string $ubicacion): void {
        $this->ubicacion = $ubicacion;
    }

    }

