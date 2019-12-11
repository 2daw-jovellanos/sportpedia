<?php
require_once "modelo/Deportista.php";
require_once "modelo/Deporte.php";
require_once "modelo/OrmException.php";
require_once "modelo/Bd.php";


class OrmSportpedia
{
    public function obtenerTodosDeportistas($id_deporte = null){
        $bd = Bd::getInstance();
        $sql = "SELECT id, nombre, nombre_local, img, anno_nacimiento, bio, youtube, id_deporte FROM deportistas";
        return $bd->query($sql, [], "Deportista");
    }

    public function obtenerTodosDeportes(){
        $bd = Bd::getInstance();
        $sql = "SELECT id, nombre FROM deporte";
        return $bd->query($sql, [], "Deporte");
    }

    public function obtenerDeportista($id){
        $bd = Bd::getInstance();
        $sql = "SELECT id, nombre, nombre_local, img, anno_nacimiento, bio, youtube, id_deporte FROM deportistas"
            . " WHERE id=?";
        return $bd->queryOne($sql, [$id], "Deportista");
    }


}