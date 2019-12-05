<?php
class Deportista {
    public $id;
    public $nombre;
    public $nombre_local;
    public $img;
    public $anno_nacimiento;
    public $bio;
    public $youtube;
    public $id_deporte;

    function getEdad(){
        return date("Y") - $this->anno_nacimiento;
    }
}