<?php
require_once "cargarconfig.php";
require_once "controladores/DeportistaController.php";

$controller = $_REQUEST["controller"] ?? "listado";

try {
    switch ($controller) {
        case "insertar":
        case "listado":
            (new DeportistaController)->listado();
            break;
        default:
            die ("El controlador solicitado no existe");
    }
} catch (Exception $ex) { 
    require_once "vistas/Error404View.php";
    (new Error500View)->render();
}
