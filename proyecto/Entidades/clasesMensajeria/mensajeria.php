<?php

class Mensajeria {

private int $id;
private string $de;
private string $para;
private string $asunto;
private string $mensaje;

//metodos

function getId(): int {
    return $this->id;
}

function setId(string $id): void {
    $this->id = $id;
}

function getDe(): string {
    return $this->de;
}

function setDe(string $de): void {
    $this->de = $de;
}

function getPara(): string {
    return $this->para;
}

function setPara(string $para): void {
    $this->para = $para;
}


function getAsunto(): string {
    return $this->asunto;
}

function setAsunto(string $asunto): void {
    $this->asunto = $asunto;
}


function getMensaje(): string {
    return $this->mensaje;
}

function setMensaje(string $mensaje): void {
    $this->mensaje = $mensaje;
}


}