<?php

/**
 * Una clase que implementa herencia de templates (Template Inheritance)
 * con output buffers.
 * @version 2019-12
 * @author Victor
 */
class Ti
{
    /** El template que estamos extendiendo */
    private static $extend;
    /** El nombre del bloque que se está procesando */
    private static $actualBlockName;

    /** Array asociativo. Las claves son los nombres de los bloques y los valores el contenido */
    private static $blocks;

    /** La data, para pasarla a la plantilla extendida */
    private static $data;

    const TI_EXTENDED_MARK = "{[{[TI_EXTENDED_MARK]}]}]}";

    /**
     * En las plantillas derivadas, indica el nombre de la que vamos a extender.
     */
    static function extend($viewname)
    {
        self::$extend = $viewname;
    }

    /**
     * Indica que empezamos un bloque variable.
     */
    static function startBlock($name)
    {
        self::$actualBlockName = $name;
        ob_start();
    }

    /**
     * En un bloque derivado, indica que se quiere el bloque heredado. 
     */
    static function getExtendedBlock()
    {
        // Simplemente ponemos una marca solo si estamos extendiendo.
        if (self::$extend) {
            echo self::TI_EXTENDED_MARK;
        }
    }

    /**
     * Finaliza un bloque.
     */
    static function endBlock()
    {
        $buff = ob_get_clean();
        if (self::$extend) { // Si estamos extendiendo
            self::$blocks[self::$actualBlockName] = $buff; // el bloque se guarda
        } else { // si no, estamos en la base
            if (isset(self::$blocks[self::$actualBlockName])) { // si el bloque ha sido sustituido
                $block = self::$blocks[self::$actualBlockName]; // Tomamos el sustituido
                // inyectamos el bloque actual si se pidió, en la marca
                echo str_replace(self::TI_EXTENDED_MARK, $buff, $block);
            } else {
                echo $buff;
            }
        }
    }

    /**
     * Termina el bloque extendido
     */
    static function endExtend()
    {
        $viewname = self::$extend;
        self::$extend = false;
        ob_start();
        $data = self::$data;
        require $viewname;
        echo ob_get_clean();
    }

    /**
     * Método de renderizado
     */
    static function render($template, $data = []): string
    {
        self::$data = $data;
        extract($data);
        ob_start();
        require $template;
        return ob_get_clean();
    }
}
