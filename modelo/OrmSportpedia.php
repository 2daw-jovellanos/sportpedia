<?php
require_once "modelo/Deportista.php";
require_once "modelo/Deporte.php";
require_once "modelo/Klasto.php";


class OrmSportpedia
{
    public function obtenerTodosDeportistas($id_deporte = null, $pagina = 0){
        $bd = Klasto::getInstance();
        $params=[];
        $sql = "SELECT id, nombre, nombre_local, img, anno_nacimiento, bio, youtube, id_deporte FROM deportistas";
        if ($id_deporte || $pagina) {
            $sql .= " WHERE";
            if ($id_deporte) {
                $sql .= " id_deporte=?";
                array_push($params, $id_deporte);
            }
            if ($pagina) {
                $offset = 6 * ($pagina - 1);
                $sql .= " LIMIT 6 OFFSET ?";
                array_push($params, $offset);
            }

        }
        return $bd->query($sql, $params, "Deportista");
    }

    public function obtenerTodosDeportes(){
        $bd = Klasto::getInstance();
        $sql = "SELECT id, nombre FROM deporte";
        return $bd->query($sql, [], "Deporte");
    }

    public function obtenerDeportista($id){
        $bd = Klasto::getInstance();
        $sql = "SELECT id, nombre, nombre_local, img, anno_nacimiento, bio, youtube, id_deporte FROM deportistas"
            . " WHERE id=?";
        return $bd->queryOne($sql, [$id], "Deportista");
    }


}