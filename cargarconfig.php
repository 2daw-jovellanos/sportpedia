<?php
// obtener configuración
if (!$config=parse_ini_file("config.ini")) {
    die ("No hay fichero configuración");
}

// Inicializar BD
require_once "modelo/Klasto.php";
Klasto::init($config["db_host"], $config["db_user"], $config["db_pass"], $config["db_name"]);

