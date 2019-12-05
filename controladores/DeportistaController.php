<?php
require_once "Controller.php";
require_once "modelo/Deportista.php";
require_once "modelo/Deporte.php";
require_once "modelo/OrmSportpedia.php";
require_once "funciones.php";

class DeportistaController extends Controller 
{
    
    function listado() {
        // Interacción con el modelo
        $OrmSportpedia = new OrmSportpedia;
        $deportistas = $OrmSportpedia->obtenerTodosDeportistas();
        $deportes = $OrmSportpedia->obtenerTodosDeportes();

        // Interacción con la vista. Pasamos los deportistas y los deportes.
        require "vistas/ListadoView.php";
        $vista = new ListadoView;
        $vista -> setTitle("Listado");
        echo $vista -> render(["deportistas" => $deportistas, "deportes"=>$deportes]);
    }


}
