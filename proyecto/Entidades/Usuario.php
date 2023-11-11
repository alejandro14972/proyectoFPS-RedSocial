<?php
    class Usuario {
        private int $id;
        private string $nombre;
        private string $clave;
        private string $nombrecompleto;//////////////7
        private string $correo;///////////////7
        private string $telefono;/////////////7
        private string $sexo;////////////////7
        private string $descripcion;
        private string $rol;
        private bool $activo;
        private string $centro;

        ///ultimos metodos

        function getnombrecompleto(): string {
            return $this->nombrecompleto;
        }

        function setnombrecompleto(string $nombrecompleto): void {
            $this->nombrecompleto = $nombrecompleto;
        }


        function getCorreo(): string {
            return $this->correo;
        }

        function setCorreo(string $correo): void {
            $this->correo = $correo;
        }

        function getTelefono(): int {
            return $this->telefono;
        }

        function setTelefono(string $telefono): void {
            $this->telefono = $telefono;
        }

        function getSexo(): string {
            return $this->sexo;
        }

        function setSexo(string $sexo): void {
            $this->sexo = $sexo;
        }


        //metodos viejos

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

        function getClave(): string {
            return $this->clave;
        }

        function setClave(string $clave): void {
            $this->clave = $clave;
        }

        function getDescripcion(): string {
            return $this->descripcion;
        }

        function setDescripcion(string $descripcion): void {
            $this->descripcion = $descripcion;
        }

        function getRol(): string {
            return $this->rol;
        }

        function setRol(string $rol): void {
            $this->rol = $rol;
        }

        function getActivo(): bool {
            return $this->activo;
        }

        function setActivo(string $activo): void {
            $this->activo = $activo;
        }

        function esAdmin(): bool {
            return $this->getRol() == "admin";
        }

        function getCentro(): string{
            return $this->centro;
        }

        function setCentro($cent): void{
            $this->centro= $cent;
        }

    }
?>