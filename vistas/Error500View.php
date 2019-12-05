<?php
require_once "vistas/MainView.php";

class Error500View extends MainView 
{

    function content() {
?>

<div>
<h1>Error 500. Algo gordo ha ocurrido<h1>
Jiuston, tenemos un problema<br>
Vuelve en un ratito, a ver si lo hemos podido arreglar.
</div>

<?php
    }

}