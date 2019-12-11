<?php
if (!$_DB=parse_ini_file("config.ini")) {
    die ("No hay fichero configuración");
}
require_once "modelo/Bd.php";
Bd::init($_DB["db_host"], $_DB["db_user"], $_DB["db_pass"], $_DB["db_name"]);

