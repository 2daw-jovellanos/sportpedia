<?php
require_once "Controller.php";
require_once "modelo/Deportista.php";
require_once "modelo/Deporte.php";
require_once "modelo/OrmSportpedia.php";
require_once "funciones.php";
require_once "vistas/Ti.php";

class DeportistaController extends Controller 
{
    
    function listado() {
        $filtrodeporte = $_REQUEST["filtrodeporte"];
        // Interacción con el modelo
        $OrmSportpedia = new OrmSportpedia;
        $deportistas = $OrmSportpedia->obtenerTodosDeportistas($filtrodeporte);
        $deportes = $OrmSportpedia->obtenerTodosDeportes();
        $title="Listado";
        $filtrodeporte = $_REQUEST["filtrodeporte"] ?? "";
        echo Ti::render("vistas/ListadoView.phtml", compact('deportistas', 'deportes', 'title', 'filtrodeporte'));
    }


}
