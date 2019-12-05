<?php
require_once "vistas/MainView.php";

class ListadoView extends MainView 
{

    function content() {
?>
<p>
El contenido del listado. Hay que cambiarlo.
</p>
<p
<?php 
    // $this->data ha sido inyectado en el método render
    foreach ($this->data["deportistas"] as $deportista) { 
        printf("%d - %s%s %d años - %s<br>", 
            $deportista->id,
            $deportista->nombre,
            isset($deportista->nombre_local)?" ($deportista->nombre_local) ":"",
            $deportista->getEdad(),
            $this->data["deportes"][$deportista->id_deporte]->nombre
        );
    } 
?>
</p>
<?php
    }

}