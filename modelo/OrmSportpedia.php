<?php
require_once "modelo/Deportista.php";
require_once "modelo/Deporte.php";
require_once "modelo/OrmException.php";


class OrmSportpedia
{

    public function obtenerConexion() {
        global $_DB;
        $conn = new mysqli($_DB["db_host"], $_DB["db_user"], $_DB["db_pass"], $_DB["db_name"]);
        if ($conn->connect_error) {
            throw new OrmException("No se pudo conectar a la BD: " . $conn->connect_error );
        }
        // Hacer que mysql devuelva los resultados en utf8
        $conn->query("SET NAMES 'utf8'"); 
        return $conn;
    }
    
    public function obtenerTodosDeportistas($id_deporte = null){
        $conn = $this->obtenerConexion();
        $sql = "SELECT id, nombre, nombre_local, img, anno_nacimiento, bio, youtube, id_deporte FROM deportistas";
        $stmt = $conn->prepare($sql);
        // Añade un filtrado por id_deporte.
        // Si pasan un parámetro, añade un WHERE a la cadena y haz el bind a $id_deporte.
        $stmt->execute();
        $result=$stmt->get_result();
        if ($result->num_rows > 0) {
            $deportistas = [];
            while($row = $result->fetch_object("Deportista")) {
                $deportistas[$row->id] = $row;  // Array asociativo. La clave es el id del deportista
            }
        }
        $conn->close();
        return $deportistas;
    }

    public function obtenerTodosDeportes(){
        $conn = $this->obtenerConexion();
        $sql = "SELECT id, nombre FROM deporte";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $deportes = [];
            while($row = $result->fetch_object("Deporte")) {
                $deportes[$row->id] = $row; // Array asociativo. La clave es el id del deporte
            }

        }
        $conn->close();
        return $deportes;
    }

    public function obtenerDeportista($id){
        $conn = $this->obtenerConexion();
        $sql = "SELECT id, nombre, nombre_local, img, anno_nacimiento, bio, youtube, id_deporte FROM deportistas"
            . " WHERE id=?";
        $stmt = $conn->prepare($sql);//statement sin preparar, porque no tiene parámetros
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $deportista =$result->fetch_object("Deportista");
            
        }
        $conn->close();
        return $deportista;
    }


}