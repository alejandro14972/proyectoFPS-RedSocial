<?php
    class Recursos {
        private int $id;
        private string $subido;
        private string $descripcion;
        private string $nombreRecurso;
        private string $recurso;
        private string $privacidad;
        //private array $comentarios;

        function getId(): int {
            return $this->id;
        }

        function setId(string $id): void {
            $this->id = $id;
        }

        function getSubido(): string {
            return $this->subido;
        }

        function setSubido(string $subido): void {
            $this->subido = $subido;
        }

        function getnombreRecurso(): string {
            return $this->nombreRecurso;
        }

        function setnombreRecurso(string $nombreRecurso): void {
            $this->nombreRecurso= $nombreRecurso;
        }

        function getDescripcion(): string {
            return $this->descripcion;
        }

        function setDescripcion(string $descripcion): void {
            $this->descripcion = $descripcion;
        }

        function getRecurso(): string {
            return $this->recurso;
        }

        function setRecurso(string $recurso): void {
            $this->recurso = $recurso;
        }

        function getPrivacidad(): string {
            return $this->privacidad;
        }

        function setPrivacidad(string $privacidad): void {
            $this->privacidad = $privacidad;
        }

    }
?>