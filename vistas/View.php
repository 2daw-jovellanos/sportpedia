<?php
/**
 * Clase base de la jerarquía de vista.
 * Derivamos de esta las clases abstractas base de cada grupo de vista
 * @author 2DAW
 * @version 2019-12
 */
abstract class View 
{

    /** La data se inyecta en la función render */
    protected $data;

    /** Cadenas a añadir al head */
    private $extraHead = "";

    /** El título del documento */
    protected $title = "Untitled Document";

    /**
     * El método principal, que debe dibujar toda la plantilla en las clases derivadas.
     * Puede invocar a otros métodos para renderizar partes variables
     *
     * @return string Una cadena resultado de renderizar toda la plantilla
     */
    abstract function main(); 

    /**
     * Añade una cadena a la variable de instancia extraHead.
     * El método main deberá volcar el contenido de $this->extraHead antes del
     * cierre del head del documento
     *
     * @param string $s La cadena a añadir. Puede contener más de una línea
     * @return void
     */
    function addToHead(string $s) {
        $extraHead .= $s . "\n";
    }

    /**
     * Devuelve $this->extraHead.
     * El método main deberá volcar el contenido de $this->extraHead antes del
     * cierre del head del documento
     *
     * @return string
     */
    function getExtraHead() : string {
        return $this->extraHead;
    }

    /**
     * Ordena la renderización de la vista.
     * Coloca la $data inyectada a disposición de todos los métodos del objeto como
     * variable de instancia $this->data e invoca al método main
     *
     * @param array $data La data que envía el controlador. Un array asociativo
     * @return string La vista completamente renderizada
     */
    function render($data = []) : string {
        $this->data = $data;
        ob_start();
        $this->main();
        return ob_get_clean(); 
    }

}