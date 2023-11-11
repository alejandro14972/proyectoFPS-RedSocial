<?php
class Noticias {
//atributos noticias
private int $id;
private string $titulo;
private string $bloque1;


//metodos get y set 

function getId(): int {
    return $this->id;
}

function setId(string $id): void {
    $this->id = $id;
}

function getTitulo(): string {
    return $this->titulo;
}

function setTitulo(string $titulo): void {
    $this->titulo = $titulo;
}

function getBloque(): string {
    return $this->bloque1;
}

function setBloque(string $bloque1): void {
    $this->bloque1 = $bloque1;
}

}